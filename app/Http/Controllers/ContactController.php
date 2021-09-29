<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    public function index(){
        $contacts=User::where('id','!=',auth()->user()->id)->get();
        // dd(auth()->user()->id);
        $unreadIds = Message::select(DB::raw('`from_id` as sender_id, count(`from_id`) as messages_count'))
        ->where('to_id', auth()->user()->id)
            ->where('is_readed', 0)
            ->where('from_id','!=',auth()->user()->id)
            ->groupBy('from_id')
            ->get();
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });
        // dd($unreadIds);
        return response()->json($contacts);
    }

    public function getMessagesForContact($id){
        $messages =Message::where('from_id',$id)->orWhere('to_id',$id)->get();
        $messages = Message::where(function($q) use($id){
            $q->where('from_id', auth()->user()->id)->where('to_id', $id);
        })->orWhere(function($q) use($id){
            $q->where('to_id', auth()->user()->id)->where('from_id', $id);
        })->get();
        $messages->each(function($q){
            $q->update([
                'is_readed'=>true
            ]);
        });
        return response()->json($messages);
    }

    public function sendMessage(Request $request){
        $message=Message::create([
            'from_id'=>auth()->user()->id,
            'to_id' =>$request->contact_id,
            'message'=>$request->message
        ]);
        // dd(123);
        broadcast(new NewMessage($message))->toOthers();
        return response()->json($message);
    }

}

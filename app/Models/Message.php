<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=[
        'from_id',
        'to_id',
        'message',
        'is_readed'
    ];
    public function fromContact(){
        return $this->hasOne(User::class,'id','from_id');
    }
}

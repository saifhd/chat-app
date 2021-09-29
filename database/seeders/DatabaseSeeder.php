<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name'=>'User1',
            'password'=>Hash::make('password'),
            'email'=>'user1@gmail.com'
        ]);
        User::factory()->create([
            'name' => 'User2',
            'password' => Hash::make('password'),
            'email' => 'user2@gmail.com'
        ]);
        User::factory(5)->create();
        for($i = 1; $i < 8; $i++){
            for($j = 1; $j < 8; $j++){
                if($j !== $i){
                    Message::factory(5)->create([
                        'from_id'=>$i,
                        'to_id'  =>$j
                    ]);
                }
            }
        }

    }
}

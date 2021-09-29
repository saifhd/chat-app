<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

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
        User::factory(5)->create();
        for($i = 1; $i < 6; $i++){
            for($j = 1; $j < 6; $j++){
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

<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->insert(
       [
           [
               'id' => 2,
               'title' => 'TestTitle222',
               'body' => 'testBodyです2',
               'solution' => true,
               'user_id' => 1,
               'created_at'=>now(),
               'updated_at'=>now(),
           ],
       ]
        );
    }
}

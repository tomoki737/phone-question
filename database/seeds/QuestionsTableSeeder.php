
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
               'title' => 'TestTite',
               'body' => 'testBody',
               'solution' => true,
               'user_id' => 2,
               'created_at'=> now(),
               'updated_at'=> now(),
           ],
       ]
        );
    }
}

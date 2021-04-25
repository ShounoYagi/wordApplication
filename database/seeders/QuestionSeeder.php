<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            Question::create([
                'QuestionText' => 'QuestionText' . $i,
                'Answer' => 'Answer' . $i,
                'Category1' => 'Category1' . $i,
                'Category2' => 'Category2' . $i,
                'Category3' => 'Category3' . $i,
            ]);
        }
    }
}

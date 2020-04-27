<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            [
                'name' => 'Greetings',
                'type' => Str::slug('Navigation', '-'),
                'format' => 'text',
                'content' => 'hallo sayang!',
                'created_at' => (new datetime()),
                'updated_at' => (new datetime())
            ],
            [
                'name' => 'Skill',
                'type' => Str::slug('Masthead Subheading', '-'),
                'format' => 'text',
                'content' => 'Web Developer',
                'created_at' => (new datetime()),
                'updated_at' => (new datetime())
            ],
            [
                'name' => 'About Me',
                'type' => Str::slug('About Section', '-'),
                'format' => 'textarea',
                'content' => 'suka kamu',
                'created_at' => (new datetime()),
                'updated_at' => (new datetime())
            ],
            [
                'name' => 'Location',
                'type' => Str::slug('Location Section', '-'),
                'format' => 'textarea',
                'content' => 'Surbaya, Jawa Timur',
                'created_at' => (new datetime()),
                'updated_at' => (new datetime())
            ],
            [
                'name' => 'Motivation',
                'type' => Str::slug('Footer Section', '-'),
                'format' => 'text',
                'content' => 'Bug is my Enemy',
                'created_at' => (new datetime()),
                'updated_at' => (new datetime())
            ]

        ];

        DB::table('options')->insert($batch);
    }
}

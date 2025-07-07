<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImagemPost;


class ImagemPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         ImagemPost::factory(5)->create();
    
    }
}

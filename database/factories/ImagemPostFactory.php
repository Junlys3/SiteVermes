<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ImagemPost;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagemPost>
 */
class ImagemPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ImagemPost::class;
    
    public function definition(): array
    {
        return [
           'url' => $this->faker->url(),
           'id_user' => User::pluck('id')->random(),
        ];
    }
}

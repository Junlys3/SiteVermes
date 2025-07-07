<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\posts;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\posts>
 */
class PostsFactory extends Factory
{

    protected $model = posts::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //$table->string('nome');

           // $table->unsignedBigInteger('id_user');
           // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
           'nome' => $this->faker->unique()->word(),
           'id_user' => User::pluck('id')->random(),
           'text'=> $this->faker->text()
        ];
    }
}

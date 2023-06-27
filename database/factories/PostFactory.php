<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $option = [
            [
                "title" => "Dictionary",
                "description"=>"Oxford english dictionary used for one years",
                "image" => "images/oxfordeBook.jpg",
                "category_id"=>1
            ],
            [
                "title" => "Coffey Table",
                "description"=>"Small Coffey Table used for one year",
                "image" => "images/coffe table.jpg",
                "category_id"=>2
            ],
            [
                "title" => "Office chair",
                "description"=>"Used office chair like new",
                "image" => "images/officechair.jpg",
                "category_id"=>2
            ],
            [
                "title" => "Smart TV",
                "description"=>"A 40 inc smart tv used for three years",
                "image" => "images/smart tv.webp",
                "category_id"=>3
            ],
            [
                "title" => "Couch",
                "description"=>"couch used for two years",
                "image" => "images/couch.webp",
                "category_id"=>2
            ],
            [
                "title" => "three seat Couch",
                "description"=>"three seat couch",
                "image" => "images/couich.jpg",
                "category_id"=>2
            ],
            [
                "title" => "two seats Couch",
                "description"=>"two seats couch",
                "image" => "images/couch2.jpg",
                "category_id"=>2
            ],
            [
                "title" => "Dinner Table",
                "description"=>"Dinner table with eight chairs",
                "image" => "images/dinner table.jpg",
                "category_id"=>2
            ],
            [
                "title" => "Normal TV",
                "description"=>"used TV for one year",
                "image" => "images/tv.jpg",
                "category_id"=>3
            ]
        ];
        $userIds = User::pluck('id')->toArray();
        return [
            ...fake()->randomElement($option),
            'price' => fake()->randomFloat(2, 10, 1000),
            'user_id' => fake()->randomElement($userIds),
            'created_at'=> $this->faker->dateTimeBetween("-1 year", now()),
        ];
    }
}

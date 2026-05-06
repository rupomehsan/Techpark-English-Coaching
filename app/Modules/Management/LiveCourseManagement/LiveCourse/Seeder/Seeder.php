<?php
namespace App\Modules\Management\LiveCourseManagement\LiveCourse\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\LiveCourseManagement\LiveCourse\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->text(255),
                'description' => $faker->text,
                'live_course_type' => $faker->randomElement(array (
  0 => 'residential',
  1 => 'non_residential',
  2 => 'online',
)),
                'promo_video_url' => $faker->text(500),
                'course_features' => json_encode([$faker->word, $faker->word]),
                'course_specification' => json_encode([$faker->word, $faker->word]),
                'course_duration' => $faker->text(255),
                'thumbnail' => $faker->text(500),
                'total_seats' => $faker->randomNumber,
                'regular_price' => $faker->randomFloat(2, 0, 1000),
                'sale_price' => $faker->randomFloat(2, 0, 1000),
                'discount_percent' => $faker->randomFloat(2, 0, 1000),
                'installment_months' => $faker->randomNumber,
                'is_popular' => $faker->boolean,
                'sort_order' => $faker->randomNumber,
            ]);
        }
    }
}
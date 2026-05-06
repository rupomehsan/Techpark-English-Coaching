<?php
namespace App\Modules\Management\LiveCourseManagement\LiveCourseBatch\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\LiveCourseManagement\LiveCourseBatch\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourseBatch\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'live_course_id' => null,
                'batch_number' => $faker->sentence,
                'shift_name' => $faker->text(100),
                'course_start_date' => $faker->date,
                'course_end_date' => $faker->date,
                'class_start_time' => null,
                'class_end_time' => null,
                'class_days' => $faker->randomElement(array (
  0 => 'Sat',
  1 => 'Sun',
  2 => 'Mon',
  3 => 'Tue',
  4 => 'Wed',
  5 => 'Thu',
  6 => 'Fri',
)),
                'seats_remaining' => $faker->randomNumber,
                'enrolled_count' => $faker->randomNumber,
            ]);
        }
    }
}
<?php
namespace App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'student_id' => null,
                'batch_id' => null,
                'live_course_id' => null,
                'student_info' => json_encode([$faker->word, $faker->word]),
                'enrolled_at' => $faker->dateTime,
                'payment_status' => $faker->randomElement(array (
  0 => 'pending',
  1 => 'partial',
  2 => 'paid',
  3 => 'refunded',
)),
                'amount_paid' => $faker->randomFloat(2, 0, 1000),
                'transaction_id' => $faker->text(255),
                'amount' => $faker->randomFloat(2, 0, 1000),
                'payment_details' => json_encode([$faker->word, $faker->word]),
                'method' => $faker->text(100),
            ]);
        }
    }
}
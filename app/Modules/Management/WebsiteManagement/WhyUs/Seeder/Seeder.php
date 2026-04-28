<?php
namespace App\Modules\Management\WebsiteManagement\WhyUs\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\WebsiteManagement\WhyUs\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\WebsiteManagement\WhyUs\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'video_link' => $faker->text(250),
                'reasons' => json_encode([$faker->word, $faker->word]),
            ]);
        }
    }
}
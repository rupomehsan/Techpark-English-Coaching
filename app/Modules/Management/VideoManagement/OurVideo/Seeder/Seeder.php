<?php
namespace App\Modules\Management\VideoManagement\OurVideo\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\VideoManagement\OurVideo\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\VideoManagement\OurVideo\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();

        for ($i = 1; $i <= 100; $i++) {
            self::$model::create([                'video_category_id' => null,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'video_link' => $faker->text(250),
            ]);
        }
    }
}
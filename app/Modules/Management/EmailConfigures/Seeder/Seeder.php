<?php
namespace App\Modules\Management\EmailConfigures\Seeder;

use Illuminate\Database\Seeder as SeederClass;
use Faker\Factory as Faker;

class Seeder extends SeederClass
{
    /**
     * Run the database seeds.
     php artisan db:seed --class="App\Modules\Management\EmailConfigures\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\EmailConfigures\Models\Model::class;

    public function run(): void
    {
        $faker = Faker::create();
        self::$model::truncate();


            self::$model::create([
                'host' => "smtp.gmail.com",
                'port' => "587",
                'email' => "rupomehsan34@gmail.com",
                'username' => "rupomehsan34@gmail.com",
                'password' => "obxPMLnYKiuRtO6nSA350g==",
                'mail_from_name' => "Techpark English",
                'mail_from_email' => "rupomehsan34@gmail.com",
                'encryption' => "tls",
            ]);

    }
}

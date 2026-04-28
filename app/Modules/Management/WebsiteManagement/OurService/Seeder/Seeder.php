<?php
namespace App\Modules\Management\WebsiteManagement\OurService\Seeder;

use Illuminate\Database\Seeder as SeederClass;

class Seeder extends SeederClass
{
    /**
     * php artisan db:seed --class="App\Modules\Management\WebsiteManagement\OurService\Seeder\Seeder"
     */
    static $model = \App\Modules\Management\WebsiteManagement\OurService\Models\Model::class;

    public function run(): void
    {
        self::$model::truncate();

        $services = [
            [
                'icon'        => 'fa-solid fa-chalkboard-user',
                'title'       => 'দক্ষ প্রশিক্ষক',
                'description' => 'অভিজ্ঞ ও সার্টিফাইড প্রশিক্ষকদের তত্ত্বাবধানে ব্যক্তিগতকৃত শিক্ষণ পদ্ধতিতে ইংরেজি শিখুন।',
                'status'      => 'active',
            ],
            [
                'icon'        => 'fa-solid fa-globe',
                'title'       => 'ইন্টারেক্টিভ ক্লাস',
                'description' => 'সরাসরি কথোপকথন ও গ্রুপ ডিসকাশনের মাধ্যমে দ্রুত ইংরেজিতে দক্ষতা অর্জন করুন।',
                'status'      => 'active',
            ],
            [
                'icon'        => 'fa-solid fa-laptop',
                'title'       => 'অনলাইন ও অফলাইন',
                'description' => 'আপনার সুবিধামতো অনলাইন বা সরাসরি ক্লাসে অংশ নিন — যেকোনো ডিভাইস থেকে।',
                'status'      => 'active',
            ],
            [
                'icon'        => 'fa-solid fa-infinity',
                'title'       => 'আজীবন অ্যাক্সেস',
                'description' => 'রেকর্ডেড ভিডিও লেসন ও স্টাডি ম্যাটেরিয়ালে সারাজীবন বিনামূল্যে অ্যাক্সেস পান।',
                'status'      => 'active',
            ],
            [
                'icon'        => 'fa-solid fa-certificate',
                'title'       => 'সার্টিফিকেট প্রদান',
                'description' => 'কোর্স সম্পন্ন করার পর আন্তর্জাতিকভাবে স্বীকৃত সার্টিফিকেট প্রদান করা হয়।',
                'status'      => 'active',
            ],
            [
                'icon'        => 'fa-solid fa-headset',
                'title'       => '২৪/৭ সাপোর্ট',
                'description' => 'যেকোনো সমস্যায় আমাদের ডেডিকেটেড সাপোর্ট টিম সবসময় আপনার পাশে আছে।',
                'status'      => 'active',
            ],
        ];

        foreach ($services as $service) {
            self::$model::create($service);
        }
    }
}

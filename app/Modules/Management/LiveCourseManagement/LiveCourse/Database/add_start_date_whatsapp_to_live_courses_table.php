<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*
     php artisan migrate --path='/app/Modules/Management/LiveCourseManagement/LiveCourse/Database/add_start_date_whatsapp_to_live_courses_table.php'
     */
    public function up(): void
    {
        Schema::table('live_courses', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('sort_order');
            $table->string('whatsapp_group_link', 500)->nullable()->after('start_date');
        });
    }

    public function down(): void
    {
        Schema::table('live_courses', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'whatsapp_group_link']);
        });
    }
};

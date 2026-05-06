<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/LiveCourseManagement/LiveCourse/Database/create_live_courses_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->longtext('description')->nullable();
            $table->enum('live_course_type', ['residential','non_residential','online'])->nullable();
            $table->string('promo_video_url', 500)->nullable();
            $table->json('course_features')->nullable();
            $table->json('course_specification')->nullable();
            $table->string('course_duration', 255)->nullable();
            $table->string('thumbnail', 500)->nullable();
            $table->integer('total_seats')->nullable();
            $table->float('regular_price')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('discount_percent')->nullable();
            $table->integer('installment_months')->nullable();
            $table->tinyInteger('is_popular')->default(0);
            $table->integer('sort_order')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_courses');
    }
};
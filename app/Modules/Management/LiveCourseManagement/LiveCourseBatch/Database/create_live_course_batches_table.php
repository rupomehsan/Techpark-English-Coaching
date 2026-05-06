<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/LiveCourseManagement/LiveCourseBatch/Database/create_live_course_batches_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_course_batches', function (Blueprint $table) {
            $table->id();
            $table->string('live_course_id', 100)->nullable();
            $table->string('batch_number', 100)->nullable();
            $table->string('shift_name', 100)->nullable();
            $table->date('course_start_date')->nullable();
            $table->date('course_end_date')->nullable();
            $table->time('class_start_time')->nullable();
            $table->time('class_end_time')->nullable();
            $table->json('class_days')->nullable();
            $table->integer('seats_remaining')->nullable();
            $table->integer('enrolled_count')->nullable();

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
        Schema::dropIfExists('live_course_batches');
    }
};

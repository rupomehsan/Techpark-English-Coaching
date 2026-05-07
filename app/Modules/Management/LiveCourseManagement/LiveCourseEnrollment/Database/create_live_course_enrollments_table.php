<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/LiveCourseManagement/LiveCourseEnrollment/Database/create_live_course_enrollments_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('live_course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 100)->nullable();
            $table->string('batch_id', 100)->nullable();
            $table->string('live_course_id', 100)->nullable();
            $table->json('student_info')->nullable();
            $table->datetime('enrolled_at')->nullable();
            $table->enum('payment_status', ['pending','partial','paid','refunded'])->nullable();
            $table->float('amount_paid')->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->string('payment_photo', 255)->nullable();
            $table->float('amount')->nullable();
            $table->json('payment_details')->nullable();
            $table->string('method', 100)->nullable();

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
        Schema::dropIfExists('live_course_enrollments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/VideoManagement/OurVideo/Database/create_our_videos_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('our_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_category_id', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('video_link', 250)->nullable();

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
        Schema::dropIfExists('our_videos');
    }
};
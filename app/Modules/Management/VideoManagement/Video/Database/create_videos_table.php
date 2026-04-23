<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * php artisan migrate --path='/app/Modules/Management/VideoManagement/Video/Database/create_videos_table.php'
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('youtube_url', 500)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 80)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

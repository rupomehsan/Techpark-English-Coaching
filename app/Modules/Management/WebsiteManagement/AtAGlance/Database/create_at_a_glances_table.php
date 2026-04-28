<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/WebsiteManagement/AtAGlance/Database/create_at_a_glances_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('at_a_glances', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('number', 50)->nullable();

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
        Schema::dropIfExists('at_a_glances');
    }
};
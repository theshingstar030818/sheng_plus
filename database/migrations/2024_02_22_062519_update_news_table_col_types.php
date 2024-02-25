<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('title', 500)->change();
            $table->string('desc', 1000)->change();
            $table->string('url', 1000)->change();
            $table->string('img_path', 1000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('title', 255)->change(); // Change back to the original length
            $table->string('desc', 255)->change(); // Change back to the original length
            $table->string('url', 255)->change(); // Change back to the original length
            $table->string('img_path', 255)->change(); // Change back to the original length
        });
    }
};

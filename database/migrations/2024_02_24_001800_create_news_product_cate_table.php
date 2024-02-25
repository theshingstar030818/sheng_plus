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
        Schema::create('product_cates', function (Blueprint $table) {
            $table->id();

            $table->string('name', 500);
            $table->string('description', 1000)->nullable();
            $table->string('link', 500)->nullable();
            $table->integer('img');

            $table->string('dimension', 500);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_cates');
    }
};

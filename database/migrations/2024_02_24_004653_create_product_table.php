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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('name')->nullable()->index();
            $table->datetime('desc')->nullable();
            $table->string('dimension', 100)->nullable();

            $table->text('tab_one')->nullable();
            $table->integer('tab_one_img')->nullable();;

            $table->text('tab_two')->nullable();
            $table->integer('tab_two_img')->nullable();;

            $table->text('tab_three')->nullable();
            $table->integer('tab_three_img')->nullable();;

            $table->text('tab_four')->nullable();
            $table->integer('tab_four_img')->nullable();;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

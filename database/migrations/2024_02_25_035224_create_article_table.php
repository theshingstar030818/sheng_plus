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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_cate_id')->nullable()->index();
            $table->foreignId('product_cate_id')->nullable()->index();
            $table->datetime('published_date')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('img')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

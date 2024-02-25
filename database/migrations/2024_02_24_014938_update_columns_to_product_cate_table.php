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
        Schema::table('product_cates', function (Blueprint $table) {
            //
            $table->dropColumn('link');
            $table->dropColumn('dimension');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_cates', function (Blueprint $table) {
            //
        });
    }
};

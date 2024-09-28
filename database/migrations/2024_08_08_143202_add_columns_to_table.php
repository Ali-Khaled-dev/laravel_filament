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
        Schema::table('category_translation', function (Blueprint $table) {
            $table->json('meta_descreption');
            $table->string('slug');
            $table->json('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_translation', function (Blueprint $table) {
            $table->dropColumn('meta_descreption');
            $table->dropColumn('slug');
            $table->dropColumn('meta_keywords');
        });
    }
};

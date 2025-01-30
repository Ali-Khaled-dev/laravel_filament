<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('locale');
            $table->string('title');
            $table->string('slug');
            $table->string('short_descreption');
            $table->text('descreption');
            $table->json('meta_keywords');
            $table->unique(['locale', 'article_id']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_translations');
    }
};

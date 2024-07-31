<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('articals', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
        });

        Schema::create('artical_translation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artical_id');
            $table->string('locale');
            $table->string('title');
            $table->string('slug');
            $table->string('short_descreption');
            $table->text('descreption');
            $table->json('meta_keywords');
            $table->unique(['locale', 'artical_id']);
            $table->foreign('artical_id')->references('id')->on('articals')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('articals');
    }
};

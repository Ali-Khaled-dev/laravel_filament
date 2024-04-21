<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('thumbanil')->nullable();
            $table->string('slug');
            $table->text('tags')->nullable();
            $table->boolean('published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('post_translations', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content');
            $table->unique(['locale','post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        
        });

    }

    /**Comments
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_translations');

        Schema::dropIfExists('posts');
    }
};

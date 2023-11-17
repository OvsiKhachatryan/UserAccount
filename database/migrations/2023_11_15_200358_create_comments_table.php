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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('reply_comment_id')->nullable();
            $table->longText('comment_am');
            $table->longText('comment_en');
            $table->longText('comment_ru');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table){
            $table->foreign('reply_comment_id')
                ->references('id')->on('comments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

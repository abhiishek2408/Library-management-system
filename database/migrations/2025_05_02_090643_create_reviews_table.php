<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            // Foreign keys
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');

            // Review content
            $table->integer('rating')->checkBetween(1, 5);
            $table->string('title')->nullable();
            $table->text('review_text')->nullable();

            // Status & moderation
            $table->boolean('is_approved')->default(false);
            $table->enum('visibility', ['public', 'private'])->default('public');

            // Meta info
            $table->integer('likes_count')->default(0);
            $table->text('response')->nullable();

            // Foreign key constraints
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Optional: Composite primary key
            // $table->primary(['book_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

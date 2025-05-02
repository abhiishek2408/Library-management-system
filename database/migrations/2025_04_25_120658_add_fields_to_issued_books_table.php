<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('issued_books', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->decimal('cost_of_issue', 8, 2)->nullable();
            $table->decimal('penalty_per_day', 8, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('issued_books', function (Blueprint $table) {
            $table->dropColumn(['title', 'author', 'cost_of_issue', 'penalty_per_day']);
        });
    }
};


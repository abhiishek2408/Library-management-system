<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('issued_books', function (Blueprint $table) {
            $table->integer('pickup_timing')->nullable(); // in hours
            $table->timestamp('pickup_deadline')->nullable(); // to store the exact deadline
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issued_books', function (Blueprint $table) {
            //
        });
    }
};

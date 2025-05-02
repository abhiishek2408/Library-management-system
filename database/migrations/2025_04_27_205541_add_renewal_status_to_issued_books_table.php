<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In your migration file:
public function up()
{
    Schema::table('issued_books', function (Blueprint $table) {
        $table->enum('renewal_status', ['pending', 'approved', 'rejected'])->default('pending');
    });
}

public function down()
{
    Schema::table('issued_books', function (Blueprint $table) {
        $table->dropColumn('renewal_status');
    });
}

};

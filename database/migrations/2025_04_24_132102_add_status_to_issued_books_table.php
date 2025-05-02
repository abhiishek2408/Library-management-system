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
            $table->string('status')->default('issued'); // Possible values: issued, returned
        });
    }
    
    public function down()
    {
        Schema::table('issued_books', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
};

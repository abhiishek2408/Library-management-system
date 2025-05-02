<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add new columns to existing 'books' table.
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'isbn')) {
                $table->string('isbn')->nullable()->after('author');
            }
    
            if (!Schema::hasColumn('books', 'publisher')) {
                $table->string('publisher')->nullable()->after('isbn');
            }
    
            if (!Schema::hasColumn('books', 'edition')) {
                $table->string('edition')->nullable()->after('publisher');
            }
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'isbn',
                'publisher',
                'edition',
            ]);
        });
    }
};

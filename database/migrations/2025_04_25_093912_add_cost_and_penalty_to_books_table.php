<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'cost_of_issue')) {
                $table->decimal('cost_of_issue', 8, 2)->default(0)->after('edition');
            }

            if (!Schema::hasColumn('books', 'penalty_per_day')) {
                $table->decimal('penalty_per_day', 8, 2)->default(0)->after('cost_of_issue');
            }
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['cost_of_issue', 'penalty_per_day']);
        });
    }
};

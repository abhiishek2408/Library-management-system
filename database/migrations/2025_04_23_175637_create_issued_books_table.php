 <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// { 
    /**
     * Run the migrations.
     */
    // public function up()
    // {
    //     Schema::create('issued_books', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    //         $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
    //         $table->date('issue_date');
    //         $table->date('due_date');
    //         $table->date('return_date')->nullable();
    //         $table->boolean('renewed')->default(false);
    //         $table->boolean('reserved')->default(false);
    //         $table->timestamps();
    //     });
    // }
    


//     public function down(): void
//     {
//         Schema::dropIfExists('issued_books');
//     }
// };




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
        Schema::create('issued_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');

            // Nullable to support pending reservations
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();

            $table->boolean('renewed')->default(false);
           // $table->enum('status', ['issued', 'reserved', 'pending', 'cancelled'])->default('pending');
            $table->timestamp('reserved_at')->nullable(); // For queue tracking

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issued_books');
    }
};

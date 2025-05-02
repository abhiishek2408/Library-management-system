<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Table name is optional if it follows Laravel's default naming convention
    // protected $table = 'reviews'; // Uncomment if you need to specify a custom table name

    // Define the relationship with the Book model
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // You can also define the fillable or guarded properties if needed
    protected $fillable = [
        'book_id', 'user_id', 'rating', 'title', 'review_text', 'is_approved', 'visibility', 'likes_count', 'response',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBook extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'title',
        'author',
        'pickup_timing',
        'issue_date',
        'due_date',
        'return_date',
        'renewed',
        'payment_status',
        'issued_by',
        'category',
        'cost_of_issue',
        'penalty_per_day',
        'renewal_status',
        'reserved_at',
        'pickup_deadline',
    ];
    

    // Relationship: IssuedBook belongs to a Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relationship: IssuedBook belongs to a User (the one who reserved/issued)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional: Issuing librarian
    public function librarian()
    {
        return $this->belongsTo(User::class, 'librarian_id');
    }
}

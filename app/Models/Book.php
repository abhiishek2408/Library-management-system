<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'edition',
        'cost_of_issue',
        'penalty_per_day',
        'category',
        'quantity',
        'status',
        'availability',
        'review',
    ];


    // Relationships
    public function issuedBooks()
    {
        return $this->hasMany(IssuedBook::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

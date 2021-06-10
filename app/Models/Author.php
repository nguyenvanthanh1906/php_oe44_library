<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
    ];

    public function books()
    {

        return $this->belongsToMany(Book::class, 'author_books');
    }
}

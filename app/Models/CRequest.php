<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Book;

class CRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_day',
        'return_day',
        'is_approve',
        'delete_flag',
    ];

    public function book()
    {

        return $this->belongsTo(Book::class);
    }
    public function user()
    {

        return $this->belongsTo(User::class);
    }
    
}
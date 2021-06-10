<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function books()
    {

        return $this->hasMany(Book::class);
    }
}

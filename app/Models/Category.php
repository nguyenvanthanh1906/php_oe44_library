<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function books()
    {

        return $this->belongsTo(Book::class, 'book_categories');
    }

    public function childrent()
    {

        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {

        return $this->belongsTo(Category::class, 'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Puplisher;
use App\Models\Status;
use App\Models\Category;
use App\Models\Author;
use App\Models\CRequest;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'puplisher_id',
        'status_id',
        'thumbnail',
    ];

    public function puplisher()
    {

        return $this->belongsTo(Puplisher::class, 'puplisher_id');
    }

    public function status()
    {

        return $this->belongsTo(Status::class, 'status_id');
    }

    public function categories()
    {

        return $this->belongsTo(Category::class, 'book_categories');
    }
    public function authors()
    {

        return $this->belongsToMany(Author::class, 'author_books');
    }
    public function requests()
    {
        
        return $this->hasMany(CRequest::class);
    }
}

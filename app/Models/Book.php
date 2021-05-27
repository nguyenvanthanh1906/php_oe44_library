<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Puplisher;
use App\Models\Status;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'puplisher_id',
        'status_id',
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
}

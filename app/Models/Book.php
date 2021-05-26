<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Puplisher;
use App\Models\Status;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'puplisher_id',
        'status_id',
        'delete_flag',
    ];

    public function puplisher()
    {

        return $this->belongsTo(Puplisher::class, 'puplisher_id');
    }

    public function status()
    {

        return $this->belongsTo(Status::class, 'status_id');
    }
}

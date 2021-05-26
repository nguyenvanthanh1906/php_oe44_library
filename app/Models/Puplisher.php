<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puplisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_flag',
    ];

}

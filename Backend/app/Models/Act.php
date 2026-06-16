<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    protected $fillable = [
        'title',
        'description',
        'year',
        'file_path',
        'file_size'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'image_path',
        'stock',
        'status',
    ];

    // public function requests()
    // {
    //     return $this->hasMany(Request::class);
    // }
}



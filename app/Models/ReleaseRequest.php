<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReleaseRequest extends Model
{
        protected $fillable = [
        'user_id',
        'equipment_id',
        'purpose',
        'release_date',
        'status',
    ];    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocusArea extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'focus_areas'
    ];
    
    public function practitioner() {
        return $this->belongsToMany(Practitioner::class);
    }
}
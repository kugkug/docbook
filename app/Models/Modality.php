<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'modalities'
    ];
    
    public function practitioner() {
        return $this->belongsToMany(Practitioner::class);
    }
}
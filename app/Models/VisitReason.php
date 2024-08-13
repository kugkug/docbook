<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitReason extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'visit_reasons',
    ];

    public function practitioner() {
        return $this->belongsToMany(Practitioner::class);
    }
}
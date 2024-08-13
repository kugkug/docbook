<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalSuffix extends Model
{
    use HasFactory;

    protected $table = 'professional_suffixes';
    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
    ];
}
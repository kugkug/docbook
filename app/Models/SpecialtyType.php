<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyType extends Model
{
    use HasFactory;

    protected $table = 'specialty_types';
    
    protected $fillable = ['specialty_name'];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at',
        'pivot',
    ];
}
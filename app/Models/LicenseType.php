<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    use HasFactory;

    protected $fillable = ['license_name', 'license_abbreviation'];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at',
        'license_types_pivot'
    ];
}
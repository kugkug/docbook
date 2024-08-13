<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faith extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at',
    ];
}
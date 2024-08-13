<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $hidden = [
        'parent_id',
        'created_at', 
        'updated_at',
    ];
}
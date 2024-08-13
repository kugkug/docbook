<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = [
        'created_at', 
        'updated_at',
        'id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function gender_type(): HasOne{
        return $this->hasOne(GenderType::class, 'id');
    }
    
}
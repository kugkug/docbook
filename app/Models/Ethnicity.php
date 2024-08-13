<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Ethnicity extends Model
{
    use HasFactory;

    protected $fillable = ['ethnicity_name'];

    protected $hidden = [
        'created_at', 
        'updated_at',
    ];

    // public function creator(): BelongsTo {
    //     return $this->belongsTo(User::class, 'creator_id');
    // }

    // protected static function booted(): void {
    //     static::addGlobalScope('creator', function(Builder $builder) {
    //         $builder->where('creator_id', Auth::id());
    //     });
    // }
}
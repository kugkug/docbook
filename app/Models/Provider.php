<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'creator_id'];

    public const rules = ['name' => 'required|string|max:255'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // protected static function booted(): void {
    //     static::addGlobalScope('creator', function(Builder $builder) {
    //         $builder->where('creator_id', Auth::id());
    //     });
    // }
}
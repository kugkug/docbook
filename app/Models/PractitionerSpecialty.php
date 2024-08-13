<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PractitionerSpecialty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at',
        'pivot',
        'id',
        'parent_id',
        'specialty_type_id'
    ];

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function specialty(): BelongsToMany {
        return $this->belongsToMany(SpecialtyType::class, 'practitioner_specialties', 'id');
    }

    

    // protected static function booted(): void {
    //     static::addGlobalScope('creator', function(Builder $builder) {
    //         $builder->where('creator_id', Auth::id());
    //     });
    // }

}
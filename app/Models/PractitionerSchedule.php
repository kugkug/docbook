<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PractitionerSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'practitioners_schedules';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'pivot'];

    protected $guarded = [];

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // protected static function booted(): void {
    //     static::addGlobalScope('creator', function(Builder $builder) {
    //         $builder->where('creator_id', Auth::id());
    //     });
    // }

    public function practitioners(): BelongsToMany {
        return $this->belongsToMany(Practitioner::class, 'patient_practitioner_schedule')->withTimestamps();
    }

    public function patients(): BelongsToMany {
        return $this->belongsToMany(Patient::class, 'patient_practitioner_schedule')->withTimestamps();
    }
}
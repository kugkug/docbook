<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AcceptedVisit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at', 
        'updated_at',
        'deleted_at',
        'id',
        'parent_id',
    ];

    protected $casts = [
        'video_visit' => 'boolean',
        'in_person_visit' => 'boolean'
    ];

    
    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

}
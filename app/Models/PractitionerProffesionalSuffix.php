<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PractitionerProffesionalSuffix extends Model
{
    use HasFactory;

    protected $table = 'practitioner_professional_suffixes';

    protected $guarded = [];

    protected $hidden = [
        'id',
        'parent_id',
        'professional_suffix_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function suffix(): BelongsToMany {
        return $this->belongsToMany(ProfessionalSuffix::class, 'practitioner_professional_suffixes', 'id');
    }
}
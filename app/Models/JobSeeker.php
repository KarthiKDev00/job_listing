<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobSeeker extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'phone',
        'experience',
        'notice_period',
        'skills',
        'resume',
        'photo',
    ];

    protected $casts = [
        'experience' => 'decimal:1',
    ];



    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}

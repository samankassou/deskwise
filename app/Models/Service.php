<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * Get the department of the service.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    /**
     * Get the employees of the service.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

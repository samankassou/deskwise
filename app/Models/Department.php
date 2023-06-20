<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    /**
     * Get the management of the department.
     */
    public function management(): BelongsTo
    {
        return $this->belongsTo(Management::class);
    }
    /**
     * Get the services for the department.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}

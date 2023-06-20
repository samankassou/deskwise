<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Management extends Model
{
    use HasFactory;

    /**
     * Get the departments for the management.
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    /**
     * Get the sub types.
     */
    public function subTypes(): HasMany
    {
        return $this->hasMany(SubType::class);
    }
}

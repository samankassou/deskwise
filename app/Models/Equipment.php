<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    /**
     * Get the sub type of the equipment.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}

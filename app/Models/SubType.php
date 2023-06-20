<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubType extends Model
{
    use HasFactory;

        /**
     * Get the type of the sub type.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}

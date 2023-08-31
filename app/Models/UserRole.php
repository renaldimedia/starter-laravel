<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class UserRole extends Model
{
    use HasFactory;

    protected $table = "model_has_roles";

    /**
     * Get the parent imageable model (user or post).
     */
    public function userable(): MorphTo
    {
        return $this->morphTo();
    }
}

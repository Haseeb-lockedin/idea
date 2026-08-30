<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StepFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    /** @use HasFactory<StepFactory> */
    use HasFactory;

    protected $attributes = [
        'completed' => false,
    ];

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
}

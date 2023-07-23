<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1,
        STATUS_INACTIVE = 0;

    public static function availableStatuses(): array
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ];
    }

    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at',
        'title',
        'content',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rating(): MorphOne
    {
        return $this->morphOne(Feedback::class, 'entity');
    }
}

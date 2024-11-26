<?php

namespace App\Models;

use App\Observers\MessageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([MessageObserver::class])]
class Message extends Model
{
    use HasFactory;

    const STATUS_SENT = 'sent';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';
    protected $keyType = 'string';

    protected $fillable = [
        'content',
        'receiver',
        'status',
    ];

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeSent(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_SENT);
    }

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }
}

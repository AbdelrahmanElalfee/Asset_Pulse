<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hardware extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'make',
        'model',
        'serial_number',
        'operating_system',
        'operating_system_version',
        'type',
        'cpu',
        'ram',
        'status',
        'user_id',
        'provider_id',
        'purchase_date',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(
            Provider::class,
            'provider_id',
        );
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
        );
    }
}
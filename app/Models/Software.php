<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Software extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'status',
        'licenses',
        'provider_id',
        'purchase_date',
        'expiry_date',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'expiry_date' => 'datetime',
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
}
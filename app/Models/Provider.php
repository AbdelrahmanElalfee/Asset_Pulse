<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * @return HasMany
     */
    public function hardwares(): HasMany
    {
        return $this->hasMany(
            Hardware::class,
            'provider_id',
        );
    }

    /**
     * @return HasMany
     */
    public function peripherals(): HasMany
    {
        return $this->hasMany(
            Peripheral::class,
            'provider_id',
        );
    }

    /**
     * @return HasMany
     */
    public function softwares(): HasMany
    {
        return $this->hasMany(
            Software::class,
            'provider_id',
        );
    }
}
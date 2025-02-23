<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int  $id
 * @property float $total
 * @property CarbonImmutable $start_date
 * @property-write string $start_date
 * @property CarbonImmutable $end_date
 * @property-write string $end_date
 * @property Currency $currency
 * @property Collection<int,Age> $ages
 */
class Quotation extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'immutable_date',
            'end_date' => 'immutable_date',
        ];
    }

    /**
     * @return Attribute<float,void>
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->ages->sum('pivot.value'),
        );
    }

    /**
     * @return BelongsTo<Currency,$this>
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return BelongsToMany<Age,$this>
     */
    public function ages(): BelongsToMany
    {
        return $this->belongsToMany(Age::class)->withPivot('value');
    }
}

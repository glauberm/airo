<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Age;
use App\Models\Currency;
use App\Models\Quotation;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class QuotationService
{
    public const int FIXED_RATE = 3;

    /**
     * @param  int[]  $age
     */
    public function buildQuotation(array $age, string $currency_id, string $start_date, string $end_date): Quotation
    {
        $quotation = new Quotation;

        $quotation->start_date = $start_date;

        $quotation->end_date = $end_date;

        $quotation->currency()->associate(Currency::find($currency_id));

        $quotation->save();

        $ages = Age::whereIn('age', $age)->get();

        $ages = $this->ensureDuplicatedAges($age, $ages);

        foreach ($ages as $age) {
            $value = $this->calculateValue((float) $age->load, $quotation->start_date, $quotation->end_date);

            $quotation->ages()->attach($age, ['value' => $value]);
        }

        return $quotation;
    }

    public function calculateValue(float $load, CarbonImmutable $startDate, CarbonImmutable $endDate): float
    {
        $numOfDays = $startDate->startOfDay()->diffInDays($endDate->endOfDay(), true);

        return round(self::FIXED_RATE * $load * ceil($numOfDays));
    }

    /**
     * @param  int[] $ages
     * @param  EloquentCollection<int,Age> $agesModels
     * @return Collection<int,Age>
     */
    private function ensureDuplicatedAges(array $ages, EloquentCollection $agesModels): Collection
    {
        $withPossibleDuplicates = collect();

        foreach ($ages as $age) {
            $withPossibleDuplicates->push($agesModels->firstWhere('age', $age));
        }

        return $withPossibleDuplicates;
    }
}

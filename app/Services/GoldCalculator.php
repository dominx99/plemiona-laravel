<?php

namespace App\Services;

use App\Http\Repositories\VillageRepository;
use App\Village;
use Carbon\Carbon;

class GoldCalculator
{
    /**
     * @var \App\Http\Repositories\VillageRepository
     */
    protected $villages;

    /**
     * @param \App\Http\Repositories\VillageRepository $villages
     */
    public function __construct(VillageRepository $villages)
    {
        $this->villages = $villages;
    }

    /**
     * @param \App\Village $village
     * @return integer
     */
    public function calculate(Village $village): int
    {
        $diff     = $village->last_active->diffInSeconds(Carbon::now());
        $perLevel = config('game.gold_per_level');
        $level    = $this->villages->getBuildingLevelByType($village, 'gold_mine');

        return $diff * $perLevel * $level;
    }
}

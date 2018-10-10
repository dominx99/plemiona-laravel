<?php

namespace App\Services;

use App\Village;
use App\Services\FoodCalculator;
use App\Services\GoldCalculator;

class ResourcesManager
{
    /**
     * @var \App\Services\FoodCalculator
     */
    protected $foodCalculator;

    /**
     * @var \App\Services\GoldCalculator
     */
    protected $goldCalculator;

    public function __construct(
        FoodCalculator $foodCalculator,
        GoldCalculator $goldCalculator
    ) {
        $this->foodCalculator = $foodCalculator;
        $this->goldCalculator = $goldCalculator;
    }

    /**
     * @param \App\Village $village
     * @return void
     */
    public function recalculate(Village $village): void
    {
        $this->addFood($village);
        $this->addGold($village);
    }

    /**
     * @param \App\Village $village
     * @return void
     */
    public function addFood(Village $village): void
    {
        $village->resources->increment(
            'food',
            $this->foodCalculator->calculate($village)
        );
    }

    /**
     * @param \App\Village $village
     * @return void
     */
    public function addGold(Village $village): void
    {
        $village->resources->increment(
            'gold',
            $this->goldCalculator->calculate($village)
        );
    }
}

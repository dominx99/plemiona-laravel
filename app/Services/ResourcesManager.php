<?php

namespace App\Services;

use App\Village;

class ResourcesManager
{
    /**
     * @param \App\Village $village
     * @param integer $food
     * @return void
     */
    public function addFood(Village $village, int $food): void
    {
        $village->resources->increment('food', $food);
    }

    /**
     * @param \App\Village $village
     * @param integer $gold
     * @return void
     */
    public function addGold(Village $village, int $gold): void
    {
        $village->resources->increment('gold', $gold);
    }
}

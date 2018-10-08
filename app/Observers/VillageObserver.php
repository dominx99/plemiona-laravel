<?php

namespace App\Observers;

use App\Village;

class VillageObserver
{
    public function created(Village $village): void
    {
        $village->resources()->create([
            'food' => config('game.start_food'),
            'gold' => config('game.start_gold'),
        ]);
    }
}

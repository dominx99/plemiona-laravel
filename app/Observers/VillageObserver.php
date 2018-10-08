<?php

namespace App\Observers;

use App\Http\Repositories\BuildingRepository;
use App\Village;

class VillageObserver
{
    /**
     * @var \App\Http\Repositories\BuildingRepository
     */
    protected $buildings;

    /**
     * @param \App\Http\Repositories\BuildingRepository $buildings
     */
    public function __construct(BuildingRepository $buildings)
    {
        $this->buildings = $buildings;
    }

    /**
     * @param \App\Village $village
     * @return void
     */
    public function created(Village $village): void
    {
        $village->resources()->create([
            'food' => config('game.start_food'),
            'gold' => config('game.start_gold'),
        ]);

        foreach (config('buildings.all') as $building) {
            $village->buildings()->attach(
                $this->buildings->findByType($building['type'])->id
            );
        }
    }
}

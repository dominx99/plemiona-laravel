<?php

namespace App\Observers;

use App\Http\Repositories\BuildingRepository;
use App\Village;
use App\Services\ResourcesManager;

class VillageObserver
{
    /**
     * @var \App\Http\Repositories\BuildingRepository
     */
    protected $buildings;

    /**
     * @var \App\Services\ResourcesManager
     */
    protected $resourcesManager;

    /**
     * @param \App\Http\Repositories\BuildingRepository $buildings
     */
    public function __construct(
        BuildingRepository $buildings,
        ResourcesManager $resourcesManager
    ) {
        $this->buildings = $buildings;
        $this->resourcesManager = $resourcesManager;
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
                $this->buildings->findByType($building['type'])->id,
                ['level' => $building['level']]
            );
        }
    }

    /**
     * @param \App\Village $village
     * @return void
     */
    public function retrieved(Village $village): void
    {
        $this->resourcesManager->recalculate($village);
    }
}

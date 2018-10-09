<?php

namespace App\Http\Repositories;

use App\Building;
use App\Village;

class VillageRepository extends AbstractRepository
{
    /**
     * @param integer $x
     * @param integer $y
     * @return boolean
     */
    public function existsByCoordinates(int $x, int $y): bool
    {
        return Village::where('x', $x)->where('y', $y)->exists();
    }

    public function findBuildingByType(Village $village, string $type): Building
    {
        return $village->buildings()->where('type', $type)->first();
    }

    public function getBuildingLevelByType(Village $village, string $type): int
    {
        $building = $this->findBuildingByType($village, $type);

        return $building->pivot->level;
    }
}

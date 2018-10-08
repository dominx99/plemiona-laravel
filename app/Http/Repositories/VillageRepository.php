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

    public function getBuildingByType(Village $village, string $type): Building
    {
        return $village->buildings()->where('type', $type)->first();
    }

    public function getBuildingLevel(Village $village, string $type): int
    {
        $building = $this->getBuildingByType($village, $type);

        echo json_encode($building, JSON_PRETTY_PRINT);
        die();
    }
}

<?php

namespace App\Http\Repositories;

use App\Building;

class BuildingRepository extends AbstractRepository
{
    public function findByType(string $type): Building
    {
        return Building::where('type', $type)->first();
    }
}

<?php

namespace App\Http\Repositories;

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
}

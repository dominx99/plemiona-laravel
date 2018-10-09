<?php

namespace Tests\Feature\Services;

use App\Services\FoodCalculator;
use App\Services\GoldCalculator;
use App\Services\ResourcesManager;
use App\Village;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Database;
use Tests\TestCase;

class ResourcesManagerTest extends TestCase
{
    use Database, RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function that_resources_manager_has_possibility_to_add_resources_to_village()
    {
        $village = factory(Village::class)->create([
            'last_active' => Carbon::now()->subSeconds(5),
        ]);

        $food = app(FoodCalculator::class)->calculate($village);
        $gold = app(GoldCalculator::class)->calculate($village);

        $expectedFood = $village->resources->food + $food;
        $expectedGold = $village->resources->gold + $gold;

        $resourcesManager = app(ResourcesManager::class);

        $resourcesManager->addFood($village, $food);
        $resourcesManager->addGold($village, $gold);

        $this->assertEquals($expectedFood, $village->resources->food);
        $this->assertEquals($expectedGold, $village->resources->gold);
    }
}

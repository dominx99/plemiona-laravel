<?php

namespace Tests\Feature\Observers;

use App\Village;
use Carbon\Carbon;
use Tests\Database;
use Tests\TestCase;
use App\Services\FoodCalculator;
use App\Services\GoldCalculator;
use App\Observers\VillageObserver;
use App\Services\ResourcesManager;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VillageObserverTest extends TestCase
{
    use Database, RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function that_resources_are_added_to_village_on_retrieved()
    {
        $village = factory(Village::class)->create([
            'last_active' => Carbon::now()->subSeconds(15),
        ]);

        $expectedFood = app(FoodCalculator::class)->calculate($village) + $village->resources->food;
        $expectedGold = app(GoldCalculator::class)->calculate($village) + $village->resources->gold;

        app(VillageObserver::class)->retrieved($village);

        $this->assertEquals(
            $expectedFood,
            $village->resources->food
        );

        $this->assertEquals(
            $expectedGold,
            $village->resources->gold
        );
    }
}

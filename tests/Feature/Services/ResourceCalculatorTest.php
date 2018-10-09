<?php

namespace Tests\Feature\Services;

use App\Http\Repositories\VillageRepository;
use App\Services\FoodCalculator;
use App\Services\GoldCalculator;
use App\Village;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Database;
use Tests\TestCase;

class ResourceCalculator extends TestCase
{
    use Database, RefreshDatabase;

    /**
     * @var \App\Services\FoodCalculator
     */
    protected $foodCalculator;

    /**
     * @var \App\Services\GoldCalculator
     */
    protected $goldCalculator;

    /**
     * @var \App\Http\Repositories\VillageRepository
     */
    protected $villages;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->foodCalculator = app(FoodCalculator::class);
        $this->goldCalculator = app(GoldCalculator::class);
        $this->villages       = app(VillageRepository::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function test_that_food_calculator_calculates_well()
    {
        $seconds = 5;

        $village = factory(Village::class)->create([
            'last_active' => Carbon::now()->subSeconds($seconds),
        ]);

        $farmLevel = $this->villages->getBuildingLevelByType($village, 'farm');

        $expected = $seconds * config('game.food_per_level') * $farmLevel;

        $this->assertEquals(
            $expected,
            $this->foodCalculator->calculate($village)
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function test_that_gold_calculator_calculates_well()
    {
        $seconds = 5;

        $village = factory(Village::class)->create([
            'last_active' => Carbon::now()->subSeconds($seconds),
        ]);

        $goldMineLevel = $this->villages->getBuildingLevelByType($village, 'gold_mine');

        $expected = $seconds * config('game.gold_per_level') * $goldMineLevel;

        $this->assertEquals(
            $expected,
            $this->goldCalculator->calculate($village)
        );
    }
}

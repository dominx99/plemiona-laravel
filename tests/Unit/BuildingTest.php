<?php

namespace Tests\Unit;

use App\Building;
use App\Http\Repositories\VillageRepository;
use App\Village;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Database;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    use Database, RefreshDatabase;

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

        $this->villages = app(VillageRepository::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_data_has_been_seed()
    {
        $this->artisan('buildings:prepare');

        $expected = count(config('buildings.all'));

        $count = Building::get();

        $this->assertCount($expected, $count);
    }

    /**
     * @test
     *
     * @return void
     */
    public function test_that_building_can_be_upgraded()
    {
        $village = factory(\App\Village::class)->create();

        $building = $this->villages->findBuildingByType($village, 'farm');

        $expected = $building->pivot->level + 1;

        $building->upgrade();

        $this->assertEquals($expected, $building->pivot->level);
    }
}

<?php

namespace Tests\Feature\Village;

use App\Http\Repositories\VillageRepository;
use App\Village;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Database;
use Tests\TestCase;

class VillageTest extends TestCase
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
    public function that_resources_are_created_on_village_created()
    {
        $village = factory(Village::class)->create();

        $this->assertNotEmpty($village->resources);
        $this->assertInstanceOf(\App\Resource::class, $village->resources);
        $this->assertEquals(
            config('game.start_food'),
            $village->resources->food
        );
        $this->assertEquals(
            config('game.start_gold'),
            $village->resources->gold
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_has_buildings_relation()
    {
        $village = factory(Village::class)->make();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $village->buildings);
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_buildings_are_assigned_to_village()
    {
        $village = factory(Village::class)->create();

        $this->assertNotEmpty($village->buildings);

        $this->assertDatabaseHas('building_village', [
            'building_id' => $village->buildings()->first()->id,
            'village_id'  => $village->id,
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_can_get_building_level_by_type()
    {
        $village = factory(Village::class)->create();

        $this->assertEquals(
            1,
            $this->villages->getBuildingLevelByType($village, 'fortress')
        );
    }
}

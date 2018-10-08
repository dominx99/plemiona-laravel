<?php

namespace Tests\Feature\Village;

use App\Village;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VillageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function that_resources_are_created_on_village_created()
    {
        $village = factory(Village::class)->create();

        $this->assertNotEmpty($village->resources);
        $this->assertEquals(
            config('game.start_food'),
            $village->resources->food
        );
        $this->assertEquals(
            config('game.start_gold'),
            $village->resources->gold
        );
    }
}

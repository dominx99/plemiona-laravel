<?php

namespace Tests\Unit;

use App\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Database;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    use Database, RefreshDatabase;

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
}

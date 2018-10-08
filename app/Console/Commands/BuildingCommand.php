<?php

namespace App\Console\Commands;

use App\Building;
use Illuminate\Console\Command;

class BuildingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buildings:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares all buildings needed to game.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Building::truncate();

        foreach (config('buildings.all') as $building) {
            Building::create($building);
        }
    }
}

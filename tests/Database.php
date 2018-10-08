<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

trait Database
{
    use DatabaseMigrations {
        DatabaseMigrations::runDatabaseMigrations as parentRunDatabaseMigrations;
    }

    public function runDatabaseMigrations()
    {
        $this->parentRunDatabaseMigrations();
        $this->artisan('buildings:prepare');
    }
}

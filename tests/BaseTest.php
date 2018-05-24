<?php

namespace Railken\LaraCommandTest\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Application as Artisan;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        Artisan::starting(function ($artisan) {
            $artisan->resolveCommands([Laravel\DummyCommand::class]);
        });
    }
}

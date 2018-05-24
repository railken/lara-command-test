<?php

namespace Railken\LaraCommandTest\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Railken\LaraCommandTest\GeneratorCommandTestable;

class CommandTest extends BaseTest
{
    public function testConfirm()
    {

    	$generator = new GeneratorCommandTestable(__DIR__ . "/../var/cache");
    	$generator->fromCommand(Laravel\DummyCommand::class);
    	$generator->withInput([
        	'yes'
        ]);
        $command = $generator->generate();

        \Illuminate\Console\Application::starting(function ($artisan) use ($command) {
            $artisan->resolveCommands([$command->getTestable()]);
        });

        $result = Artisan::call($command->getTestable());

        $this->assertEquals(1, $result);
    }
}

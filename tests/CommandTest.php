<?php

namespace Railken\LaraCommandTest\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Railken\LaraCommandTest\GeneratorCommandTestable;
use Railken\LaraCommandTest\Helper;

class CommandTest extends BaseTest
{
    public function testGenerator()
    {
        $generator = new GeneratorCommandTestable(__DIR__ . "/../var/cache");
        $generator->fromCommand(Laravel\DummyCommand::class);
        $generator->withInput([
            'yes',
            'Hello'
        ]);
        $command = $generator->generate();

        \Illuminate\Console\Application::starting(function ($artisan) use ($command) {
            $artisan->resolveCommands([$command->getTestable()]);
        });

        $result = Artisan::call($command->getTestable());
        
        $this->assertEquals(1, $result);
    }

    public function testHelper1()
    {
        $helper = new Helper(__DIR__ . "/../var/cache");
        $command = $helper->generate(Laravel\DummyCommand::class, [
            'yes',
            'Hello'
        ]);
        $result = $helper->call($command, []);
        
        $this->assertEquals(1, $result);
    }

    public function testHelper2()
    {
        $helper = new Helper(__DIR__ . "/../var/cache");
        $command = $helper->generate(Laravel\DummyCommand::class, [
            'yes',
            'Hello'
        ]);
        $result = $helper->call($command, []);
        
        $this->assertEquals(1, $result);
    }
}

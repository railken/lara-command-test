<?php

namespace Railken\LaraCommandTest\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Railken\LaraCommandTest\CommandContainer;

class CommandTest extends BaseTest
{
    public function testConfirm()
    {
        Artisan::call((new CommandContainer(Laravel\DummyCommand::class))->withInput([
        	'yes'
        ])->handle());
    }
}

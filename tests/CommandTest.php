<?php

namespace Railken\LaraCommandTest\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

class CommandTest extends BaseTest
{
    public function testConfirm()
    {
        Artisan::call(Laravel\DummyCommand::class);
    }
}

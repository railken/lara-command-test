<?php

namespace Railken\LaraCommandTest;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Application;

class Helper
{
    /**
     * @var GeneratorCommandTestable
     */
    protected $root;

    /**
     * @param string $root
     */
    public function __construct(string $root = null)
    {
        $this->generator = new GeneratorCommandTestable($root);
    }

    /**
     * Call a console command.
     *
     * @param string  $command
     * @param array   $arguments
     * @param array   $input
     *
     * @return int
     */
    public function call($command, array $arguments = [], array $input = [])
    {
        $generator = $this->generator;
        $generator->fromCommand($command);
        $generator->withInput($input);
        $command = $generator->generate();

        Application::starting(function ($artisan) use ($command) {
            $artisan->resolveCommands([$command->getTestable()]);
        });

        return Artisan::call($command->getTestable());
    }
}

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
    protected $generator;

    /**
     * @param string $root
     */
    public function __construct(string $root = null)
    {
        $this->generator = new GeneratorCommandTestable($root);
    }

    /**
     * Generate and register a console command.
     *
     * @param string  $command
     * @param array   $input
     *
     * @return CommandContainer
     */
    public function generate($command, array $input = [])
    {
        $generator = $this->generator;
        $generator->fromCommand($command);
        $generator->withInput($input);
        $command = $generator->generate();

        Application::starting(function ($artisan) use ($command) {
            $artisan->resolveCommands([$command->getTestable()]);
        });

        return $command;
    }

    /**
     * Call a console command.
     *
     * @param CommandContainer  $command
     *
     * @return int
     */
    public function call($command, array $arguments = [])
    {
        return Artisan::call($command->getTestable());
    }
}

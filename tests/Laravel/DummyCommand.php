<?php

namespace Railken\LaraCommandTest\Tests\Laravel;

use Illuminate\Console\Command;

class DummyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dummy';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm("Should we go?")) {

            $response = $this->ask('Is it hello?');

            print_r($response);
            
            return $response === 'Hello' ? 1 : 0;
        }

        return 0;
    }
}

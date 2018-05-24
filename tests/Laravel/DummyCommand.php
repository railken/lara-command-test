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
            $this->info("All go");
        }
    }
}

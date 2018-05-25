# lara-command-test

[![Build Status](https://travis-ci.org/railken/lara-command-test.svg?branch=master)](https://travis-ci.org/railken/lara-command-test)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A laravel package to call commands that have prompt inputs 

## Simple usage

```php
use Illuminate\Console\Command;

class DummyCommand extends Command
{

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm("Should we go?")) {

            $response = $this->ask('Is it hello?');
            
            return $response === 'Hello' ? 1 : 0;
        }

        return 0;
    }
}

```


```php
use Railken\LaraCommandTest\Helper;

$helper = new Helper(__DIR__ . "/../var/cache");
$command = $helper->generate(DummyCommand::class, [
    'yes',
    'Hello'
]);
$helper->call($command, []);

```
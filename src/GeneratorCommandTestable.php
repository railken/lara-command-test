<?php

namespace Railken\LaraCommandTest;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class GeneratorCommandTestable
{
    /**
     * @var string
     */
    protected $command;

    /**
     * @var array
     */
    protected $input;

    /**
     * @var string
     */
    protected $root;


    /**
     * @param string $root
     */
    public function __construct(string $root = null)
    {
        $this->root = $root ? $root : sys_get_temp_dir();
        $this->root .= "/tmp";
        $this->cleanupRoot();
    }

    /**
     * Cleanup root
     */
    public function cleanupRoot() 
    {
        $path = $this->root;

        if (!file_exists($path)) {
            return;
        }

        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($it as $file) {
            if (in_array($file->getBasename(), array('.', '..'))) {
                continue;
            } elseif ($file->isDir()) {
                rmdir($file->getPathname());
            } elseif ($file->isFile() || $file->isLink()) {
                unlink($file->getPathname());
            }
        }
        rmdir($path);
    }

    /**
     * @param string $class_command
     */
    public function fromCommand(string $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @param array $input
     *
     * @return $this
     */
    public function withInput(array $input)
    {
        $this->input = $input;
    
        return $this;
    }

    /**
     * Get next available version number command
     *
     * @param string $file
     *
     * @return string
     */
    public function getAvailableVersionNumberCommand(string $file)
    {
        $version = 0;

        do {
            $destination = $this->getFullDestinationName($file, ++$version);
        } while (file_exists($destination));

        return $version;
    }

    /**
     * Get full destination name
     *
     * @param string $file
     * @param int $version
     *
     * @return string
     */
    public function getFullDestinationName(string $file, int $version)
    {
        return $this->root . "/" . $file . "_" . $version . ".php";
    }

    /**
     * Generate command
     *
     * @return CommandContainer
     */
    public function generate()
    {
        $command = $this->command;

        $file = str_replace("\\", "/", $command);

        $version = $this->getAvailableVersionNumberCommand($file);
        $destination = $this->getFullDestinationName($file, $version);


        $namespace = str_replace("/", "\\", dirname($file));
        $class = basename($file) . "Testable" . $version;
        $signature = "testable";

        if (!file_exists(dirname($destination))) {
            mkdir(dirname($destination), 0755, true);
        }

        $input = (new Collection($this->input))->map(function ($input) {
            return "'".$input."'";
        })->implode(",");

        $content = str_replace(
            ['${{namespace}}', '${{class}}', '${{signature}}', '${{extends}}', '${{input}}'],
            [$namespace, $class, $signature, "\\".$command, $input],
            file_get_contents(__DIR__ ."/stubs/CommandTestable.php.stub")
        );

        file_put_contents($destination, $content);

        require_once $destination;

        return new CommandContainer($command, $namespace."\\".$class);
    }
}

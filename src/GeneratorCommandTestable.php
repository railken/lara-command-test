<?php

namespace Railken\LaraCommandTest;

use Roave\BetterReflection\BetterReflection;

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
	public function __construct(string $root)
	{
		$this->root = $root;
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
	 * Generate command
	 *
	 * @return CommandContainer
	 */
	public function generate()
	{
		$command = $this->command;

		$file = str_replace("\\", "/", $command);
		$namespace = str_replace("/", "\\", dirname($file));
		$class = basename($file)."Testable";
		$signature = "testable";


		$destination = $this->root . "/" . $file . ".php";

		if (!file_exists(dirname($destination))) {
			mkdir(dirname($destination), 0755, true);
		}

		$content = str_replace(
		    ['${{namespace}}', '${{class}}', '${{signature}}', '${{extends}}'],
		    [$namespace, $class, $signature, "\\".$command],
		    file_get_contents(__DIR__ ."/stubs/CommandTestable.php.stub")
		);

		file_put_contents($destination, $content);

		require_once $destination;

		return new CommandContainer($command, $namespace."\\".$class);
	}
}
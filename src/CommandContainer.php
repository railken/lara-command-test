<?php

namespace Railken\LaraCommandTest;

class CommandContainer
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
	 * @param string $class_command
	 */
	public function __construct(string $command)
	{
		$this->command = $command;
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
	 * Handle the command creating a new one that handle input.
	 *
	 * @return string
	 */
	public function handle()
	{
		return $this->command;
	}
}
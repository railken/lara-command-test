<?php

namespace Railken\LaraCommandTest;

use Roave\BetterReflection\BetterReflection;

class CommandContainer
{	
	/**
	 * @var array
	 */
	protected $original;

	/**
	 * @var string
	 */
	protected $testable;

	/**
	 * @param string $original
	 * @param string $testable
	 */
	public function __construct(string $original, string $testable)
	{
		$this->original = $original;
		$this->testable = $testable;
	}

	/**
	 * @return string
	 */
	public function getTestable()
	{
		return $this->testable;
	}

	/**
	 * @return string
	 */
	public function getOriginal()
	{
		return $this->original;
	}
}
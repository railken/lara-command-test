<?php

namespace Railken\LaraCommandTest;

trait TestableInputTrait
{	
	/**
	 * @var int
	 */
    protected $testableCounter = 0;

    /**
     * Confirm a question with the user.
     *
     * @param  string  $question
     * @param  bool    $default
     * @return bool
     */
    public function confirm($question, $default = false)
    {

    	if ($input = $this->getTestableInput($question, $default)) {
    		return $input;
    	}

        return $this->output->confirm($question, $default);
    }

    /**
     *
     * @param  string  $question
     * @param  bool    $default
     * @return mixed
     */
    public function getTestableInput($question, $default = false)
    {
    	$counter = $this->testableCounter;

    	$testableInput = isset($this->testableInput[$counter]) ? $this->testableInput[$counter] : null;

    	if ($testableInput) {
    		$this->testableCounter++;
    	}

    	return $testableInput;
    }
}
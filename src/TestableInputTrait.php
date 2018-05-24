<?php

namespace Railken\LaraCommandTest;

trait TestableInputTrait
{
    /**
     * @var int
     */
    protected $testableCounter = 0;

    /**
     * @parent
     */
    public function confirm($question, $default = false)
    {
        if (($input = $this->getTestableInput()) !== null) {
            return true;
        }

        return parent::confirm($question, $default);
    }

    /**
     * @parent
     */
    public function ask($question, $default = null)
    {
        if (($input = $this->getTestableInput()) !== null) {
            return $input;
        }

        return parent::ask($question, $default);
    }

    /**
     * @parent
     */
    public function askWithCompletion($question, array $choices, $default = null)
    {
        if (($input = $this->getTestableInput()) !== null) {
            return $input;
        }

        return parent::askWithCompletion($question, $choices, $default);
    }

    /**
     * @parent
     */
    public function secret($question, $fallback = true)
    {
        if (($input = $this->getTestableInput()) !== null) {
            return $input;
        }

        return parent::secret($question, $fallback);
    }

    /**
     * @return mixed
     */
    public function getTestableInput()
    {
        $counter = $this->testableCounter;

        $testableInput = isset($this->testableInput[$counter]) ? $this->testableInput[$counter] : null;

        if ($testableInput !== null) {
            $this->testableCounter++;
        }

        return $testableInput;
    }
}

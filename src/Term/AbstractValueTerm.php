<?php

namespace Dhii\Expression\Term;

use Dhii\Data\ValueAwareInterface;
use Dhii\Evaluable\EvaluationExceptionInterface;

/**
 * Basic functionality for a term that has a value configuration.
 *
 * @since [*next-version*]
 */
abstract class AbstractValueTerm
{
    /**
     * The literal value.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $value;

    /**
     * Gets the term value.
     *
     * @since [*next-version*]
     *
     * @return mixed The term value.
     */
    protected function _getValue()
    {
        return $this->value;
    }

    /**
     * Sets the term  value.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The new term value.
     *
     * @return $this  This instance.
     */
    protected function _setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Evaluates the term.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [Optional] The context. Default: null
     *
     * @return mixed The evaluated result.
     */
    protected function _evaluate(ValueAwareInterface $ctx = null)
    {
        $this->_assertContextValid($ctx);

        return $this->_evalValue($this->_getValue(), $ctx);
    }

    /**
     * Evaluates a value using a given context.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The term value.
     * @param ValueAwareInterface $ctx [Optional] The context. Default: null
     *
     * @return mixed The evaluated result.
     */
    abstract protected function _evalValue($value, ValueAwareInterface $ctx = null);

    /**
     * Asserts whether the given context is considered valid for this term's evaluation.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [Optional] The context. Default: null
     *
     * @return true If the context is valid.
     *
     * @throws EvaluationExceptionInterface If the context is invalid.
     */
    abstract protected function _assertContextValid(ValueAwareInterface $ctx = null);
}

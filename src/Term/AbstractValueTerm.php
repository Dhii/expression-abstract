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
     * @return $this This instance.
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
     * @throws EvaluationExceptionInterface If an error occurs during evaluation.
     *
     * @return mixed The evaluated result.
     */
    abstract protected function _evaluate(ValueAwareInterface $ctx = null);

    /**
     * Creates an evaluation exception instance.
     *
     * @see \Exception
     *
     * @param string     $message  The exception message.
     * @param int        $code     The exception code. Default: 1
     * @param \Exception $previous The previous exception.
     *
     * @return EvaluationExceptionInterface The created evaluation exception instance.
     */
    abstract protected function _createEvaluationException($message, $code = 1, \Exception $previous = null);
}

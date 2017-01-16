<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;
use Dhii\Evaluable\EvaluableInterface;

/**
 * An abstracted implementation of a buffered expression.
 *
 * A buffered expression is evaluated by creating a buffer with an initial value, then incrementally
 * updating the value of the buffer for each term in the expression.
 *
 * After going through all the terms in the expression, the buffer will yield the result.
 *
 * @since [*next-version*]
 */
abstract class AbstractBufferedExpression extends AbstractExpression
{
    /**
     * The minimum number of terms.
     */
    const MIN_TERMS = 1;

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $terms    = $this->_getOrderedTerms($ctx);
        $numTerms = count($terms);

        if ($numTerms < static::MIN_TERMS) {
            return $this->_defaultValue($ctx);
        }

        // Set buffer to first term's eval result
        $buffer = $this->_evaluateTerm($terms[0], $ctx);

        for ($i = 1; $i < $numTerms; ++$i) {
            $_next  = $this->_evaluateTerm($terms[$i], $ctx);
            $buffer = $this->_updateBuffer($buffer, $_next, $ctx);
        }

        return $buffer;
    }

    /**
     * Evaluates the given term.
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface  $term The term instance.
     * @param ValueAwareInterface $ctx  [optional] The context. Default: null
     *
     * @return mixed The evaluated term value.
     */
    protected function _evaluateTerm(EvaluableInterface $term, ValueAwareInterface $ctx = null)
    {
        return $term->evaluate($ctx);
    }

    /**
     * Gets the terms in the order they are meant to be evaluated.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [optional] The context. Default: null
     *
     * @return array An array of EvaluableInterface instances.
     */
    protected function _getOrderedTerms(ValueAwareInterface $ctx = null)
    {
        return $this->getTerms();
    }

    /**
     * Gets the expression value when it doesn't have a sufficient number of terms.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [optional] The context. Default: null
     *
     * @return mixed The value.
     */
    abstract protected function _defaultValue(ValueAwareInterface $ctx = null);

    /**
     * Updates the buffer with the next term value.
     *
     * @since [*next-version*]
     *
     * @param mixed               $buffer The current buffer value.
     * @param mixed               $next   The value of the next term.
     * @param ValueAwareInterface $ctx    [optional] The context. Default: null
     *
     * @return mixed The updated buffer.
     */
    abstract protected function _updateBuffer($buffer, $next, ValueAwareInterface $ctx = null);
}

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
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $terms  = $this->_getOrderedTerms($ctx);
        $buffer = count($terms) > 0
            ? $this->_initBuffer($ctx)
            : $this->_defaultValue($ctx);

        foreach ($terms as $term) {
            $next   = $this->_evaluateTerm($term, $ctx);
            $buffer = $this->_updateBuffer($buffer, $next, $ctx);
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
     * Gets the initial value of the buffer.
     *
     * @since [*next-version*]
     *
     * @param ValueAwareInterface $ctx [optional] The context. Default: null
     *
     * @return mixed The initial buffer result.
     */
    abstract protected function _initBuffer(ValueAwareInterface $ctx = null);

    /**
     * Gets the expression value when it has no terms.
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

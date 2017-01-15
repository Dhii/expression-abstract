<?php

namespace Dhii\Espresso;

use Dhii\Data\ValueAwareInterface;

/**
 * An abstract implementation of an expression that evaluates using an operator.
 *
 * @since [*next-version*]
 */
abstract class AbstractOperatorExpression extends AbstractBufferedExpression
{
    protected function _initBuffer(ValueAwareInterface $ctx = null)
    {
        return count($this->getTerms()) > 0
            ? $this->_singleValue($ctx)
            : $this->_defaultValue($ctx);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _updateBuffer($buffer, $next, ValueAwareInterface $ctx = null)
    {
        return $this->_operator($buffer, $next, $ctx);
    }

    /**
     * Invokes the operator for the two given operands.
     *
     * @since [*next-version*]
     *
     * @param mixed               $left  The left operand value.
     * @param mixed               $right The right operand value.
     * @param ValueAwareInterface $ctx   [optional] The context. Default: null
     *
     * @return mixed The evaluated result.
     */
    abstract protected function _operator($left, $right, ValueAwareInterface $ctx = null);
}

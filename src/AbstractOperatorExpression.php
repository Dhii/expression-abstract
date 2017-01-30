<?php

namespace Dhii\Expression;

use Dhii\Data\ValueAwareInterface;

/**
 * An abstract implementation of an expression that evaluates using an operator.
 *
 * @since 0.1
 */
abstract class AbstractOperatorExpression extends AbstractBufferedExpression
{
    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _updateBuffer($buffer, $next, ValueAwareInterface $ctx = null)
    {
        return $this->_operator($buffer, $next, $ctx);
    }

    /**
     * Invokes the operator for the two given operands.
     *
     * @since 0.1
     *
     * @param mixed               $left  The left operand value.
     * @param mixed               $right The right operand value.
     * @param ValueAwareInterface $ctx   [optional] The context. Default: null
     *
     * @return mixed The evaluated result.
     */
    abstract protected function _operator($left, $right, ValueAwareInterface $ctx = null);
}

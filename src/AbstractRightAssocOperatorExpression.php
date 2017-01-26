<?php

namespace Dhii\Expression;

use Dhii\Data\ValueAwareInterface;

/**
 * Abstract implementation of a right associative expression.
 *
 * A right associative expression is an expression that evaluates its terms in reverse order.
 * ie. last to first, right to left.
 *
 * @since [*next-version*]
 */
abstract class AbstractRightAssocOperatorExpression extends AbstractOperatorExpression
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getOrderedTerms(ValueAwareInterface $ctx = null)
    {
        return array_reverse($this->_getTerms());
    }
}

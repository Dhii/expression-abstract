<?php

namespace Dhii\Expression\Expression;

use Dhii\Data\ValueAwareInterface;

/**
 * Abstract implementation of a right associative expression.
 *
 * A right associative expression is an expression that evaluates its terms in reverse order.
 * ie. last to first, right to left.
 *
 * @since 0.1
 */
abstract class AbstractRightAssocOperatorExpression extends AbstractOperatorExpression
{
    /**
     * {@inheritdoc}
     *
     * @since 0.1
     */
    protected function _getOrderedTerms(ValueAwareInterface $ctx = null)
    {
        return array_reverse($this->_getTerms());
    }
}

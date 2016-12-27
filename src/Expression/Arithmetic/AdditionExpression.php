<?php

namespace Dhii\Espresso\Expression\Arithmetic;

use Dhii\Data\ValueAwareInterface;
use Dhii\Espresso\AbstractExpression;

/**
 * An expression that performs simple addition of its terms.
 *
 * @since [*next-version*]
 */
class AdditionExpression extends AbstractExpression
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param array $terms [optional] An array of terms or a variable number of arguments. Default: array()
     */
    public function __construct($terms = array())
    {
        $this->setTerms(is_array($terms) ? $terms : func_get_args());
    }

    /**
     * @since [*next-version*]
     * 
     * {@inheritdoc}
     */
    public function evaluate(ValueAwareInterface $ctx = null)
    {
        $sum = 0;

        foreach ($this->getTerms() as $term) {
            $sum += $term->evaluate($ctx);
        }

        return $sum;
    }
}

<?php

namespace Dhii\Espresso;

use Dhii\Evaluable\EvaluableInterface;

/**
 * An abstract expression implementation that provides term array management.
 *
 * @since [*next-version*]
 */
abstract class AbstractExpression implements ExpressionInterface
{
    /**
     * @since [*next-version*]
     *
     * @var EvaluableInterface[]
     */
    protected $terms = array();

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * Adds a single term to the expression.
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface $term The term instance to add.
     *
     * @return static This instance.
     */
    protected function _addTerm(EvaluableInterface $term)
    {
        $this->terms[] = $term;

        return $this;
    }

    /**
     * Sets the expression terms.
     *
     * This method will emit an `E_USER_NOTICE` if an array element does not implement `EvaluableInterface.`
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface[] $terms An array of EvaluableInterface instances.
     *
     * @return static This instance.
     */
    protected function _setTerms(array $terms)
    {
        $this->terms = array();
        foreach ($terms as $term) {
            if ($term instanceof EvaluableInterface) {
                $this->addTerm($term);
            } else {
                trigger_error('One of the given terms does not implement EvaluableInterface!', E_USER_NOTICE);
            }
        }

        return $this;
    }

    /**
     * Removes the term at the given index.
     *
     * @since [*next-version*]
     *
     * @param int $index An integer representing a zero-based index.
     *
     * @return $this This instance.
     */
    protected function _removeTerm($index)
    {
        unset($this->terms[$index]);

        return $this;
    }
}

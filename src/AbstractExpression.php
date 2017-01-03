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
            if (!($term instanceof EvaluableInterface)) {
                trigger_error('One of the given terms does not implement EvaluableInterface!', E_USER_NOTICE);
                continue;
            }
            $this->addTerm($term);
        }

        return $this;
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
     * Gets the term at the given index.
     *
     * @since [*next-version*]
     *
     * @param int $index The zero-based integer index of the term to retrieve.
     *
     * @return EvaluableInterface The term instance or null if the index is invalid.
     */
    protected function _getTerm($index)
    {
        return isset($this->terms[$index])
            ? $this->terms[$index]
            : null;
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

<?php

namespace Dhii\Expression\Expression;

use Dhii\Evaluable\EvaluableInterface;

/**
 * An abstract expression implementation that provides term array management.
 *
 * @since 0.1
 */
abstract class AbstractExpression
{
    /**
     * @since 0.1
     *
     * @var EvaluableInterface[]
     */
    protected $terms = array();

    /**
     * Retrieves the expression terms.
     *
     * @since 0.1
     *
     * @return EvaluableInterface[] An array of terms.
     */
    protected function _getTerms()
    {
        return $this->terms;
    }

    /**
     * Sets the expression terms.
     *
     * This method will emit an `E_USER_NOTICE` if an array element does not implement `EvaluableInterface.`
     *
     * @since 0.1
     *
     * @param EvaluableInterface[] $terms An array of EvaluableInterface instances.
     *
     * @return static This instance.
     */
    protected function _setTerms(array $terms)
    {
        $this->_clearTerms();
        foreach ($terms as $_index => $_term) {
            if (!$_term instanceof EvaluableInterface) {
                throw new \InvalidArgumentException(
                    sprintf('Term at index %d does not implement EvaluableInterface!', $_index)
                );
            }
            $this->_addTerm($_term);
        }

        return $this;
    }

    /**
     * Adds a single term to the expression.
     *
     * @since 0.1
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
     * @since 0.1
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
     * @since 0.1
     *
     * @param int $index An integer representing a zero-based index.
     *
     * @return $this This instance.
     */
    protected function _removeTerm($index)
    {
        array_splice($this->terms, $index, 1, array());

        return $this;
    }

    /**
     * Clears the expression by removing all the terms.
     *
     * @since 0.1
     *
     * @return $this This instance.
     */
    protected function _clearTerms()
    {
        $this->terms = array();

        return $this;
    }
}

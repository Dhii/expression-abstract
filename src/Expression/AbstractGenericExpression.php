<?php

namespace Dhii\Expression\Expression;

use Dhii\Evaluable\EvaluableInterface;

/**
 * An abstract and generic expression implementation that is a useful shortcut for exposing
 * all of the term management methods in {@see \Dhii\Expression\Expression\AbstractExpression}.
 *
 * @since [*next-version*]
 */
abstract class AbstractGenericExpression extends AbstractExpression
{
    /**
     * Adds a term to the expression.
     *
     * @since [*next-version*]
     *
     * @param EvaluableInterface $term The term instance.
     *
     * @return $this This instance.
     */
    public function addTerm(EvaluableInterface $term)
    {
        return $this->_addTerm($term);
    }

    /**
     * Removes the term at a specific index from the expression.
     *
     * @since [*next-version*]
     *
     * @param int $index The zero-based index of the term to remove.
     *
     * @return $this This instance.
     */
    public function removeTerm($index)
    {
        return $this->_removeTerm($index);
    }

    /**
     * Gets a term at a specific index from the expression.
     *
     * @since [*next-version*]
     *
     * @param int $index The zero-based index of the term to retrieve.
     *
     * @return EvaluableInterface The term at the given index or null if the index is invalid.
     */
    public function getTerm($index)
    {
        return $this->_getTerm($index);
    }

    /**
     * Sets the expression terms.
     *
     * @since [*next-version*]
     *
     * @param array $terms An array of EvaluableInterface instances.
     *
     * @return $this This instance.
     */
    public function setTerms(array $terms)
    {
        return $this->_setTerms($terms);
    }
}

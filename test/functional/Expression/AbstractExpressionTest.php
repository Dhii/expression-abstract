<?php

namespace Dhii\Expression\FuncTest\Expression;

use Dhii\Expression\Expression\AbstractExpression;
use Dhii\Evaluable\EvaluableInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Expression\AbstractExpression}.
 *
 * @since 0.1
 */
class AbstractExpressionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Expression\\Expression\\AbstractExpression';

    /**
     * Creates an instance of the test subject.
     *
     * @since 0.1
     *
     * @return AbstractExpression
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->evaluate();

        return $mock->new();
    }

    /**
     * Creates a mock term instance that simply returns a specific value.
     *
     * @since 0.1
     *
     * @param mixed $value The value to return.
     *
     * @return EvaluableInterface
     */
    public function mockTerm($value)
    {
        $mock = $this->mock('Dhii\\Evaluable\\EvaluableInterface')
            ->evaluate($value);

        return $mock->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since 0.1
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject);
    }

    /**
     * Tests the protected term getter and setter methods.
     *
     * @since 0.1
     */
    public function testGetSetTerms()
    {
        $subject = $this->createInstance();
        $term1   = $this->mockTerm(1);
        $term2   = $this->mockTerm(2);

        $expected = array($term1, $term2);
        $subject->this()->_setTerms($expected);

        $this->assertEquals($expected, $subject->this()->_getTerms());
    }

    /**
     * Tests the protected term setter method with an invalid term. A notice should be produced.
     *
     * @since 0.1
     */
    public function testSetTermsInvalidTerm()
    {
        $subject = $this->createInstance();
        $term1   = $this->mockTerm(1);
        $term2   = 5.5;

        $this->setExpectedException('\\InvalidArgumentException');

        $subject->this()->_setTerms(array($term1, $term2));

        $this->assertEquals(array($term1, $term2), $subject->this()->_getTerms());
    }

    /**
     * Tests the protected term adder method.
     *
     * @since 0.1
     */
    public function testAddTerm()
    {
        $subject = $this->createInstance();
        $term    = $this->mockTerm(10);

        $subject->this()->_setTerms($expected = array(
            $this->mockTerm(1),
            $this->mockTerm(2),
            $this->mockTerm(3)
        ));

        $subject->this()->_addTerm($term);
        $expected[] = $term;

        $this->assertEquals($expected, $subject->this()->_getTerms());
    }

    /**
     * Tests the protected term removal method.
     *
     * @since 0.1
     */
    public function testRemoveTerm()
    {
        $subject = $this->createInstance();
        $term1   = $this->mockTerm(2);
        $term2   = $this->mockTerm(4);
        $term3   = $this->mockTerm(10);
        $term4   = $this->mockTerm(12);

        $expected = array($term1, $term2, $term3, $term4);
        $subject->this()->_setTerms($expected);

        $subject->this()->_removeTerm(1);
        array_splice($expected, 1, 1, array());

        $this->assertEquals($expected, $subject->this()->_getTerms());
    }

    /**
     * Tests the single term getter method after terms have been removed from the expression.
     *
     * @since 0.1
     */
    public function testGetTermAfterRemoval()
    {
        $subject = $this->createInstance();

        $subject->this()->_setTerms(array(
            $this->mockTerm(5),
            $this->mockTerm(2),
            $this->mockTerm(9),
        ));

        $this->assertEquals($this->mockTerm(9), $subject->this()->_getTerm(2));

        $subject->this()->_removeTerm(1);

        $this->assertEquals($this->mockTerm(9), $subject->this()->_getTerm(1));
    }
}

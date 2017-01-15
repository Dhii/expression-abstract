<?php

namespace Dhii\Espresso\Test;

use \Dhii\Espresso\AbstractExpression;
use \Dhii\Evaluable\EvaluableInterface;
use \Xpmock\TestCase;

/**
 * Description of AbstractExpressionTest
 *
 * @since [*next-version*]
 */
class AbstractExpressionTest extends TestCase
{

    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Espresso\\AbstractExpression';

    /**
     * Creates an instance of the test subject.
     *
     * @since [*next-version*]
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
     * @since [*next-version*]
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
     * @covers \Dhii\Espresso\AbstractExpression
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject);
        $this->assertInstanceOf('\\Dhii\\Espresso\\ExpressionInterface', $subject);
        $this->assertInstanceOf('\\Dhii\\Evaluable\\EvaluableInterface', $subject);
    }

    /**
     * Tests the protected term getter method.
     *
     * @since [*next-version*]
     */
    public function testGetTerms()
    {
        $subject = $this->createInstance();
        $term = $this->mockTerm(10);

        $subject->this()->terms = array(1, 2, 3, $term);

        $this->assertEquals(array(1, 2, 3, $term), $subject->getTerms());
    }

    /**
     * Tests the protected term setter method.
     *
     * @since [*next-version*]
     */
    public function testSetTerms()
    {
        $subject = $this->createInstance();
        $term1 = $this->mockTerm(1);
        $term2 = $this->mockTerm(2);

        $subject->this()->_setTerms(array($term1, $term2));

        $this->assertEquals(array($term1, $term2), $subject->this()->terms);
    }

    /**
     * Tests the protected term setter method with an invalid term. A notice should be produced.
     *
     * @since [*next-version*]
     */
    public function testSetTermsInvalidTerm()
    {
        $subject = $this->createInstance();
        $term1 = $this->mockTerm(1);
        $term2 = 5.5;

        $this->setExpectedException('PHPUnit_Framework_Error');

        $subject->this()->_setTerms(array($term1, $term2));

        $this->assertEquals(array($term1, $term2), $subject->this()->terms);
    }

    /**
     * Tests the protected term adder method.
     *
     * @since [*next-version*]
     */
    public function testAddTerm()
    {
        $subject = $this->createInstance();
        $term = $this->mockTerm(10);

        $subject->this()->terms = array(1, 2, 3);
        $subject->this()->_addTerm($term);

        $this->assertEquals(array(1, 2, 3, $term), $subject->this()->terms);
    }

    /**
     * Tests the protected term removal method.
     *
     * @since [*next-version*]
     */
    public function testRemoveTerm()
    {
        $subject = $this->createInstance();
        $term = $this->mockTerm(10);

        $subject->this()->terms = array(1, 2, 3, $term);
        $subject->this()->_removeTerm(1);

        $this->assertEquals(array(1, 3, $term), array_values($subject->this()->terms));
    }
}

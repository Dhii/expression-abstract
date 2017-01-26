<?php

namespace Dhii\Expression\Test;

use \Dhii\Expression\AbstractBufferedExpression;
use \Dhii\Evaluable\EvaluableInterface;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Expression\AbstractBufferedExpression}.
 *
 * @since [*next-version*]
 */
class AbstractBufferedExpressionTest extends TestCase
{

    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Expression\\AbstractBufferedExpression';

    /**
     * Creates an instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractBufferedExpression
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_initBuffer(function() {
                return 0;
            })
            ->_defaultValue(function() {
                return 0;
            })
            ->_updateBuffer(function($buffer, $next) {
                return intval($buffer) + intval($next);
            })
        ;

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
     * Tests the evaluation without any terms.
     *
     * @since [*next-version*]
     */
    public function testNoTerms()
    {
        $subject = $this->createInstance();

        $this->assertEquals(0, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with just 1 term.
     *
     * @since [*next-version*]
     */
    public function testSingleTerm()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(5)
        );

        $this->assertEquals(5, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with 2 terms.
     *
     * @since [*next-version*]
     */
    public function testTwoTerms()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(5),
            $this->mockTerm(8)
        );

        $this->assertEquals(13, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with multiple terms.
     *
     * @since [*next-version*]
     */
    public function testMultipleTerms()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(5),
            $this->mockTerm(8),
            $this->mockTerm(2),
            $this->mockTerm(4),
            $this->mockTerm(3)
        );

        $this->assertEquals(22, $subject->this()->_evaluate());
    }

}

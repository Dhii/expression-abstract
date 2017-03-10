<?php

namespace Dhii\Expression\Test\Expression;

use Dhii\Expression\Expression\AbstractLeftAssocOperatorExpression;
use Dhii\Evaluable\EvaluableInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Expression\AbstractLeftAssocOperatorExpression}.
 *
 * @since 0.1
 */
class AbstractLeftAssociativeExpressionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Expression\\Expression\\AbstractLeftAssocOperatorExpression';

    /**
     * Creates an instance of the test subject.
     *
     * @since 0.1
     *
     * @return AbstractLeftAssocOperatorExpression
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_initBuffer(function () {
                return;
            })
            ->_defaultValue(function () {
                return 0;
            })
            ->_operator(function ($left, $right) {
                return is_null($left)
                    ? $right
                    : $left / $right;
            })
        ;

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
     * Tests the evaluation without any terms.
     *
     * @since 0.1
     */
    public function testNoTerms()
    {
        $subject = $this->createInstance();

        $this->assertEquals(0, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with just 1 term.
     *
     * @since 0.1
     */
    public function testSingleTerm()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(2),
        );

        $this->assertEquals(2, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with 2 terms.
     *
     * @since 0.1
     */
    public function testTwoTerms()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(2),
            $this->mockTerm(10),
        );

        $this->assertEquals(0.2, $subject->this()->_evaluate());
    }

    /**
     * Tests the evaluation with multiple terms.
     *
     * @since 0.1
     */
    public function testMultipleTerms()
    {
        $subject = $this->createInstance();
        $subject->this()->terms = array(
            $this->mockTerm(2),
            $this->mockTerm(10),
            $this->mockTerm(4),
        );

        $this->assertEquals(0.05, $subject->this()->_evaluate());
    }
}

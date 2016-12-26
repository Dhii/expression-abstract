<?php

namespace Dhii\Espresso\Test;

use \Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\AbstractExpression}.
 *
 * @since [*next-version*]
 */
class AbstractExpressionTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Espresso\\AbstractExpression';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return Dhii\Espresso\AbstractExpression
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->evaluate()
            ->new();

        return $mock;
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
}

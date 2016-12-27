<?php

namespace Dhii\Espresso\Test;

use Dhii\Espresso\EvaluationException;
use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\EvaluationException}}.
 *
 * @since [*next-version*]
 */
class EvaluationExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Espresso\\EvaluationException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return EvaluationException
     */
    public function createInstance()
    {
        return new EvaluationException();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @covers \Dhii\Espresso\EvaluationException
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject);
        $this->assertInstanceOf('\\Exception', $subject);
    }
}

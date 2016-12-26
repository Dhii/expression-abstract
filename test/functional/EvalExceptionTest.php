<?php

namespace Dhii\Espresso\Test;

use \Dhii\Espresso\EvalException;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\EvalException}}.
 *
 * @since [*next-version*]
 */
class EvalExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Espresso\\EvalException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return EvalException
     */
    public function createInstance()
    {
        return new EvalException();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @covers \Dhii\Espresso\EvalException
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

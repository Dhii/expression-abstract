<?php

namespace Dhii\Espresso\Test;

use \Xpmock\TestCase;

/**
 * Tests {@see Dhii\Espresso\AbstractContext}.
 *
 * @since [*next-version*]
 */
class AbstractContextTest extends TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Espresso\\AbstractContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return Dhii\Espresso\AbstractContext
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->getValue()
            ->setValue()
            ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @covers \Dhii\Espresso\AbstractContext
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject);
        $this->assertInstanceOf('\\Dhii\\Espresso\\ContextInterface', $subject);
        $this->assertInstanceOf('\\Dhii\\Data\\ValueAwareInterface', $subject);
    }
}

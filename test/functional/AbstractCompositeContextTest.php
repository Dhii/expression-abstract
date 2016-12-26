<?php

namespace Dhii\Espresso\Test;

/**
 * Tests {@see \Dhii\Espresso\AbstractCompositeContext}.
 *
 * @since [*next-version*]
 */
class AbstractCompositeContextTest extends \Xpmock\TestCase
{
    /**
     * The name of the test subject.
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Espresso\\AbstractCompositeContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return Dhii\Espresso\AbstractCompositeContext
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->getValue()
            ->setValue()
            ->hasValue()
            ->removeValue()
            ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @covers \Dhii\Espresso\AbstractCompositeContext
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject);
        $this->assertInstanceOf('\\Dhii\\Espresso\\CompositeContextInterface', $subject);
        $this->assertInstanceOf('\\Dhii\\Espresso\\AbstractContext', $subject);
        $this->assertInstanceOf('\\Dhii\\Data\\ValueAwareInterface', $subject);
    }
}

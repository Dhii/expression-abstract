<?php

namespace Dhii\Expression\Test\Context;

use Dhii\Expression\Context\AbstractContext;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Expression\Context\AbstractContext}.
 *
 * @since 0.1
 */
class AbstractContextTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Expression\\Context\\AbstractContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @return AbstractContext
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_getValue()
            ->_setValue()
            ->new();

        return $mock;
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
}

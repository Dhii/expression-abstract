<?php

namespace Dhii\Espresso\Test\Context;

use \Dhii\Espresso\Context\RawContext;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\Context\RawContext}.
 *
 * @since [*next-version*]
 */
class RawContextTest extends TestCase
{
    /**
     * @since [*next-version*]
     */
    const INIT_VALUE = 'test';

    /**
     * @since [*next-version*]
     *
     * @var RawContext
     */
    protected $instance;

    /**
     * Creates a new instance.
     *
     * @since [*next-version*]
     *
     * @return RawContext
     */
    public function createInstance()
    {
        return new RawContext(static::INIT_VALUE);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function setUp()
    {
        $this->instance = $this->createInstance();
    }

    /**
     * Tests whether the constructor correctly sets the value.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\RawContext::__construct
     */
    public function testConstructor()
    {
        $this->assertEquals(static::INIT_VALUE, $this->reflect($this->instance)->value);
    }

    /**
     * Tests whether the value getter method retrieves the correct value.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\RawContext::getValue
     */
    public function testGetValue()
    {
        $value = 123456;
        $this->reflect($this->instance)->value = $value;

        $this->assertEquals($value, $this->instance->getValue());
    }

    /**
     * Tests whether the value setter method correctly assigns the value.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\RawContext::setValue
     */
    public function testSetValue()
    {
        $newValue = 'foobar';
        $this->instance->setValue($newValue);

        $this->assertEquals($newValue, $this->reflect($this->instance)->value);
    }
}

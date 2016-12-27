<?php

namespace Dhii\Espresso\Test\Context;

use Dhii\Espresso\Context\ArrayContext;
use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\Context\ArrayContext}.
 *
 * @since [*next-version*]
 */
class ArrayContextTest extends TestCase
{
    /**
     * @since [*next-version*]
     *
     * @var ArrayContext
     */
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return ArrayContext
     */
    public function createInstance()
    {
        return new ArrayContext(array());
    }

    /**
     * {@inheritdoc}
     *
     * @since [*version*]
     */
    public function setUp()
    {
        $this->instance = $this->createInstance();
    }

    /**
     * Tests the array offset get functionality with an existing index.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetGet
     */
    public function testOffsetGet()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
        );
        $this->instance->setValue($values);

        $this->assertEquals(3, $this->instance['three']);
    }

    /**
     * Tests the array offset get functionality with an existing index.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetGet
     */
    public function testOffsetGetInvalidOffset()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
        );
        $this->instance->setValue($values);

        $this->assertEquals(null, $this->instance['four']);
    }

    /**
     * Tests the array offset set functionality with a string key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetSet
     */
    public function testOffsetSet()
    {
        $expected = array('one' => 1);

        $this->instance['one'] = 1;

        $this->assertEquals($expected, $this->reflect($this->instance)->values);
    }

    /**
     * Tests the array offset set functionality without a key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetSet
     */
    public function testOffsetSetEmptyKey()
    {
        $expected = array('' => 1);

        $this->instance[] = 1;

        $this->assertEquals($expected, $this->reflect($this->instance)->values);
    }

    /**
     * Tests the array offset set functionality when overwriting an existing entry.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetSet
     */
    public function testOffsetSetOverwrite()
    {
        $values = array(
            'one' => 1,
            'two' => 2,
        );
        $expected = array_merge($values, array(
            'two' => 4,
        ));

        $this->instance->setValue($values);
        $this->instance['two'] = 4;

        $this->assertEquals($expected, $this->reflect($this->instance)->values);
    }

    /**
     * Tests the array offset exists functionality with an existing key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetExists
     */
    public function testOffsetExistsExistingKey()
    {
        $this->instance->setValue(array(
            'one' => 1,
            'two' => 2,
        ));

        $this->assertTrue(isset($this->instance['one']));
    }

    /**
     * Tests the array offset exists functionality with a non-existing key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetExists
     */
    public function testOffsetExistsNonExistingKey()
    {
        $this->instance->setValue(array(
            'one' => 1,
            'two' => 2,
        ));

        $this->assertFalse(isset($this->instance['three']));
    }

    /**
     * Tests the array offset unset functionality.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\ArrayContext::offsetExists
     */
    public function testOffsetUnset()
    {
        $values = array(
            'one' => 1,
            'two' => 2,
        );
        $this->instance->setValue($values);

        unset($this->instance['two']);
        unset($values['two']);

        $this->assertEquals($values, $this->reflect($this->instance)->values);
    }
}

<?php

namespace Dhii\Espresso\Test\Context;

use \Dhii\Espresso\Context\CompositeContext;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\Context\CompositeContext}.
 *
 * @since [*next-version*]
 */
class CompositeContextTest extends TestCase
{
    /**
     * @since [*next-version*]
     *
     * @var CompositeContext
     */
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return CompositeContext
     */
    public function createInstance()
    {
        return new CompositeContext(array());
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
     * Tests the constructor to check if the value is initialized correctly.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::__construct
     */
    public function testConstructor()
    {
        $this->assertEmpty($this->reflect($this->instance)->values);
    }

    /**
     * Tests the value getter without any arguments.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::getValue
     */
    public function testGetValueNoArgs()
    {
        $values = array(1, 2, 3);
        $reflect = $this->reflect($this->instance);
        $reflect->values = $values;

        $this->assertEquals($values, $reflect->getValue());
    }

    /**
     * Tests the value getter without any arguments.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::getValue
     */
    public function testGetValueWithKey()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $reflect = $this->reflect($this->instance);
        $reflect->values = $values;

        $this->assertEquals(2, $reflect->getValue('two'));
    }

    /**
     * Tests the value getter without any arguments.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::getValue
     */
    public function testGetValueWithKeyNotFound()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $reflect = $this->reflect($this->instance);
        $reflect->values = $values;

        $this->assertEquals(null, $reflect->getValue('test'));
    }

    /**
     * Tests the value setter without any arguments.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::setValue
     */
    public function testSetValueNoArgs()
    {
        $value = array(1, 2, 3);
        $this->instance->setValue($value);

        $this->assertEquals($value, $this->reflect($this->instance)->values);
    }

    /**
     * Tests the value setter with an argument that represents an existing key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::setValue
     */
    public function testSetValueWithExistingKey()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $reflect = $this->reflect($this->instance);
        $reflect->values = $values;
        $this->instance->setValue('two', 0);

        $this->assertEquals(0, $this->reflect($this->instance)->values['two']);
    }

    /**
     * Tests the value setter with an argument that represents a new key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::setValue
     */
    public function testSetValueWithNewKey()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $reflect = $this->reflect($this->instance);
        $reflect->values = $values;
        $this->instance->setValue('four', 4);

        $this->assertEquals(4, $this->reflect($this->instance)->values['four']);
    }

    /**
     * Tests the `hasValue()` method with an existing key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::hasValue
     */
    public function testHasValueExistingKey()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $this->reflect($this->instance)->values = $values;

        $this->assertTrue($this->instance->hasValue('two'));
    }

    /**
     * Tests the `hasValue()` method with a non-existing key.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::hasValue
     */
    public function testHasValueNonExistingKey()
    {
        $values = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $this->reflect($this->instance)->values = $values;

        $this->assertFalse($this->instance->hasValue('four'));
    }

    /**
     * Tests the value remover method with an existing key to ensure that it gets removed.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::removeValue
     */
    public function testRemoveValueExistingKey()
    {
        $before = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $this->reflect($this->instance)->values = $before;

        $after = array_slice($before, 1);
        $this->instance->removeValue('one');

        $this->assertEquals($after, $this->reflect($this->instance)->values);
    }

    /**
     * Tests the value remover method with a non-existing key to ensure the values are not changed.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Context\CompositeContext::removeValue
     */
    public function testRemoveValueNonExistingKey()
    {
        $before = array(
            'one'   => 1,
            'two'   => 2,
            'three' => 3
        );
        $this->reflect($this->instance)->values = $before;

        $this->instance->removeValue('four');

        $this->assertEquals($before, $this->reflect($this->instance)->values);
    }
}

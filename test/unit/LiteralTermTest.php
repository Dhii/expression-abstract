<?php

namespace Dhii\Espresso\Test;

use \Dhii\Espresso\Term\LiteralTerm;
use \Xpmock\TestCase;

/**
 * Description of LiteralTermTest
 *
 * @since [*next-version*]
 */
class LiteralTermTest extends TestCase
{
    /**
     * The initial value used to instantiate the LiteralTerm.
     */
    const INITIAL_VALUE = 'test';

    /**
     * The subject instance.
     *
     * @since [*next-version*]
     *
     * @var LiteralTerm
     */
    protected $subject;

    /**
     * Creates a new subject instance.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The literal value.
     *
     * @return LiteralTermTest The created instance.
     */
    public function createInstance($value)
    {
        return new LiteralTerm($value);
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = $this->createInstance(static::INITIAL_VALUE);
    }

    /**
     * Tests whether the getter method returns the correct value.
     *
     * @covers LiteralTerm::getValue
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $this->assertEquals(static::INITIAL_VALUE, $this->subject->getValue());
    }

    /**
     * Tests whether the setter method correctly sets the new value.
     *
     * @covers LiteralTerm::setValue
     *
     * @since [*next-version*]
     */
    public function testSetValue()
    {
        $newValue = 123;
        $this->subject->setValue($newValue);
        $this->assertEquals($newValue, $this->subject->getValue());
    }

    /**
     * Tests whether the evaluation result is the same as the initial value, regardless of the context.
     *
     * @covers LiteralTerm::evaluate
     *
     * @since [*next-version*]
     */
    public function testEvaluate()
    {
        // Mock a context that gives a value of 456
        $ctx = $this->mock('\\Dhii\\Data\\ValueAwareInterface')
            ->getValue(function() {
                return 456;
            })
            ->new();

        // Set the instance value to 123
        $value = 123;
        $this->subject->setValue($value);

        // Evaluate to get the result
        $result = $this->subject->evaluate($ctx);

        $this->assertEquals($value, $result);
    }
}

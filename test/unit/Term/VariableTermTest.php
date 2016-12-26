<?php

namespace Dhii\Espresso\Test\Term;

use \Dhii\Espresso\Term\VariableTerm;
use \Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Espresso\VariableTerm}.
 *
 * @since [*next-version*]
 */
class VariableTermTest extends TestCase
{

    /**
     * The initial identifier used to instantiate the VariableTerm.
     */
    const INITIAL_IDENTIFIER = 'test';

    /**
     * The subject instance.
     *
     * @since [*next-version*]
     *
     * @var VariableTerm
     */
    protected $subject;

    /**
     * Creates a new subject instance.
     *
     * @since [*next-version*]
     *
     * @param string $identifier The variable identifier.
     *
     * @return VariableTerm The created instance.
     */
    public function createInstance($identifier)
    {
        return new VariableTerm($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->subject = $this->createInstance(static::INITIAL_IDENTIFIER);
    }

    /**
     * Tests whether the getter method returns the correct identifier.
     *
     * @covers \Dhii\Espresso\Term\VariableTerm::getIdentifier
     *
     * @since [*next-version*]
     */
    public function testGetIdentifier()
    {
        $this->assertEquals(static::INITIAL_IDENTIFIER, $this->subject->getIdentifier());
    }

    /**
     * Tests whether the setter method correctly sets the new identifier.
     *
     * @covers \Dhii\Espresso\Term\VariableTerm::setIdentifier
     *
     * @since [*next-version*]
     */
    public function testSetIdentifier()
    {
        $newIdentifier = 'x';
        $this->subject->setIdentifier($newIdentifier);

        $this->assertEquals($newIdentifier, $this->subject->getIdentifier());
    }

    /**
     * Tests whether the evaluation result is the same as the context-given value.
     *
     * @covers \Dhii\Espresso\Term\VariableTerm::evaluate
     *
     * @since [*next-version*]
     */
    public function testEvaluate()
    {
        $value = 50;

        // Mock a context
        $ctx = $this->mock('\\Dhii\\Espresso\\AbstractCompositeContext')
            // Mock method to return the value
            ->getValue(function() use ($value) {
                return $value;
            })
            // Mock method to always return true
            ->hasValue(function() {
                return true;
            })
            ->setValue()
            ->removeValue()
            ->new();

        // Evaluate to get the result
        $result = $this->subject->evaluate($ctx);

        $this->assertEquals($value, $result);
    }

    /**
     * Tests whether an evaluation exception is thrown when no value exists in the given
     * context for this variable term.
     *
     * @covers \Dhii\Espresso\Term\VariableTerm::evaluate
     *
     * @since [*next-version*]
     */
    public function testEvaluateNoValue()
    {
        // Mock a context
        $ctx = $this->mock('\\Dhii\\Espresso\\AbstractContext')
            // Mock method to return the value
            ->getValue(function() {
                return 50;
            })
            // Mock method to always return false
            ->hasValue(function() {
                return false;
            })
            ->new();

        // Expect an evaluation exception
        $this->setExpectedException('\\Dhii\\Evaluable\\EvaluationExceptionInterface');

        // Evaluate to get the result
        $this->subject->evaluate($ctx);
    }

    /**
     * Tests whether an evaluation exception is thrown when the given context is not a
     * ContextInterface instance.
     *
     * @covers \Dhii\Espresso\Term\VariableTerm::evaluate
     *
     * @since [*next-version*]
     */
    public function testEvaluateNotContext()
    {
        // Mock a context
        $ctx = $this->mock('\\Dhii\\Data\\ValueAwareInterface')
            // Mock method to return the value
            ->getValue(function() {
                return 'foobar';
            })
            ->new();

        // Expect an evaluation exception
        $this->setExpectedException('\\Dhii\\Evaluable\\EvaluationExceptionInterface');

        // Evaluate to get the result
        $this->subject->evaluate($ctx);
    }

}

<?php

namespace Dhii\Expression\FuncTest\Term;

use Dhii\Expression\Term\AbstractValueTerm;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Expression\Term\AbstractValueTerm}.
 *
 * @since [*next-version*]
 */
class AbstractValueTermTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Expression\\Term\\AbstractValueTerm';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractValueTerm
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_evalValue(function($value, $ctx = null) {
                return $value;
            })
            ->_assertContextValid(function($ctx) {
                return true;
            })
            ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject, 'Subject is not a valid instance.'
        );
    }

    /**
     * Tests the value getter.
     *
     * @since [*next-version*]
     */
    public function testGetValue()
    {
        $subject = $this->createInstance();

        $subject->this()->value = 'foobar';

        $this->assertEquals('foobar', $subject->this()->_getValue(), 'Subject returned an invalid value.');
    }

    /**
     * Tests the value setter.
     *
     * @since [*next-version*]
     */
    public function testSetValue()
    {
        $subject = $this->createInstance();

        $return = $subject->this()->_setValue('foobar');

        $this->assertEquals('foobar', $subject->this()->value, 'Subject did not set the correct value internally.');
        $this->assertSame($subject, $return, 'Subject did not return a reference of itself');
    }

    /**
     * Tests the evaluation.
     *
     * @since [*next-version*]
     */
    public function testEvaluate()
    {
        $subject = $this->createInstance();
        $subject->this()->value = 60;

        $result = $subject->this()->_evaluate();

        $this->assertEquals(60, $result);
    }
}

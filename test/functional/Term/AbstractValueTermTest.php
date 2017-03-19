<?php

namespace Dhii\Expression\FuncTest\Term;

use Dhii\Expression\Term\AbstractValueTerm;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Expression\Term\AbstractValueTerm}.
 *
 * @since 0.1
 */
class AbstractValueTermTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Expression\\Term\\AbstractValueTerm';

    /**
     * Creates a new instance of the test subject.
     *
     * @since 0.1
     *
     * @return AbstractValueTerm
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_evaluate()
            ->_createEvaluationException()
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

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME, $subject, 'Subject is not a valid instance.'
        );
    }

    /**
     * Tests the value getter.
     *
     * @since 0.1
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
     * @since 0.1
     */
    public function testSetValue()
    {
        $subject = $this->createInstance();

        $return = $subject->this()->_setValue('foobar');

        $this->assertEquals('foobar', $subject->this()->_getValue(), 'Subject did not set the correct value internally.');
        $this->assertSame($subject, $return, 'Subject did not return a reference of itself');
    }
}

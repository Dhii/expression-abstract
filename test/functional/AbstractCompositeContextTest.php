<?php

namespace Dhii\Expression\Test;

/**
 * Tests {@see \Dhii\Expression\AbstractCompositeContext}.
 *
 * @since 0.1
 */
class AbstractCompositeContextTest extends \Xpmock\TestCase
{
    /**
     * The name of the test subject.
     *
     * @since 0.1
     */
    const TEST_SUBJECT_CLASSNAME = '\\Dhii\\Expression\\AbstractCompositeContext';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next=version*]
     *
     * @param array $values An array of context values. Default: array()
     *
     * @return Dhii\Expression\AbstractCompositeContext
     */
    public function createInstance(array $values = array())
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->new();

        $mock->this()->value = $values;

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
        $this->assertInstanceOf('\\Dhii\\Expression\\AbstractContext', $subject);
    }

    /**
     * Tests the value getter to ensure that all values are returned in an array.
     *
     * @since 0.1
     */
    public function testGetValue()
    {
        $values  = array(1, 1, 2, 3, 5, 8, 13);
        $subject = $this->createInstance($values);

        $this->assertEquals($values, $subject->this()->_getValue());
    }

    /**
     * Tests the single value getter to ensure that values for existing keys are returned
     * while non-existing key arguments result in a `null` return.
     *
     * @since 0.1
     */
    public function testGetValueOf()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->createInstance($values);

        $this->assertEquals('Yourself', $subject->this()->_getValueOf('you'));
        $this->assertEquals(null, $subject->this()->_getValueOf('him'));
    }

    /**
     * Tests the value checker method to ensure that it correctly determines if a value
     * exists in the context or not, by key.
     *
     * @since 0.1
     */
    public function testHasValue()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->createInstance($values);

        $this->assertTrue($subject->this()->_hasValue('me'));
        $this->assertFalse($subject->this()->_hasValue('her'));
    }

    /**
     * Tests the single value setter method to ensure that the value is correctly internally set.
     *
     * @since 0.1
     */
    public function testSetValue()
    {
        $values = array(
            'me'  => 'Myself',
            'you' => 'Yourself',
        );
        $subject = $this->createInstance($values);

        $subject->this()->_setValue('him', 'Himself');
        $subject->this()->_setValue('we');

        $expected = array_merge($values, array(
            'him' => 'Himself',
            'we'  => null,
        ));

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the multiple value setter method to ensure that all values are correctly set and
     * all previous values are overwritten.
     *
     * @since 0.1
     */
    public function testSetValues()
    {
        $subject = $this->createInstance(array(
            'one' => 1,
            'two' => 2,
        ));

        $subject->this()->_setValues(array(
            'three' => 3,
            'four'  => 4,
        ));

        $expected = array(
            'three' => 3,
            'four'  => 4,
        );

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the value removal method to ensure that the value is correctly removed without
     * affecting the rest of the values.
     *
     * @since 0.1
     */
    public function testRemoveValue()
    {
        $values = array(
            'me'   => 'Myself',
            'you'  => 'Yourself',
            'misc' => 'This is a test',
        );
        $subject = $this->createInstance($values);

        $subject->this()->_removeValue('misc');

        $expected = array_diff_assoc($values, array('misc' => 'This is a test'));

        $this->assertEquals($expected, $subject->this()->value);
    }

    /**
     * Tests the method that removes all values to ensure that all values are removed.
     *
     * @since 0.1
     */
    public function testClearValues()
    {
        $subject = $this->createInstance(array(
            'one' => 1,
            'two' => 2,
        ));

        $subject->this()->_clearValues();

        $this->assertEmpty($subject->this()->value);
    }
}

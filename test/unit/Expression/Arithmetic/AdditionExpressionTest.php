<?php

namespace Dhii\Espresso\Test\Expression\Arithmetic;

use Dhii\Espresso\Context\RawContext;
use Dhii\Espresso\Expression\Arithmetic\AdditionExpression;
use Dhii\Espresso\Term\LiteralTerm;
use Dhii\Espresso\Term\VariableTerm;
use Xpmock\TestCase;

/**
 * Description of AdditionExpressionTest.
 *
 * @since [*next-version*]
 */
class AdditionExpressionTest extends TestCase
{
    /**
     * @since [*next-version*]
     *
     * @var AdditionExpression
     */
    protected $instance;

    /**
     * Creates an instance for testing.
     *
     * @since [*next-version*]
     *
     * @return AdditionExpression
     */
    public function createInstance()
    {
        return new AdditionExpression();
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
     * Tests the evaluation without any terms.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateNoTerms()
    {
        $this->assertEquals(0, $this->instance->evaluate());
    }

    /**
     * Tests the evaluation with a single literal term and a simple raw context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateOneLiteralTerm()
    {
        $this->instance->addTerm(new LiteralTerm(5));
        $ctx = new RawContext(5);

        $this->assertEquals(5, $this->instance->evaluate($ctx));
    }

    /**
     * Tests the evaluation with a single variable term and a simple raw context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateOneVariableTerm()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $ctx = new RawContext(5);

        $this->setExpectedException('\\Dhii\\Espresso\\EvaluationException');

        $this->instance->evaluate($ctx);
    }

    /**
     * Tests the evaluation with a single literal term and no context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateOneLiteralTermNoContext()
    {
        $this->instance->addTerm(new LiteralTerm(5));

        $this->assertEquals(5, $this->instance->evaluate());
    }

    /**
     * Tests the evaluation with a single variable term and no context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateOneVariableTermNoContext()
    {
        $this->instance->addTerm(new VariableTerm('x'));

        $this->setExpectedException('\\Dhii\\Espresso\\EvaluationException');

        $this->instance->evaluate();
    }

    /**
     * Tests the evaluation with a two literal terms.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateTwoLiteralTerms()
    {
        $this->instance->addTerm(new LiteralTerm(5));
        $this->instance->addTerm(new LiteralTerm(3));

        $this->assertEquals(8, $this->instance->evaluate());
    }

    /**
     * Tests the evaluation with a three literal terms.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateThreeLiteralTerms()
    {
        $this->instance->addTerm(new LiteralTerm(5));
        $this->instance->addTerm(new LiteralTerm(3));
        $this->instance->addTerm(new LiteralTerm(2));

        $this->assertEquals(10, $this->instance->evaluate());
    }

    /**
     * Tests the evaluation with a two variable terms and no context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateTwoVariableTermsNoContext()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new VariableTerm('y'));

        $this->setExpectedException('\\Dhii\\Espresso\\EvaluationException');

        $this->instance->evaluate();
    }

    /**
     * Tests the evaluation with a two variable terms and a context with some values omitted.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateTwoVariableTermsPartialContext()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new VariableTerm('y'));

        $ctx = new \Dhii\Espresso\Context\CompositeContext(array(
            'x' => 5,
        ));

        $this->setExpectedException('\\Dhii\\Espresso\\EvaluationException');

        $this->instance->evaluate($ctx);
    }

    /**
     * Tests the evaluation with a two variable terms and a fully comprehensive context.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateTwoVariableTermsFullContext()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new VariableTerm('y'));

        $ctx = new \Dhii\Espresso\Context\CompositeContext(array(
            'x' => 5,
            'y' => 7,
        ));

        $this->assertEquals(12, $this->instance->evaluate($ctx));
    }

    /**
     * Tests the evaluation with a variable term and a literal term.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateMixedTerms()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new LiteralTerm(18));

        $ctx = new \Dhii\Espresso\Context\CompositeContext(array(
            'x' => 2,
        ));

        $this->assertEquals(20, $this->instance->evaluate($ctx));
    }

    /**
     * Tests the evaluation with a variable term and an empty addition expression.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateVariableTermRecursive()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new AdditionExpression());

        $ctx = new \Dhii\Espresso\Context\CompositeContext(array(
            'x' => 5,
        ));

        $this->assertEquals(5, $this->instance->evaluate($ctx));
    }

    /**
     * Tests the evaluation with a variable term and an addition expression with two variable terms.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluateVariableTermRecursiveTwoVariableTerms()
    {
        $this->instance->addTerm(new VariableTerm('x'));
        $this->instance->addTerm(new AdditionExpression(
            new VariableTerm('y'),
            new VariableTerm('z')
        ));

        $ctx = new \Dhii\Espresso\Context\CompositeContext(array(
            'x' => 5,
            'y' => 1,
            'z' => 9,
        ));

        $this->assertEquals(15, $this->instance->evaluate($ctx));
    }

    /**
     * Tests the evaluation for commutativity.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluationCommutative()
    {
        $this->instance->setTerms(array(
            new LiteralTerm(4),
            new LiteralTerm(6),
        ));
        $result1 = $this->instance->evaluate();

        $this->instance->setTerms(array(
            new LiteralTerm(6),
            new LiteralTerm(4),
        ));
        $result2 = $this->instance->evaluate();

        $this->assertEquals($result1, $result2);
    }

    /**
     * Tests the evaluation for associativity.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluationAssociativity()
    {
        // 4 + (6 + 5)
        $this->instance->setTerms(array(
            new LiteralTerm(4),
            new AdditionExpression(
                new LiteralTerm(6),
                new LiteralTerm(5)
            ),
        ));
        $result1 = $this->instance->evaluate();

        // (4 + 6) + 5
        $this->instance->setTerms(array(
            new AdditionExpression(
                new LiteralTerm(4),
                new LiteralTerm(6)
            ),
            new LiteralTerm(5),
        ));
        $result2 = $this->instance->evaluate();

        $this->assertEquals($result1, $result2);
    }

    /**
     * Tests the evaluation with a negative literal term.
     *
     * @since [*next-version*]
     *
     * @covers \Dhii\Espresso\Expression\Arithmetic::evaluate
     */
    public function testEvaluationNegativeTerm()
    {
        // 4 + (6 + 5)
        $this->instance->setTerms(array(
            new LiteralTerm(4),
            new LiteralTerm(-8),
        ));

        $this->assertEquals(-4, $this->instance->evaluate());
    }
}

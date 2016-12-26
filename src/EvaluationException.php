<?php

namespace Dhii\Espresso;

use Dhii\Evaluable\EvaluationExceptionInterface;
use Exception;

/**
 * An exception that is thrown as a consequence of a problem during evaluation.
 *
 * @since [*next-version*]
 */
class EvaluationException extends Exception implements EvaluationExceptionInterface
{
}

<?php namespace ExpressionEvaluator\Operators\Arithmetic;


use ExpressionEvaluator\Operators\OperatorBase;

class Modulus extends OperatorBase
{
    const SYMBOL = '%';

    protected $precedence = 5;

    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);

        return $right % $left;
    }
}
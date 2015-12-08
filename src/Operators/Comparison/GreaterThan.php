<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:11
 */

namespace ExpressionEvaluator\Operators\Comparison;


use ExpressionEvaluator\Operators\OperatorBase;

class GreaterThan extends OperatorBase {

    const SYMBOL = '>';

    protected $precedence = 2;

    public function operate(\SplStack $stack) {
        $right = $stack->pop()->operate($stack);
        $left = $stack->pop()->operate($stack);

        return (int) ($left > $right);
    }
}
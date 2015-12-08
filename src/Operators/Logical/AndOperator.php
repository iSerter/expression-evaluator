<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:08
 */

namespace ExpressionEvaluator\Operators\Logical;
use ExpressionEvaluator\Operators\OperatorBase;

class AndOperator extends OperatorBase {

    const SYMBOL = 'AND';

    protected $precedence = 1;

    public function operate(\SplStack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return (int) ($left && $right);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:09
 */

namespace ExpressionEvaluator\Operators\Logical;

use ExpressionEvaluator\Operators\OperatorBase;

class OrOperator extends OperatorBase {

    const SYMBOL = 'OR';


    protected $precedence = 1;

    public function operate(\SplStack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return (int) ($left || $right);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:10
 */

namespace ExpressionEvaluator\Operators\Comparison;

use ExpressionEvaluator\Operators\OperatorBase;

class Equal extends OperatorBase {

    const SYMBOL = '==';

    protected $precedence = 3;

    public function operate(\SplStack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return (int) ($left == $right);
    }
}
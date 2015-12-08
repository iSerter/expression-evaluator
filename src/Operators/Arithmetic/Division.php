<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:04
 */

namespace ExpressionEvaluator\Operators\Arithmetic;


use ExpressionEvaluator\Operators\OperatorBase;

class Division extends OperatorBase {
    const SYMBOL = '/';

    protected $precedence = 5;

    public function operate(\SplStack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $right / $left;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:02
 */

namespace ExpressionEvaluator\Operators\Arithmetic;

use ExpressionEvaluator\Operators\OperatorBase;

class Subtraction extends OperatorBase {

    const SYMBOL = '-';

    protected $precedence = 4;

    public function operate(\SplStack $stack) {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $right - $left;
    }

}
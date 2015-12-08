<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 12:57
 */

namespace ExpressionEvaluator;


class Number extends Expression {

    public function operate(\SplStack $stack) {
        return $this->value;
    }

}
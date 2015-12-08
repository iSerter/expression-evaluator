<?php

namespace ExpressionEvaluator\Operators;
use ExpressionEvaluator\Expression;


/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 12:56
 */
abstract class OperatorBase extends Expression {

    protected $precidence = 0;
    protected $leftAssoc = true;

    public function getPrecedence() {
        return $this->precidence;
    }

    public function isLeftAssoc() {
        return $this->leftAssoc;
    }

    public function isOperator() {
        return true;
    }

}
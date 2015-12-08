<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 12:59
 */

namespace ExpressionEvaluator;


class Parenthesis extends Expression {

    protected $precedence = 6;

    public function operate(\SplStack $stack) {
    }

    public function getPrecedence() {
        return $this->precedence;
    }

    public function isNoOp() {
        return true;
    }

    public function isParenthesis() {
        return true;
    }

    public function isOpen() {
        return $this->value == '(';
    }

}
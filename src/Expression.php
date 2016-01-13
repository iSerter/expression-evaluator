<?php

namespace ExpressionEvaluator;

use ExpressionEvaluator\Operators\Arithmetic\Addition;
use ExpressionEvaluator\Operators\Arithmetic\Division;
use ExpressionEvaluator\Operators\Arithmetic\Modulus;
use ExpressionEvaluator\Operators\Arithmetic\Multiplication;
use ExpressionEvaluator\Operators\Arithmetic\Subtraction;
use ExpressionEvaluator\Operators\Comparison\Equal;
use ExpressionEvaluator\Operators\Comparison\GreaterThan;
use ExpressionEvaluator\Operators\Comparison\LessThan;
use ExpressionEvaluator\Operators\Logical\AndOperator;
use ExpressionEvaluator\Operators\Logical\OrOperator;


abstract class Expression {

    protected $value = '';

    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @param $value
     * @return Number|Equal|GreaterThan|LessThan|OrOperator|Parenthesis
     * @throws \Exception
     */
    public static function factory($value) {

        if ($value instanceof Expression) {
            return $value;
        }

        if (is_numeric($value)) {
            return new Number($value);
        }

        if (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        }

        switch($value) {
            case Addition::SYMBOL:
                return new Addition($value);
            case Subtraction::SYMBOL:
                return new Subtraction($value);
            case Multiplication::SYMBOL:
                return new Multiplication($value);
            case Division::SYMBOL:
                return new Division($value);
            case Modulus::SYMBOL:
                return new Modulus($value);
            case AndOperator::SYMBOL:
                return new AndOperator($value);
            case OrOperator::SYMBOL:
                return new OrOperator($value);
            case GreaterThan::SYMBOL:
                return new GreaterThan($value);
            case LessThan::SYMBOL:
                return new LessThan($value);
            case Equal::SYMBOL:
                return new Equal($value);
            default:
                throw new \InvalidArgumentException('Undefined Value ' . $value);
        }

    }

    abstract public function operate(\SplStack $stack);

    public function isOperator() {
        return false;
    }

    public function isParenthesis() {
        return false;
    }

    public function isNoOp() {
        return false;
    }

    public function render() {
        return $this->value;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 08.12.2015
 * Time: 13:42
 */

namespace ExpressionEvaluator;


use ExpressionEvaluator\Operators\OperatorBase;

class Engine {

    protected $variables = array();

    public function evaluate($string) {
        $stack = $this->parse($string);
        return $this->run($stack);
    }

    public function parse($string) {
        $tokens = $this->tokenize($string);
        $output = new \SplStack();
        $operators = new \SplStack();
        foreach ($tokens as $token) {
            $token = $this->extractVariables($token);

            $expression = Expression::factory($token);

            if ($expression->isOperator()) {
                $this->parseOperator($expression, $output, $operators);
            } elseif ($expression->isParenthesis()) {
                $this->parseParenthesis($expression, $output, $operators);
            } else {
                $output->push($expression);
            }
        }

        // validate parenthesises
        while (!$operators->isEmpty() && ($op = $operators->pop())) {
            if ($op->isParenthesis()) {
                throw new \Exception('Mismatched Parenthesis');
            }
            $output->push($op);
        }
        //var_dump($output);

        return $output;
    }

    public function registerVariable($name, $value) {
        $this->variables[$name] = $value;
    }

    public function run(\SplStack $stack) {
        while (!$stack->isEmpty() && ($operator = $stack->pop()) && $operator->isOperator()) {
            $value = $operator->operate($stack);
            if (!is_null($value)) {
                $stack->push(Expression::factory($value));
            }
        }
        return $operator ? $operator->render() : $this->render($stack);
    }

    protected function extractVariables($token) {
        if ($token[0] == '$') {
            $key = substr($token, 1);
            return isset($this->variables[$key]) ? $this->variables[$key] : 0;
        }
        return $token;
    }

    protected function render(\SplStack $stack) {
        $output = '';
        while (!$stack->isEmpty() && ($el = $stack->pop())) {
            $output .= $el->render();
        }
        if ($output) {
            return $output;
        }
        throw new \Exception('Cannot render');
    }

    protected function parseParenthesis(Parenthesis $expression, \SplStack $output, \SplStack $operators) {
        if ($expression->isOpen()) {
            $operators->push($expression);
        } else {
            $clean = false;
            while (!$operators->isEmpty() && ($end = $operators->pop())) {
                if ($end->isParenthesis()) {
                    $clean = true;
                    break;
                } else {
                    $output->push($end);
                }
            }
            if (!$clean) {
                throw new \RuntimeException('Mismatched Parenthesis');
            }
        }
    }

    protected function parseOperator(OperatorBase $expression, \SplStack $output, \SplStack $operators) {
        $end = !$operators->isEmpty() ? $operators->top() : null;

        if (!$end) {
            $operators->push($expression);
        } elseif ($end->isOperator()) {
            do {
                if ($expression->isLeftAssoc() && $expression->getPrecedence() <= $end->getPrecedence()) {
                    $el = $operators->isEmpty() ? null : $operators->pop();
                    $output->push($el);
                } elseif (!$expression->isLeftAssoc() && $expression->getPrecedence() < $end->getPrecedence()) {
                    $el = $operators->isEmpty() ? null : $operators->pop();
                    $output->push($el);
                } else {
                    break;
                }
            } while (!$operators->isEmpty() && ($end = $operators->top()) && $end->isOperator());
            $operators->push($expression);
        } else {
            $operators->push($expression);
        }
    }

    protected function tokenize($string) {
        $parts = preg_split('((\d+|\+|-|\(|\)|\*|/)|\s+)', $string, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $parts = array_map('trim', $parts);
        return $parts;
    }

}
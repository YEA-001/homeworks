<?php
$a = rand(0,20);
$b = rand(0,20);
$operator = '/';

switch ($operator) {
    case '+':
        echo "{$a}{$operator}{$b} = " . ($a + $b);
        break;
    case '-':
        echo "{$a}{$operator}{$b} = " . ($a - $b);
        break;
    case '/':
        if ($b){
            echo "{$a}{$operator}{$b} = " . ($a / $b);
        }else{
            echo 'div by zero';
        }
        break;
    case '*':
        echo "{$a}{$operator}{$b} = " . ($a * $b);
        break;
    default:
        echo 'unknown operator';
        break;
}

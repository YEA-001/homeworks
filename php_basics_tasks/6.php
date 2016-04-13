<?php
$name = 'Eugene';
$age = 32;

echo "Меня зовут: {$name} <br>";
echo "Мне {$age} лет<br>";

if ($age <= 59 && $age >=18){
    echo 'Мне ещё работать и работать';
}
elseif ($age > 59){
    echo 'Вам пора на пенсию';
}
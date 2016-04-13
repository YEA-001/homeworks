<?php
$name = 'Eugene';
$age = "fsda";

echo (int)($age);
echo "Меня зовут: {$name} <br>";
echo "Мне {$age} лет<br>";

if ($age <= 59 && $age >=18){
    echo 'Мне ещё работать и работать';
}
elseif ($age > 59){
    echo 'Вам пора на пенсию';
}
elseif (is_int($age) && $age >= 0 && $age <=17){
    echo 'Вам еще рано работать';
}
elseif ($age < 0 || is_int($age) ){
    echo 'Неизвестный возраст';
}

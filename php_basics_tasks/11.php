<?php
$day = rand(0,7);

switch($day):
    case $day <=5 && $day >=1:
        echo 'Это рабочий день';
        break;
    case 6:
    case 7:
        echo 'Это выходной день';
        break;
endswitch;
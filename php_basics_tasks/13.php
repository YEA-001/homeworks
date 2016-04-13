<?php
$s = rand(60,100);  //km
$t = rand(40,60);   //min

echo "{$s}km*60/{$t}min = " . (float)$s*60/$t . "km/hrs<br>";

echo "{$s}*1000m/({$t}*60)min = " . (float)$s*1000/($t*60) . "m/s";


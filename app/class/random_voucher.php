<?php


// Función para generar números aleatorios únicos
function NumberUnique($quantity)
{
    $numbers = range(1, $quantity);
    shuffle($numbers);
    return $numbers;
}
// Generar 1000000 números aleatorios únicos
$Numbers = NumberUnique(1000000);
$Number = $Numbers[0];

// Devolver el número generado
return $Number;

?>
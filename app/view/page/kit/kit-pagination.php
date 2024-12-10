<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $kit = $kitController->searchKit($name);
    $total = count($kit); // Actualizar el total para la búsqueda
} else {
    $kit = $kitController->getKitPagination($start, $itemPage);
    $total = $kitController->countKit();
}

$totalPage = ceil($total / $itemPage);
?>
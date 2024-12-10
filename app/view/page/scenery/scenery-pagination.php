<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $scenery = $sceneryController->searchScenery($name);
    $total = count($scenery); // Actualizar el total para la búsqueda
} else {
    $scenery = $sceneryController->getSceneryPagination($start, $itemPage);
    $total = $sceneryController->countScenery();
}

$totalPage = ceil($total / $itemPage);
?>
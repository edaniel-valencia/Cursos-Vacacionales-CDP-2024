<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $sport = $sportController->searchSport($name);
    $total = count($sport); // Actualizar el total para la búsqueda
} else {
    $sport = $sportController->getSportPagination($start, $itemPage);
    $total = $sportController->countSport();
}

$totalPage = ceil($total / $itemPage);
?>
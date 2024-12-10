<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $module = $moduleController->searchModule($name);
    $total = count($module); // Actualizar el total para la búsqueda
} else {
    $module = $moduleController->getModulePagination($start, $itemPage);
    $total = $moduleController->countModule();
}

$totalPage = ceil($total / $itemPage);
?>
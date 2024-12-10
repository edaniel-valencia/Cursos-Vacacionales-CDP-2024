<?php
$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $role = $roleController->searchRole($name);
    $total = count($role); // Actualizar el total para la búsqueda
} else {
    $role = $roleController->getRolePagination($start, $itemPage);
    $total = $roleController->countRole();

}

$totalPage = ceil($total / $itemPage);

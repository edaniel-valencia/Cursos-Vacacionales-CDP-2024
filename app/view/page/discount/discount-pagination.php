<?php

$itemPage = 10;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;

// Obtener datos de categoría
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $discount = $discountController->searchDiscount($name);
    $total = count($discount); // Actualizar el total para la búsqueda
} else {
    $discount = $discountController->getDiscountPagination($start, $itemPage);
    $total = $discountController->countDiscount();
}

$totalPage = ceil($total / $itemPage);
?>
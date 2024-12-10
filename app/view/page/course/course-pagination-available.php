<?php
$itemPage = 12;
$page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
$start = ($page - 1) * $itemPage;
if (isset($_GET['search'])) {
    $name = $_GET['search'];
    $courses = $courseController->searchCourseAvailable($name);
    $total = count($courses);
    $totalPage = ceil($total / $itemPage);
    $courses = array_slice($courses, $start, $itemPage);
} else {
    $courses = $courseController->getAllCourseAvailable();
    $total   = $courseController->countCourseAvailable();
    $totalPage = ceil($total / $itemPage);
    $courses = array_slice($courses, $start, $itemPage);
}

// $itemPage = 10;
// $page = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
// $start = ($page - 1) * $itemPage;
// if (isset($_GET['search'])) {
//     $name = $_GET['search'];
//     $users = $userController->searchUser($name);
//     $total = count($users);
//     $totalPage = ceil($total / $itemPage);
//     $users = array_slice($users, $start, $itemPage);
// } else {
//     $users = $userController->getAllUsers();
//     $total = $userController->countUser();
//     $totalPage = ceil($total / $itemPage);
//     $users = array_slice($users, $start, $itemPage);
// }   


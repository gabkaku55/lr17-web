<?php
require "config.php";
require "controllers/StudentController.php";
$action = $_GET['action'] ?? 'index';
switch ($action) 
{
    case 'edit':  StudentController::edit($pdo, $_GET['id']); break;
    case 'update':  StudentController::update($pdo);  break;
    case 'delete':  StudentController::deleteConfirm($pdo, $_GET['id']);  break;
    case 'deleteConfirm':  StudentController::delete($pdo);  break;
    default: StudentController::index($pdo);  break;
}

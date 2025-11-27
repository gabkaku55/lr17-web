<?php
require_once "config.php";
require_once "core/Model.php";
require_once "controllers/StudentController.php";
if (isset($_GET['id']) && !isset($_GET['action'])) 
    {
    require_once "student.php";
    exit;
}
$action = $_GET['action'] ?? 'index';
switch ($action) 
{
    case 'edit': StudentController::edit($pdo, $_GET['id'] ?? null); break;
    case 'update': StudentController::update($pdo);break;
    case 'delete': StudentController::deleteConfirm($pdo, $_GET['id'] ?? null); break;
    case 'deleteConfirm': StudentController::delete($pdo); break;
    default: StudentController::index($pdo); break;
}

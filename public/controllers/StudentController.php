<?php
require_once "models/Student.php";
class StudentController
{
    public static function index($pdo)
    {
        $students = Student::all($pdo);
        include "views/list.php";
    }
    public static function edit($pdo, $id)
    {
        $student = Student::find($pdo, $id);
        include "views/edit.php";
    }
    public static function update($pdo)
    {
        $st = Student::find($pdo, $_POST['id']);
        $st->full_name = $_POST['full_name'];
        $st->grade = $_POST['grade'];
        $st->phone = $_POST['phone'];
        $st->email = $_POST['email'];
        $st->update();

        header("Location: index.php");
    }
    public static function deleteConfirm($pdo, $id)
    {
        $student = Student::find($pdo, $id);
        include "views/delete.php";
    }
    public static function delete($pdo)
    {
        $student = Student::find($pdo, $_POST['id']);
        $student->delete();
        header("Location: index.php");
    }
}

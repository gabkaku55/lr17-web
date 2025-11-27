<?php
require_once __DIR__ . '/../models/Student.php';
class StudentController
{
    public static function index($pdo)
    {
        $students = Student::all($pdo);
        include __DIR__ . '/../views/list.php';
    }
    public static function edit($pdo, $id)
    {
        $student = Student::find($pdo, $id);
        include __DIR__ . '/../views/edit.php';
    }
    public static function update($pdo)
    {
        $st = Student::find($pdo, $_POST['id']);
        $dataToUpdate = [
            'full_name' => $_POST['full_name'],
            'grade' => $_POST['grade'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ];
        foreach ($dataToUpdate as $key => $value)
             {
            $st->$key = $value;
        }
        $st->update($dataToUpdate);

        header("Location: index.php");
        exit;
    }
    public static function deleteConfirm($pdo, $id)
    {
        $student = Student::find($pdo, $id);
        include __DIR__ . '/../views/delete.php';
    }
    public static function delete($pdo)
    {
        $student = Student::find($pdo, $_POST['id']);
        if ($student) {
            $student->delete();
        }
        header("Location: index.php");
        exit;
    }
}

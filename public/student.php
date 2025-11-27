<?php
require_once "config.php";
require_once "core/Model.php";
if (isset($_GET['id'])) 
    {
    $id = (int)$_GET['id'];
    $student = Model::find($pdo, $id, 'students');
    if ($student) 
        {
        echo "<h1>Студент</h1>";
        echo "<h2>" . htmlspecialchars($student->full_name) . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Поле</th><th>Значення</th></tr>";
        echo "<tr><td>ID</td><td>" . htmlspecialchars($student->id) . "</td></tr>";
        echo "<tr><td>Оцінка</td><td>" . htmlspecialchars($student->grade) . "</td></tr>";
        echo "<tr><td>Телефон</td><td>" . htmlspecialchars($student->phone) . "</td></tr>";
        echo "<tr><td>Email</td><td>" . htmlspecialchars($student->email) . "</td></tr>";
        echo "</table>";
    } else 
    {
        echo "Студента не знайдено.";
    }
    exit;
}
$students = Model::all($pdo, 'students');
if (count($students) > 0) 
    {
    echo "<h1>Список студентів</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>ПІБ</th><th>Оцінка</th><th>Телефон</th><th>Email</th></tr>";
    foreach ($students as $student) 
        {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student->id) . "</td>";
        echo "<td>" . htmlspecialchars($student->full_name) . "</td>";
        echo "<td>" . htmlspecialchars($student->grade) . "</td>";
        echo "<td>" . htmlspecialchars($student->phone) . "</td>";
        echo "<td>" . htmlspecialchars($student->email) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else 
{
    echo "База даних порожня.";
}

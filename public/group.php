<?php
require_once "config.php";
require_once "core/Model.php";
require_once "models/Group.php";
require_once "models/Student.php";
if (isset($_GET['id']))
     {
    $group = Group::find($pdo, (int)$_GET['id']);
    if ($group) 
        {
        echo "<h1>Група: " . htmlspecialchars($group->title) . "</h1>";
        $stmt = $pdo->prepare("SELECT * FROM students WHERE group_id = :title");
        $stmt->execute(['title' => $group->title]);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($students) > 0) {
            echo "<h2>Студенти цієї групи:</h2>";
            echo "<table border='1' cellpadding='8'>";
            echo "<tr><th>ID</th><th>ПІБ</th><th>Оцінка</th><th>Телефон</th><th>Email</th></tr>";
            foreach ($students as $student) 
                {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student['id']) . "</td>";
                echo "<td>" . htmlspecialchars($student['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($student['grade']) . "</td>";
                echo "<td>" . htmlspecialchars($student['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($student['email']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else 
        {
            echo "<p>У цій групі немає студентів.</p>";
        }
    } else 
    {
        echo "<p>Групу не знайдено.</p>";
    }
    exit;
}
$groups = Group::all($pdo);
if (count($groups) > 0) 
    {
    echo "<h1>Список груп</h1>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Назва групи</th></tr>";
    foreach ($groups as $group) 
        {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($group->id) . "</td>";
echo "<td><a href='group.php?id=" . $group->id . "' style='color: black; text-decoration: none;'>" . htmlspecialchars($group->title) . "</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else 
{
    echo "<p>У базі даних немає груп.</p>";
}

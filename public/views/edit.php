<link rel="stylesheet" href="style.css">
<h2>Редагування студента</h2>
<form method="POST" action="index.php?action=update">
    <input type="hidden" name="id" value="<?= $student->id ?>">
    ПІБ: <br><input type="text" name="full_name" value="<?= $student->full_name ?>"><br><br>
    Оцінка: <br><input type="number" name="grade" value="<?= $student->grade ?>"><br><br>
    Телефон: <br><input type="text" name="phone" value="<?= $student->phone ?>"><br><br>
    Email: <br><input type="email" name="email" value="<?= $student->email ?>"><br><br>
    <button type="submit">Зберегти</button>
</form>
<a href="index.php">Назад</a>

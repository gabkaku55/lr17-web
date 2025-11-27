<link rel="stylesheet" href="style.css">
<h1>Список студентів</h1>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ПІБ</th>
        <th>Оцінка</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Дії</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student->id) ?></td>
            <td><?= htmlspecialchars($student->full_name) ?></td>
            <td><?= htmlspecialchars($student->grade) ?></td>
            <td><?= htmlspecialchars($student->phone) ?></td>
            <td><?= htmlspecialchars($student->email) ?></td>
            <td>
            <div class="action-buttons">
            <a class="edit-btn" href="index.php?action=edit&id=<?= $student->id ?>">Редагувати</a>
            <a class="delete-btn" href="index.php?action=delete&id=<?= $student->id ?>">Видалити</a>
            </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

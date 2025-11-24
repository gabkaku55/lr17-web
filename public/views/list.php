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
    <?php foreach ($students as $st): ?>
        <tr>
            <td><?= $st->id ?></td>
            <td><?= $st->full_name ?></td>
            <td><?= $st->grade ?></td>
            <td><?= $st->phone ?></td>
            <td><?= $st->email ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $st->id ?>">Редагувати</a> |
                <a href="index.php?action=delete&id=<?= $st->id ?>">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

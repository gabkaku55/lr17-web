<h2>Видалення студента</h2>
<p>Ви точно хочете видалити студента: <b><?= $student->full_name ?></b>?</p>
<form method="POST" action="index.php?action=delete">
    <input type="hidden" name="id" value="<?= $student->id ?>">
    <button type="submit">Так, видалити</button>
</form>
<a href="index.php">Назад</a>

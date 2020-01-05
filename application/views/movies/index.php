<p><a href="create">Добавить фильм/сериал</a></p><br>

<h1>Все фильмы</h1>

<?php foreach ($movies as $key => $value): ?>
	<p><a href="view/<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></a> | <a href="edit/<?php echo $value['slug']; ?>">edit</a> | <a href="delete/<?php echo $value['slug']; ?>">delete</a></p>
<?php endforeach ?>

<h1>Все сериалы</h1>

<?php foreach ($serials as $key => $value): ?>
	<p><a href="view/<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></a> | <a href="edit/<?php echo $value['slug']; ?>">edit</a> | <a href="delete/<?php echo $value['slug']; ?>">delete</a></p>
<?php endforeach ?>
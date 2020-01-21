<h1>Все новости</h1>

<?php if ($this->dx_auth->is_admin()) { ?>
	<p><a href="create">Добавить новость</a></p><br>
	<?php  } ?>

	<?php foreach ($news as $key => $value): ?>
	<p><a href="view/<?php echo $value['slug']; ?>"><?php echo $value['title']; ?></a> | <a href="edit/ <?php echo $value['slug']; ?>">edit</a> | <a href="delete/  <?php echo $value['slug']; ?>">delete</a></p>
	<?php endforeach ?>
<h1>Все посты</h1><br>

<?php if($this->dx_auth->is_admin()) { ?>
	<p><a href="create">Добавить пост</a></p><br>
<?php   } ?>

<?php foreach ($posts as $key => $value): ?>
	<p><a href="view/<?php echo $value['slug']; ?>"><?php echo $value['title']; ?></a>
	<?php if($this->dx_auth->is_admin()) { ?>
	 | <a href="edit/<?php echo $value['slug']; ?>">edit</a> | <a href="delete/<?php echo $value['slug']; ?>">delete</a></p>
	<?php   } ?>
<?php endforeach ?>
<h2>Поиск (найдено <?php echo $tCount; ?>)</h2>

<?php foreach ($search_result as $key => $value): ?>
<div class="well">
	<a href="/movies/view/<?php echo $value['slug']; ?>"><?php echo $value['name']; ?</a><br><br> <?php echo $value['descriptions']. '<br>'; ?>
</div>
<?php endforeach  ?>
<?php echo $pagination; ?>
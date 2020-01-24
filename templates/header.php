<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>

	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	
	<div class="container-fluid">
		<div class="row">
			<nav role="navigation" class="navbar navbar-inverse">
				<div class="container">
					<div class="navbar-header header">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<h1><a href="/kinobaza">Кинобаза</a></h1>
									<p>Кино - наша стасть!</p>
								</div>
					</div>
				</div>
				<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span>
					<span  class="icon-bar"></span>
					<span  class="icon-bar"></span>
					<span  class="icon-bar"></span>
				</button>
			</div>
			<div id="navbarCollapse" class="collapse navbar-collapse navbar-right">
				<ul class="nav nav-nav-pills">
					<li <?php echo show_active_menu(0,0);?>> <a
					href="/">Главная</a> </li>
					<li <?php echo show_active_menu('films', $category);?>> <a
					href="/movies/type/films">Фильмы</a> </li>
					<li <?php echo show_active_menu('serials', $category);?>> <a
					href="/movies/type/serials">Сериалы</a> </li>
					<li <?php echo show_active_menu('rating',0);?>> <a
					href="/rating">Рейтинг фильмов</a> </li>
					<li <?php echo show_active_menu('contact',0);?>> <a
					href="/contact">Контакты</a> </li>
				</ul>
			</div>
			</div>
			</nav>
		</div>
	</div>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-lg-push-3">
					<form role="search" action="/search" method="get" class="visible-xs">
						<div class="form-group">
							<div class="input-group">
								<input type="search" name="q_search" class="form-control input-lg" placeholder="Ваш запрос">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-seach"></i></button>
							</div>
						</div>
	</div>
</form>
</body>
</html>
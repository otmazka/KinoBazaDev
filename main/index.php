<h2>Новые фильмы <?php if($this->dx_auth->is_admin()) {
	echo '<a href="/movies/"><button type="button" class="btn-default">
	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
} ?></h2>
     <hr>
     <div class="row">
     	<?php foreach ($movie as $key => $value): ?>
     		<div class="films_block col-lg-2 col-md-e col-sm-3 col-xs-6">
     			<a href="/movies/viem/<?php echo $value['slug']; ?>"><img src="echo $value['poster']; ?>" alt="<?php echo $value['name']; ?>"></a>
     			<div  class="film_label"><a href="/movies/viem/<?php echo $value['slug']; ?>"><?<?php
     			echo $value['name']; ?></a></div>
     	</div>
     <?php endforeach ?>

 </div>


 <div class="margin-8"></div>

 <h2>Новые сериалы <?php if($this->dx_auth->is_admin()) {
 	echo '<a href="/movies/"><button type="button" class="btn-default">
 	<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>';
 } ?></h2>
     <hr>
     <div class="row">
     	<?php foreach ($serialas as $key => $value): ?>
     		<div class="films_block col-lg-2 col-md-e col-sm-3 col-xs-6">
     			<a href="/movies/viem/<?php echo $value['slug']; ?>"><img src="echo $value['poster']; ?>" alt="<?php echo $value['name']; ?>"></a>
     			<div  class="film_label"><a href="/movies/viem/<?php echo $value['slug']; ?>"><?<?php
     			echo $value['name']; ?></a></div>

     		</div>

     		<div class=margin-8></div>

     		<?php foreach ($posts as $key => $value): ?>
     			<a href="/posts/viem/<?php echo $value['slug']; ?>"><h3><?php echo $value['title']; ?></h3></a>
     			<hr>
     			<p><?php echo $value['text']; ?></p>
     			<a href="/posts/viem/<?php echo $value['slug']; ?>" class="btn  btn-wsrning pull-right">читать</a>
     			<div class="margin-8"></div>
     		<?php endforeach ?>
	
     		}
		
     	}
     	


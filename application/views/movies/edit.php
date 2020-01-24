<form action="" method="post">



<input class="form-control input-lg" type="input" name="slug" value="<?php echo $slug_movies; ?>" placeholder="слизняк"><br>
<input class="form-control input-lg" type="input" name="name"  value="<?php echo $name_movies; ?>" placeholder="название фильма"><br>
<textarea class="form-control input-lg"  name="descriotions" placeholder="описание"><?php echo $descriotions_movies; ?></textarea><br>
<input class="form-control input-lg" type="input" name="year"  value="<?php echo $year_movies; ?>" placeholder="год"><br>
<input class="form-control input-lg" type="input" name="rating"  value="<?php echo $rating_movies; ?>" placeholder="рейтинг"><br>
<input class="form-control input-lg" type="input" name="poster"  value="<?php echo $poster_movies; ?>" placeholder="ссылка на постер"><br>
<input class="form-control input-lg" type="input" name="player_code"  value="<?php echo $player_code_movies; ?>" placeholder="ссылка на плеер"><br>
<input class="form-control input-lg" type="input" name="director"  value="<?php echo $director_movies; ?>" placeholder="режиссёр"><br>
<input class="form-control input-lg" type="input" name="add_date"  value="<?php echo $add_date_movies; ?>" placeholder="дата добавления"><br>
<input class="form-control input-lg" type="input" name="category_id"  value="<?php echo $category_id_movies; ?>" placeholder="категория(1=фильм; 2=сериал)"><br>
<input type="submit" name="submit" class="btn btn-succes"value="редактировать фильм/сериал">

</form>
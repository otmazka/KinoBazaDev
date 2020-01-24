<div class = "well">
	<?php $attributes = array("class"=> "form-horizontal", "name" =>"contactform");
	echo form_open("/contact", $attributes);?>
   <fieldset>
   <legend><h2>Контакты</h2></legend>
   <p id = "cont"> Отправте ваш отзыв о портале КиноМонстр</p>
   <div class = "from-group">
   	<input class = "from-control" name = "name" placeholder="Ваше имя" type = "text" value = "<?php echo set_value('name'); ?>" />
   	<span class="text-danger"><?php echo form_error('name'); ?></span>
   </div>

   <div class = "from-group">
   		<input class = "from-control" name = "email" placeholder="Ваш email" type = "text" value = "<?php echo set_value('email'); ?>" />
   			<span class="text-danger"><?php echo form_error('email'); ?></span>
   </div>

     <div class = "from-group">
   		<input class = "from-control" name = "subject" placeholder="Тема" type = "text" value = "<?php echo set_value('subject'); ?>" />
   			<span class="text-danger"><?php echo form_error('subject'); ?></span>
   </div>

    <div class = "from-group">
   		<textarea class = "from-control" name = "message" rows = "4"  placeholder="Ваш отзыв"> <?php echo set_value('message'); ?></textarea>
   			<span class="text-danger"><?php echo form_error('message'); ?></span>
   </div>
   <div class = "from-group">
   	<input name = "submit" type = "submit" class = "btn btn-lg btn-warning pull-right" value = "отправить"/>
   </div>
   </fieldset>
   <?php echo form_close(); ?>
    <?php echo $this->session->flashdata('msg'); ?>
     </div>
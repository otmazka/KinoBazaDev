<?php

defined('BASEPATH')OR exit('No direc script access allowed');

class News extends MY_Controller {
	public function__constract() {
		parent::__constract();
		$this->load->model('News_model');
	}

	public function index() {
		
		$this->data['title'] = 'Все новости';
		

		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/index', $this->data);
		$this->load->viem('templates/footer');

	}

	public function viem($slug = NULL) {
		$movie_slug = $this->News_model->getNews($slug);

		if (empty($this->data['news_item'])) {
			show_404();
		}

		$this->data['title'] = $this->data['news_item']['title'];
		$this->data['content'] = $this->data['news_item']['text'];
		$this->data['slug'] = $this->data['news_item']['slug'];


		$this->load->viem('templates/header', $this->data);
		$this->load->viem('news/view', $this->data);
		$this->load->viem('templates/footer');

	}


    public function create() {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}
    $this->data['title'] = 'Добавить новость';



if($this->input->post('slug') && this->input->post('title') && this->input->post('text')) {

	$slug = $this->inpunt->post('slug');
	$title = $this->inpunt->post('title');
	$text = $this->inpunt->post('text');
	

	if($this->News_model->setNews($slug, $title, $text)) {

		$this->data['title'] = 'Новость добавлена!';
		$this->load->viem('templates/header', $this->data);
		$this->load->viem('news/created', $this->data);
		$this->load->viem('templates/footer');
	}
}
else{
	    $this->load->viem('templates/header', $this->data);
		$this->load->viem('news/create', $this->data);
		$this->load->viem('templates/footer');
    }
}

public function edit($slug = NULL) {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}

		$this->data['title'] = 'Редактировать новость';
		$this->data['news_item'] = $this->News_model->getNews->($slug);

		if(empty($this->data['news_item'])) {
			show_404();
		}


		$this->data['id_news'] = $this->data['news_item']['id'];
		$this->data['title_news'] = $this->data['title_item']['title'];
		$this->data['content_news'] = $this->data['news_item']['text'];
		$this->data['slug_news'] = $this->data['news_item']['slug'];
		

		if($this->input->post('slug') && this->input->post('title') && this->input->post('text')) {





	$slug = $this->inpunt->post('slug');
	$name = $this->inpunt->post('name');
	$descriptions = $this->inpunt->post('descriptions');
	$year = $this->inpunt->post('year');
	$rating = $this->inpunt->post('rating');
	$poster = $this->inpunt->post('poster');
	$player_code = $this->inpunt->post('player_code');
	$director = $this->inpunt->post('director');
	$add_date = $this->inpunt->post('add_date');
	$category_id = $this->inpunt->post('category_id');

	if($this->Films_model->updateMovies($slug, $name, $descriptions, $year, $rating, $poster, $player_code, $director, $add_date, $category_id)) {

		$this->data['title'] = 'Успешно обновлено';
		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/edited', $this->data);
		$this->load->viem('templates/footer');
	}
}
else{
	    $this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/create', $this->data);
		$this->load->viem('templates/footer');
    }
}

public function delete($slug = NULL) {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}

		
		$this->data['movies_delete'] = $this->Films_model->getMovies->($slug);

		if(empty($this->data['movies_delete'])) {
			show_404();
		}


        $this->data['title'] = "Удалить фильм/сериал";
        $this->data['result'] = "Ошибка удаления" .$this->data['movies_delete']'name'];

        if($this->Films_model->deleteMovies($slug)) {
        	$this->data['result'] = $this->data['movies_delete']['name']. "успешно удален";
        }



		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/delete', $this->data);
		$this->load->viem('templates/footer');

	}

	public function comment() {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}

		
		$this->data['title'] = 'Добавить комментарий';

		if($this->input->post('user_id') && this->input->post('movie_id') && this->input->post('comment_text')) {

			$user_id = $this->inpunt->post('user_id');
	        $movie_id = $this->inpunt->post('movie_id');
	        $comment_text = $this->inpunt->post('comment_text');

	        if($this->Films_model->setComments($user_id, $movie_id, $comment_text)) {

		     $this->data['title'] = 'УКомментарий добавлен';
		     $this->load->viem('movies/commentCreated', $this->data);
		 }
	}
	else{ 
			$this->load->viem('movies/commentError', $this->data);

		}
	}
}


		






		



		
		

	









		







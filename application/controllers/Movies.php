<?php

defined('BASEPATH')OR exit('No direc script access allowed');

class Movies extends MY_Controller {
	public function__constract() {
		parent::__constract();
		$this->load->model('Films_model');
	}

	public function index() {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}


		$this->data['title'] = 'Все фильмы/сериалы';
		$this->data['movies'] = $this->Films_model->getMovies();
		$this->data['serials'] = $this->Films_model->getSeriasls();

		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/index', $this->data);
		$this->load->viem('templates/footer');

	}

	public function viem($slug = NULL) {
		$movie_slug = $this->Films_model->getFilms($slug, false, false);

		if (empty($movie_slug)) {
			show_404();
		}
		$this->load->model('Comments_model');
		$this->data['comments'] = $this->Comments_model->getComments($movie_slug['id'], 100);

		$this->data['id'] = $movie_slug['id'];
		$this->data['slug'] = $movie_slug['slug'];
		$this->data['title'] = $movie_slug['title'];
		$this->data['player_code'] = $movie_slug['player_code'];
		$this->data['year'] = $movie_slug['year'];
		$this->data['rating'] = $movie_slug['rating'];
		$this->data['descriptions_movie'] = $movie_slug['descriptions_movie'];
		$this->data['director'] = $movie_slug['director'];
		$this->data['category'] = $movie_slug['category_id'];

		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/index', $this->data);
		$this->load->viem('templates/footer');

	}

	public function type($slug = NULL) {

   	    $this->data['movie_data'] = NULL;

   	    $this->load->library('pagination');
    	$offset = (int) $this->uri->segment(4);
   	    $row_count = 3;
    	$count = 0;

    if ($slug == 'films') {
    	$count = count($this->Films_model->getMoviesOnPage(0, 0, 1));
   	    $p_config['base_url'] = '/movies/type/films';
   	    $this->data['title'] = 'Фильмы'
   	    $count->data['movie_data'] = $this->Films_model->getMoviesOnPage($row_count, $offset, 1);
   	}

   	if ($slug == 'serials') {
    	$count = count($this->Films_model->getMoviesOnPage(0, 0, 2));
   	    $p_config['base_url'] = '/movies/type/serials';
   	    $this->data['title'] = 'Сериалы'
   	    $count->data['movie_data'] = $this->Films_model->getMoviesOnPage($row_count, $offset, 2);
   	}

   	if ($this->data['movie_data'] == NULL) {
   		show_404();
   		
   	}

   	    $p_config['total_rows'] = $count;
   	    $p_config['per_page'] = $row_count;

   	    $p_config['full_tag_open'] = "<ul class='pagination'>";
    	$p_config['full_tag_close'] = "</ul>";
    	$p_config['num_tagl_open'] = "<li>";
    	$p_config['num_tag_close'] = "</li>";
    	$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    	$p_config['cur_tagl_close'] = "<span class='sr-only'></span></a></li>";
    	$p_config['next_tag_open'] = "<li>";
    	$p_config['next_tagl_close'] = "</li>";
    	$p_config['prev_tag_open'] = "<li>";
    	$p_config['prev_tagl_close'] = "</li>";
    	$p_config['first_tag_open'] = "<li>";
    	$p_config['first_tagl_close'] = "</li>";
    	$p_config['last_tag_open'] = "<li>";
    	$p_config['last_tagl_close'] = "</li>";


    	$this->pagination->initialize($p_config);
    	$this->data['pagination'] = $this->pagination->create_links();

    	$this->load->viem('templates/header', $this->data);
	    $this->load->viem('movies/rating', $this->data);
	    $this->load->viem('templates/footer');
    }

    public function create() {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}
    $this->data['title'] = 'Добавить фильм/сериал';

if($this->input->post('slug') && this->input->post('name') && this->input->post('descriptions') && this->input->post('year') && this->input->post('rating') && this->input->post('poster') && this->input->post('player_code') && this->input->post('director') && this->input->post('add_date') && this->input->post('category_id')) {

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

	if($this->Films_model->setMovies($slug, $name, $descriptions, $year, $rating, $poster, $player_code, $director, $add_date, $category_id)) {

		$this->data['title'] = 'Фильм добавлен';
		$this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/created', $this->data);
		$this->load->viem('templates/footer');
	}
}
else{
	    $this->load->viem('templates/header', $this->data);
		$this->load->viem('movies/create', $this->data);
		$this->load->viem('templates/footer');
    }
}

public function edit($slug = NULL) {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}

		$this->data['title'] = 'Редактировать фильм/сериал';
		$this->data['movies_item'] = $this->Films_model->getMovies->($slug);

		if(empty($this->data['movies_item'])) {
			show_404();
		}


		$this->data['id_movies'] = $this->data['movies_item']['id'];
		$this->data['slug_movies'] = $this->data['movies_item']['slug'];
		$this->data['name_movies'] = $this->data['movies_item']['name'];
		$this->data['descriptions_movies'] = $this->data['movies_item']['descriptions'];
		$this->data['year_movies'] = $this->data['movies_item']['year'];
		$this->data['rating_movies'] = $this->data['movies_item']['rating'];
		$this->data['poster_movies'] = $this->data['movies_item']['id'];
		$this->data['player_code_movies'] = $this->data['movies_item']['player_code'];
		$this->data['director_movies'] = $this->data['movies_item']['director'];
		$this->data['category_id_movies'] = $this->data['movies_item']['category_id'];

		if($this->input->post('slug') && this->input->post('name') && this->input->post('descriptions') && this->input->post('year') && this->input->post('rating') && this->input->post('poster') && this->input->post('player_code') && this->input->post('director') && this->input->post('add_date') && this->input->post('category_id')) {

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


		






		



		
		

	









		







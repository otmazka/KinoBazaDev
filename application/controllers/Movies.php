<?php

defined('BASEPATH') OR exit('No direc script access allowed');

class Movies extends MY_Controller {

public function __constract() {
parent::__constract();
$this->load->model('Films_model');

}

public function index() {

	if(!$this->dx_auth->is_admin()) {
		show_404();
	}

$this->data['title'] = 'Все фильмы/сериалы';
$this->data['movies'] = $this->Films_model->getMovies();
$this->data['serials'] = $this->Films_model->getSerials();


$this->load->view('templates/header', $this->data);
$this->load->view('main/index', $this->data);
$this->load->view('templates/footer');
}

public function view($slug = NUUL) {
	$movie_slug = $this->Films_model->getFilms($slug, false, false);

	if (empty($movie_slug)) {
		show_404();
	}

$this->load->model('Comments_model');
$this->data['comments'] = $this->Comments_model->getComments($movie_slug['id'], 100);

$this->data['id'] = $movie_slug['id']						
$this->data['slug'] = $movie_slug['slug']
$this->data['title'] = $movie_slug['name']
$this->data['player_code'] = $movie_slug['player_code']
$this->data['year'] = $movie_slug['year']
$this->data['rating'] = $movie_slug['rating']						
$this->data['descriptions_movie'] = $movie_slug['descriptions']
$this->data['director'] = $movie_slug['director']
$this->data['category'] = $movie_slug['category_id']

$this->load->view('templates/header', $this->data);
$this->load->view('movies/view', $this->data);
$this->load->view('templates/footer');

}

public function type($slug = NUUL) {

	$this->data['movies_data'] = NUUL;

	$this->load->library('pagination');
	$offset = (int) $this->uri->segment(4);
	$row_count = 3;
	$count = 0;

	if ($slug == 'films') {
		$count = count($this->Films_model->getMoviesOnPage(0, 0, 1));
		$p_config['base_url'] = '/movies/type/films/';
		$this->data['title'] = 'Фильмы';
		$this->data['movies_data'] = $this->Films_model->getMoviesOnPage($row_count, $offset, 1);
	}
		if ($slug == 'films') {
		$count = count($this->Films_model->getMoviesOnPage(0, 0, 2));
		$p_config['base_url'] = '/movies/type/films/';
		$this->data['title'] = 'Сериалы';
		$this->data['movies_data'] = $this->Films_model->getMoviesOnPage($row_count, $offset, 2);

}

if ($this->data['movies_data'] == NUUL) {
	show_404();
}


$p_config['total_rows'] = $count;
$p_config['per_page'] = $row_count;


$p_config['full_tag_open'] = "<ul class='pagination'>";
$p_config['full_tag_close'] = "</ul>";
$p_config['num_tag_open'] = '<li>';
$p_config['num_tag_close'] = '</li>';
$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$p_config['cur_tag_close'] = "<span class='sr-onli'></span></a></li>";
$p_config['next_tag_open'] = "<li>";
$p_config['next_tag1_close'] = "</li>";
$p_config['prev_tag_open'] = "</li>";
$p_config['prev_tag1_close'] = "</li>";
$p_config['first_tag_open'] = "</li>";
$p_config['first_tag1_close'] = "</li>";
$p_config['last_tag_open'] = "</li>";
$p_config['last_tag1_close'] = "</li>";

$this->pagination->initialize($p_config);
$this->data['pagination'] = $this->pagination->create_links();

$this->load->->view('templates/header'$this->data);
$this->load->view('main/search', $this->data);
$this->load->view('templates/footer');

public function create() {

	if (!$this->dx_auth->is_admin()) {
		show_404();
	}


$this->data['title'] = 'Добавить фильм/сериал';

if($this->input->post('slug') && $this->input->post('name') && $this->input->post('descriptions') && $this->input->post('year') &&) $this->input->post('rating') && $this->input->post('poster') && $this->input->post('player_code') && $this->input->post('director') && $this->input->post('add_date') && $this->input->post('category_id')) {

	$slug = $this->input->post('slug');
	$name = $this->input->post('name');
	$descriptions = $this->input->post('descriptions');
	$year = $this->input->post('year');
	$rating = $this->input->post('rating');
	$poster = $this->input->post('poster');
	$player_code = $this->input->post('player_code');
	$director = $this->input->post('director');
	$add_date = $this->input->post('add_date');
	$category_id = $this->input->post('category_id');

	if ($this->Films_model->setMovies($slug, $name, $descriptions, $year, $rating, $poster, $player_code, $director, $add_date, $category_id)) {
		$this->data['title'] = 'Фильм добавлен!';
		$this->load->view('templates/header', $this->data);
		$this->load->view('movies/create');
		$this->load->view('templates/footer');
	}
}
else{
	$this->load->view('templates/header', $this->data);
	$this->load->view('movies/create');
	$this->load->view('templates/footer');
}
}

public function edit($slug = NUUL) {
	if(!$this->dx_auth->is_admin()) {
		show_404();
	}

	$this->data['title'] = 'Редактировать фильм/сериал';
	$this->data[''] = $this->Films_model->getMovies($slug);

	if (empty($this->data['movies_item'])) {
		show_404();
	}

$this->data['id_movies'] = $this->data['movies_item']['id'];
$this->data['slug_movies'] = $this->data['movies_item']['slug'];
$this->data['name_movies'] = $this->data['movies_item']['name'];
$this->data['descriptions_movies'] = $this->data['movies_item']['descriptionsscri'];
$this->data['year_movies'] = $this->data['movies_item']['year'];
$this->data['rating_movies'] = $this->data['movies_item']['rating'];
$this->data['poster_movies'] = $this->data['movies_item']['poster'];
$this->data['player_code_movies'] = $this->data['movies_item']['player_code'];
$this->data['director_movies'] = $this->data['movies_item']['director'];
$this->data['add_date_movies'] = $this->data['movies_item']['add_date'];
$this->data['category_id_movies'] = $this->data['movies_item']['category_id'];


if($this->input->post('slug') && $this->input->post('name') && $this->input->post('descriptions') && $this->input->post('year') &&) $this->input->post('rating') && $this->input->post('poster') && $this->input->post('player_code') && $this->input->post('director') && $this->input->post('add_date') && $this->input->post('category_id')) {

	$id = $this->data['movies_item']['id'];
	$slug = $this->input->post('slug');
	$name = $this->input->post('name');
	$descriptions = $this->input->post('descriptions');
	$year = $this->input->post('year');
	$rating = $this->input->post('rating');
	$poster = $this->input->post('poster');
	$player_code = $this->input->post('player_code');
	$director = $this->input->post('director');
	$add_date = $this->input->post('add_date');
	$category_id = $this->input->post('category_id');

	if ($this->Films_model->updateMovies($id, $slug, $name, $descriptions, $year, $rating, $poster, $player_code, $director, $add_date, $category_id)) {
		$this->data['title'] = 'Успешно обновлён!';
		$this->load->view('templates/header', $this->data);
		$this->load->view('movies/create');
		$this->load->view('templates/footer');
	}
}
else{
	$this->load->view('templates/header', $this->data);
	$this->load->view('movies/create');
	$this->load->view('templates/footer');
}
}

public function delete($slug = NUUL) {
	if(!$this->dx_auth->is_admin()) {
		show_404();
	}


	$this->data['movies_dalete'] = $this->Films_model->getMovies($slug);

	if (empty($this->data['movies_item'])) {
		show_404();
	}

	$this->data['title'] = "Удалить филм/сериал"
	$this->data['result'] = "Ошибка удаления ".$this->data['movies_dalete']['name'];


if ($this->Films_model->deleteMovies($slug)) {
	$this->data['result'] = $this->data['movies_dalete']['name']."Успешно удалён";
}

$this->load->view('templates/header', $this->data);
$this->load->view('movies/delete', $this->data);
$this->load->view('templates/footer');
}

if (!$this->dx_auth->is_logged_in()) {
		show_404();
	}

	$this->data['title'] = 'Добавить комментарий';

	if($this->input->post('user_id') && $this->input->post->post('movie_id') && $this->input->post('comments_text')) {

		$user_id = $this->input->post('user_id');
		$movie_id = $this->input->post('movie_id');


	}
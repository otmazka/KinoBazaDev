<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
public function __constract(){
	parent::__constract();
}
	
	public function index()
	{
		$this->data['title'] ="Главная страница";

		$this->load->model('Films_model');
		$this->data['movie'] = $this->Films_model->getFilms(FALSE, 8, 1);
		$this->data['serials'] = $this->Films_model->getFilms(FALSE, 8, 2);

		$this->load->model('Posts_model');
		$this->data['posts'] = $this->Posts_model->getPosts(FALSE);

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/index', $this->data);
		$this->load->view('templates/footer');


	}

	public function rating() {

		$this->data['title'] ="Рейтинг фильмов";
		$this->load->library('pagination');
		$offset = (int) $this->uri->segment(2);
		$row_count = 5;
		$count = count($this->Films_model->getMoviesOnPageByRating(0, 0));
		$p_config['base_url'] = '/rating/';
		$this->data['movie'] = $this->Films_model->getMoviesOnPageByRating($row_count, $offset);

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		$p_config['full_tag_open'] = "<ul class='pagination'>";
		$p_config['full_tag_close'] =  "</ul>";
		$p_config['num_tag_open'] = "<li>";
		$p_config['num_tag_close'] = "</li>";
		$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$p_config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$p_config['next_tag_open'] = "<li>";
		$p_config['next_tagl_close'] = "</li>";
		$p_config['prev_tag_open'] = "<li>";
		$p_config['prev_tagl_close'] = "</li>";
		$p_config['first_tag_open'] = "<li>";
		$p_config['first_tagl_close'] = "</li>";
		$p_config['last_tag_open'] = "<li>";
		$p_config['last_tagl_close'] = "</li>";

		$this->pagination->initialze($p_config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/rating', $this->data);
		$this->load->view('templates/footer');

	}
	
	public function contact(){
		$this->data['title'] ="Контакт";
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('email');

		$this->form_validation->set_rules('name', 'Ваше имя', 'trim|required');
		$this->form_validation->set_rules('email', 'Ваш email', 'trim|required|valid_email');
		$this->form_validation->set_rules('subject', 'Тема', 'trim|required');
		$this->form_validation->set_rules('message', 'Ваш отзыв', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

	    $this->load->view('templates/header', $this->data);
		$this->load->view('main/contact', $this->data);
		$this->load->view('templates/footer');
		}
		else {

			$name = $this->input->post('name');
			$from_email = $this->input->post('email');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');

			$to_email = 'info@wh-db.com';

			$this->email->from($from_email, $name);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message($message);
			if ($this->email->send()) {
				$this->session->set_flashdata('msg','<div class="alert-success text-center">Ваше сообщение успешно отправлено!</div>');
				redirect('/contact');
			}
			else {
				$this->session->set_flashdata('msg','<div class="alert-danger text-center">Произошла ошибка, повторите попытку позже.</div>');
				redirect('/contact');
			}
		}

}

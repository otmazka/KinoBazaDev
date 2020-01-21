<?php
/**
 * 
 */
class My_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::_construct();
		$this->data['title'] = "Кинобаза - сайт о кино";

		$this->load->model('News_model');
		$this->data['news'] = $this->Films_model->getNews();

		$this->load->model('Fillms_model');
		$this->data['films'] = $this->Films_model->getFilmsByRating(10);
		$this->data['category'] = ""

		
	}
}


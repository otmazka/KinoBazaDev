<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Search extends MY_Controller {

	public function index() {

		$this->data['title'] = "Поиск";

		$this->load->model('Search_model');
		$this->data['search_result'] = array();

		$offset = (int) $this->uri->segment(3);															
		$row_count = 5;																					

		if ($this->input->get('q_search')) {

			$q = $this->input->get('q_search');	
			$this->data['search_result'] = $this->Search_model->search($q, $row_count, $offset);

			//pagination
			$this->load->library('pagination');
			$p_config['suffix'] = '?' . http_build_query($_GET, '', "&");              						
			$count = count($this->Search_model->search($q, 0 ,0));
			$p_config['base_url'] = '/search/index/';	
			$p_config['first_url'] = $p_config['base_url'].'?'.http_build_query($_GET);

			//pagination config
			$p_config['total_rows'] = $count;
			$p_config['per_page'] = $row_count;

			//pagination bootstrap
			$p_config['full_tag_open'] = "<ul class='pagination'>";
			$p_config['full_tag_close'] ="</ul>";
			$p_config['num_tag_open'] = '<li>';
			$p_config['num_tag_close'] = '</li>';
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

			//init pagination
			$this->pagination->initialize($p_config);
			$this->data['pagination'] = $this->pagination->create_links();
			
			$this->data['tCount'] = $count;

		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/search', $this->data);
		$this->load->view('templates/footer');

	}
}
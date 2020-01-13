<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
public function __construct(){
	parent::__construct();
	$this->load->model('News_model');
}

public function index()
	{
		$this->data['title'] ="Р’СЃРµ РЅРѕРІРѕСЃС‚Рё";
		$this->data['news'] = $this->News_model->getNews();

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/index', $this->data);
		$this->load->view('templates/footer');
	}

	public function view() {
		$this->data['news_item'] = $this->News_model->getNews($slug);

		if(empty($this->data['news_item'])) {
			show_404();
		}

		$this->data['title'] = $this->data['news_item']['title'];
		$this->data['content'] = $this->data['news_item']['text'];
		$this->data['slug'] = $this->data['news_item']['slug'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/rating', $this->data);
		$this->load->view('templates/footer');
	}

	public function create() {
		if(!$this->dx_auth->is_admin()) {
			show_404();
		}

		$this->data['title'] = 'Р”РѕР±Р°РІРёС‚СЊ РЅРѕРІРѕСЃС‚СЊ';

if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')) {
	        $slug = $this->input->post('slug');
			$title = $this->input->post('title');
			$text = $this->input->post('text');

if($this->News_model->setNews($slug, $title, $text)) {
	    $this->data['title'] = 'РќРѕРІРѕСЃС‚СЊ РґРѕР±Р°РІР»РµРЅР°!';
	    $this->load->view('templates/header', $this->data);
		$this->load->view('news/created');
		$this->load->view('templates/footer');
}
	
	}
else{
        $this->load->view('templates/header', $this->data);
		$this->load->view('news/create', $this->data);
		$this->load->view('templates/footer');
}
}

public function edit($slug = NULL) {
if(!$this->dx_auth->is_admin()) {
			show_404()
}

 $this->data['title'] = 'Р РµРґР°РєС‚РёСЂРѕРІР°С‚СЊ РЅРѕРІРѕСЃС‚СЊ';
 $this->data['news_item'] = $this->News_model->getNews($slug);

if (empty($this->data['news_item'])) {
	show_404()
}
        $this->data['id_new'] = $this->data['news_item']['id'];
		$this->data['title_news'] = $this->data['news_item']['title'];
		$this->data['content_news'] = $this->data['news_item']['text'];
		$this->data['slug_news'] = $this->data['news_item']['slug'];\

		if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')) {
			$id = $this->data['news_item']['id'];
			$slug = $this->input->post('slug');
			$title = $this->input->post('title');
			$text = $this->input->post('text');

if($this->News_model->setNews($id, $slug, $title, $text)) {
	    $this->data['title'] = 'РЈСЃРїРµС€РЅРѕ РѕР±РЅРѕРІР»РµРЅРѕ';
	    $this->load->view('templates/header', $this->data);
		$this->load->view('news/edited');
		$this->load->view('templates/footer');
		}
}
else{
	$this->load->view('templates/header', $this->data);
		$this->load->view('news/edit', $this->data);
		$this->load->view('templates/footer');
}

public function delete($slug = NULL) {
if(!$this->dx_auth->is_admin()) {
			show_404()
		}
	$this->data['title'] = "РЈРґР°Р»РёС‚СЊ РЅРѕРІРѕСЃС‚СЊ";
	$this->data['result'] = "РћС€РёР±РєР° СѓРґР°Р»РµРЅРёСЏ".$this->data['news_delete']['title'];	

	if($this->News_model->deleteNews($slug)) {
$this->data['result'] = $this->data['news_delete']['title']."СѓСЃРїРµС€РЅРѕ СѓРґР°Р»РµРЅР°";
	}

	    $this->load->view('templates/header', $this->data);
		$this->load->view('news/delete', $this->data);
		$this->load->view('templates/footer');
		}
	}
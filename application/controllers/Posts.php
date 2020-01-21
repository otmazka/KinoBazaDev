<?php
defined('BASEPATH') OR exit('No direc script access allowed');

class Posts extends MY_Controller {

    pablic function __construct() {
        parent::__construct();
        $this->load->model('Posts_model');
    }
    pablic function  index() {

        $this->data['title']='Все посты';
        $this->data['posts'] = $this->Posts_model-> getPosts();

        $this->load->view('templates/header', $this->data) ;
        $this->load->view('posts/index', $this->data);
        $this->load->view('templates/footer') ;
    }
    pablic function  view($slug = NULL) {

        $this->data['posts_item'] = $this->Posts_model->getPosts($slug);

      if(empty( $this->data['posts_item'])) {
        show_404();
       }

        $this->data['title'] = $this->data['posts_item'] ['title'];
        $this->data['content']= $this->data['posts_item'] ['text'];
        $this->data['slug'] = $this->data['posts_item'] ['slug'];

        $this->load->view('templates/header', $this->data) ;
        $this->load->view('posts/view', $this->data);
        $this->load->view('templates/footer') ;
  }
     pablic function create() ;

     if (!$this->dx_auth->is_admin()) {
        show_404();
  }
         $this->data['title'] ='Добавить пост';

     if($this->input->post('slug') && $this->input->post('title') && $this->input->post('text')) {

        $slug = $this->input->post('slug');
        $title = $this->input->post('title');
        $text = $this->input->post('text');

     if ($this->Posts_model->setPosts( $slug, $title, $text)) {

        $this->data->['title'] = 'Пост добавлен!';
        $this->load->view('templates/header', $this->data) ;
        $this->load->view('posts/created',  $this->data);
        $this->load->view('templates/footer') ;

  } 
}
    else{
        $this->load->view('templates/header', $this->data) ;
        $this->load->view('posts/create' , $this->data) ;
        $this->load->view('templates/footer');
    }   
}
    pablic function edit($slug = NULL) {


      if (!$this->dx_auth->is_admin()) {
        show_404();
      }

         $this->data['title'] = 'Редактировать пост';
         $this->data['posts_item'] = $this->Posts_model->getPosts($slug);

          if(empty( $this->data['posts_item'])) {
        show_404();
       }

       $this->data['id_posts'] =  $this->data['posts_item'] ['id'];
       $this->data['title_posts'] =  $this->data['posts_item'] ['title'];
       $this->data['content_posts'] =  $this->data['posts_item'] ['text'];
       $this->data['slug_posts'] =  $this->data['posts_item'] ['slug']; 

    if($this->input->post('slug') && $this->input->post('title') &&  $this->input->post('text')) {

        $id = $this->data['posts_item']['id'];
        $slug = $this->insput->post('slug');
        $title = $this->insput->post('title');
        $text = $this->insput->post('text');

    if( $this->Posts_model->updatePosts($id, $slug, $title, $text)) {
       $this->data->['title'] = 'Успешно обновлено';
       $this->load->view('templates/header', $this->data) ;
       $this->load->view('posts/edited');
       $this->load->view('templates/footer');  
 }
}
  else{
       $this->load->view('templates/header', $this->data) ;
       $this->load->view('posts/edit', $this->data);
       $this->load->view('templates/footer')
  }
}
   pablic function delete($slug = NULL) {

     if (!$this->dx_auth->is_admin()) {
        show_404();
  }

        $this->data['posts_delete'] = $this->Posts_model->getPosts($slug);

      if(empty( $this->data['posts_delete'])) {
        show_404();
       }

         $this->data['title'] = "Удалить пост";
         $this->data['result'] = "Ошибка удаления". $this->data['posts_delete']['title'];

      if ($this->Posts_model->deletePosts($slug)) {
         $this->data['result'] =  $this->data['posts_delete']['title']. "успешно удален";  
          }

          $this->load->view('templates/header', $this->data) ;
          $this->load->view('posts/delete', $this->data));
          $this->load->view('templates/footer') ;
        }
      }

  



<?php

class News extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }
    
    public function index() {
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        $data['header_title'] = 'News';
        if($data['level'] == 2){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('news/index',$data);
            $this->load->view('templates/footer');    
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('news/index',$data);
            $this->load->view('templates/footer');       
        }
    }
    
    public function manage() {
        $crud = new grocery_CRUD();
        $crud->set_subject('News');
        $crud->set_table('news');
        $crud->columns('id','title','content');
        $output = $crud->render();
        $this->load->view('news/manage',$output);
    }
  
}


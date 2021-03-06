<?php

class News extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->model('news_model');
    }
    
    public function index($offset = 0) {
        $limit = 10;
        $data['header_title'] = 'News';    
        
        $query = $this->news_model->get_all_news($limit,$offset);
        $data['news'] = $query['rows'];
        $data['num_news'] = $query['num_rows'];   
        
        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url("/news/index"),
            'total_rows' => $data['num_news'],
            'per_page' => $limit,
            'uri_segment' => 3,            
        );    
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();  
         $this->load->view('templates/header',$data);
        $this->load->view('templates/staff_sidebar');
        $this->load->view('news/index',$data);
        $this->load->view('templates/footer');        
    }
    
    public function view($id){
        $data['news'] = $this->news_model->view_news($id);
        $data['header_title'] = 'View News';
        $this->load->view('templates/header',$data);
        $this->load->view('templates/staff_sidebar');
        $this->load->view('news/view',$data);
        $this->load->view('templates/footer');          
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


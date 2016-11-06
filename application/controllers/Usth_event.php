<?php

class Usth_event extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->model('event_model');
    }
    
    public function index($offset = 0) {
        $limit = 10;
        $data['header_title'] = 'Events';    
        
        $query = $this->event_model->get_all_events($limit,$offset);
        $data['events'] = $query['rows'];
        $data['num_events'] = $query['num_rows'];   
        
        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url("/usth_event/index"),
            'total_rows' => $data['num_events'],
            'per_page' => $limit,
            'uri_segment' => 3,            
        );    
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();  
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/staff_sidebar');
        $this->load->view('usth_event/index',$data);
        $this->load->view('templates/footer');        
    }
    
    public function view($id){
        $data['event'] = $this->event_model->view_event($id);
        $data['header_title'] = 'View Event';
        $this->load->view('templates/header',$data);
        $this->load->view('templates/staff_sidebar');
        $this->load->view('usth_event/view',$data);
        $this->load->view('templates/footer');          
    }
    
    public function manage() {
        $crud = new grocery_CRUD();
        $crud->set_subject('Events');
        $crud->set_table('usth_events');
        $crud->columns('id','title','content');
        $output = $crud->render();
        $this->load->view('usth_event/manage',$output);
    }
  
}

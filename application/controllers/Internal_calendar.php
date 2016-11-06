<?php

class Internal_calendar extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('calendar_model');
        $email = $this->session->userdata('email');
    }
    
    public function index($year = null, $month = null) {
        $data['level'] = $this->session->userdata('level');
        
        if(!$year){
            $year = date('Y');
        }
        if(!$month){
            $month = date('m');
        }
        if($day = $this->input->post('day')){
            $this->calendar_model->add_calendar_data(
                    "$year-$month-$day",
                    $this->input->post('data')
            );
        }
        $data['calendar'] = $this->calendar_model->generate($year,$month);
        $data['header_title'] = 'Calendar';
        if($data['level'] == 2){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('internal_calendar/index',$data);
            $this->load->view('templates/footer');   
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('internal_calendar/index',$data);
            $this->load->view('templates/footer');   
        }       
    }
}


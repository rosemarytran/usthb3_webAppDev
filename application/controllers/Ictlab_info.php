<?php

class Ictlab_info extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        $data['header_title'] = 'ICTLab Infomation';
        if($data['level'] == 2){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('ictlab_info/index',$data);
            $this->load->view('templates/footer');    
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('ictlab_info/index',$data);
            $this->load->view('templates/footer');       
        }
    }
}

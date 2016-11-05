<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }

    public function index(){
        if($this->session->userdata('isLogin') == FALSE){
            redirect('form/login');
        }
        else{
            $data['email'] = $this->session->userdata('email');
            $data['level'] = $this->session->userdata('level');
            if($data['level'] == 1){
                $data['header_title'] = 'Dashboard | Admin';
                $this->load->view('templates/header',$data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('dashboard/index', $data);
                $this->load->view('templates/footer');
            }else{
                $data['header_title'] = 'Dashboard | Staff';
                $this->load->view('templates/header',$data);
                $this->load->view('templates/staff_sidebar');
                $this->load->view('dashboard/index', $data);
                $this->load->view('templates/footer');
            }
            
        }
    }
}
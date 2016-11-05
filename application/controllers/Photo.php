<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Photo extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('staff_model');
    }
    
    public function index() {
        $this->load->view('photo/upload_form', array('error' => ' ' ));
    }
    
    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload',$config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('photo/upload_form', $error);
        }
        else
        {            
            $name = $this->upload->data('file_name');
            $type = $this->upload->data('file_type');
            $size = $this->upload->data('file_size');
            $tmpName  = $_FILES['userfile']['tmp_name'];
            $fp      = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $i_content = addslashes($content);
            fclose($fp);      
            //insert
            $this->staff_model->insert_photo($name, $type, $size, $i_content);
 
            $data['photo'] = $this->staff_model->get_photo($name);
            if ($data['photo'] <> 0){
                $this->load->view('photo/upload_success',$data);
            }else{
                $this->load->view('photo/upload_form');
            }
        }
    }
    
    public function show_photo() {
        $id = 11;
        $data['photo'] = $this->staff_model->get_photo_by_id($id);
        $this->load->view('photo/show_photo',$data);
    }
}

<?php
class Form extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model('users_model');
        }
// Sign up        
        function random_password( $length = 6 ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr(str_shuffle(str_repeat($chars,$length)),0,$length);
            return $password;
        }
              
        public function signup() {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('form/signup');
            }else{
                $email = $this->input->post('email');
                $password = $this->input->post('password');
//                $password = $this->random_password(6);
                $level = 2;   
                
                $this->users_model->insertUser($email,$password,$level);     
                
//		$this->load->library('email');
//		$this->email->set_newline("\r\n");                
//                $this->email->from('ththao111@gmail.com','Thao Tran');
//                $this->email->to($email);
//                $this->email->subject('Password for USTH Website.');
//                $this->email->message('Your password is: '.$password.'.');
//                if($this->email->send()){               
//                    echo 'Your email was sent, fool!';
//                }else{
//                    show_error($this->email->print_debugger());
//                }
                $this->load->view('form/login');
            }
        }
// Login
        public function checkAdmin($email,$password,$level) {
            $admin = $this->users_model->getAdmin($email,$password);
            if($admin <> 0){
                $this->session->set_userdata('isLogin', TRUE);
                $this->session->set_userdata('email',$email);
                $this->session->set_userdata('level',$level);
                redirect('dashboard');
            }
            else{
                $this->load->view('form/login');
            }
        }
        
        public function checkStaff($email,$password,$level) {
            $staff = $this->users_model->getUser($email);           
            if($staff <> 0){
                if (password_verify($password, $staff['password'])) {
                    $this->session->set_userdata('isLogin', TRUE);
                    $this->session->set_userdata('email',$email);
                    $this->session->set_userdata('level',$level);
                    redirect('dashboard');
                } else {
                    $this->load->view('form/login');
                }
            }
            else{
                $this->load->view('form/login');
            }            
        }
        public function checkUser($email,$password,$level){
            if($level == 1){
                $this->checkAdmin($email,$password,$level);
            }else{
                $this->checkStaff($email,$password,$level);
            }
        }
        public function login() {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');           
            if($this->form_validation->run()==FALSE){
                $this->load->view('form/login');
            }
            else{
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $level = $this->input->post('level');
                $this->checkUser($email,$password,$level);
            }
        }
        
        public function logout(){
            $this->session->sess_destroy();
            redirect('form/login');
        }
        
}


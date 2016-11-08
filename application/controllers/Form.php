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
        
        function send_mail($email,$password,$subject,$body){
            require 'PHPMailerAutoload.php';
            $mail = new PHPMailer;           
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ththao111@gmail.com';                 // SMTP username
            $mail->Password = '0984417418';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->setFrom('ththao111@gmail.com', 'Thao Tran');
            $mail->addAddress($email);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body    = $body.$password;
            if(!$mail->send()) {
                echo 'Error sending mail! '.$mail->ErrorInfo;;
            } else {
                $this->users_model->addUser($email,$password);  
                $this->session->set_flashdata('mail_msg','<div class="alert alert-success text-center">An email with password has been sent to your account! Please check your inbox!</div>');
                $this->load->view('form/login');
                $this->session->sess_destroy();
            }
        }


        public function signup() {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique[users.email]' => 'This email already existed'));
            $this->form_validation->set_message('is_unique[users.email]', 'This email already existed');
//            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
//            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('form/signup');
            }else{
                $email = $this->input->post('email');  
//                $password = $this->input->post('password');
                $password = $this->random_password(6);   
                $this->send_mail($email, $password,'Welcome to USTH Dashboard as a staff.','Your password is: ');                                   
            }
        }
        
// Resend Password
    public function resend_password() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if($this->form_validation->run()==FALSE){
            $this->load->view('form/resend_password');
        }
        else{
            $email = $this->input->post('email');
            $staff = $this->users_model->getUser($email); 
            if($staff <> 0){
                $password = $this->random_password(6);   
                $this->send_mail($email, $password, 'Resend Password','Your new password is: ');    
            }else{
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">This email is not signed up yet!</div>');
                $this->load->view('form/resend_password');
            }
        }
        
    }
// Reset Password
    public function reset_password() {
        $data['email'] = $this->session->userdata('email');
        $this->form_validation->set_rules('password', 'Current Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('passnew', 'New Password', 'trim|required|min_length[5]');
         if ($this->form_validation->run() == FALSE){
                $this->load->view('form/reset_password',$data);
        }else{
            $password = $this->input->post('password');
            $staff = $this->users_model->getUser($data['email']);
            if (password_verify($password, $staff['password'])) {
                $passnew = $this->input->post('passnew');
                $this->send_mail($data['email'], $passnew,'Reset Password.','Your reset password is: ');  
            } else {
                $this->session->set_flashdata('error_msg','<div class="alert alert-danger text-center">Invalid Current Password</div>');
                $this->load->view('form/reset_password',$data);
            }                                 
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
                $this->session->set_flashdata('admin_msg','<div class="alert alert-danger text-center">Invalid Email or Password</div>');
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
                    $this->session->set_flashdata('staff_msg','<div class="alert alert-danger text-center">Invalid Password</div>');
                    $this->load->view('form/login');
                }
            }
            else{
                $this->session->set_flashdata('staff_msg','<div class="alert alert-danger text-center">Invalid Email or Password</div>');
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
            }else{
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


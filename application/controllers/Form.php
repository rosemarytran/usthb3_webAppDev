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
        
        function send_mail($email,$password){
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

            $mail->Subject = 'Welcome to USTH Dashboard as a staff.';
            $mail->Body    = 'Your password is: '.$password;
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $this->load->view('form/login');
            }
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
                $this->send_mail($email, $password);
                $this->users_model->insertUser($email,$password,$level);                                   
            }
        }
        
//        public function mailToMe() {
//            require 'PHPMailerAutoload.php';
//            $mail = new PHPMailer;
//            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
//            $mail->isSMTP();                                      // Set mailer to use SMTP
//            $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'ththao111@gmail.com';                 // SMTP username
//            $mail->Password = '0984417418';                           // SMTP password
//            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//            $mail->Port = 587;                                    // TCP port to connect to
//            $mail->SMTPOptions = array(
//                'ssl' => array(
//                    'verify_peer' => false,
//                    'verify_peer_name' => false,
//                    'allow_self_signed' => true
//            )
//);
//            $mail->setFrom('ththao111@gmail.com', 'Mailer');
//            $mail->addAddress('ththao111@gmail.com', 'Joe User');     // Add a recipient
//            //$mail->addAddress('ellen@example.com');               // Name is optional
//            //$mail->addReplyTo('info@example.com', 'Information');
//            //$mail->addCC('cc@example.com');
//            //$mail->addBCC('bcc@example.com');
//
//            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//            $mail->isHTML(true);                                  // Set email format to HTML
//
//            $mail->Subject = 'newer one';
//            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//            if(!$mail->send()) {
//                echo 'Message could not be sent.';
//                echo 'Mailer Error: ' . $mail->ErrorInfo;
//            } else {
//                echo 'Message has been sent';
//            }
//        }
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


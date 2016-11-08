<?php
class Profile extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('staff_model');
    }
    
    public function index($sort_by = 'title', $sort_order = 'asc', $offset = 0) {
        $limit = 5;
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        $data['header_title'] = 'All Staffs Profile';
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        
        $query = $this->staff_model->get_all_staffs($limit,$offset,$sort_by,$sort_order);
        $data['staffs'] = $query['rows'];
        $data['num_staffs'] = $query['num_rows'];
        
        $this->load->library('pagination');
        $config = array(
            'base_url' => site_url("/profile/index/$sort_by/$sort_order"),
            'total_rows' => $data['num_staffs'],
            'per_page' => $limit,
            'uri_segment' => 5,            
        );
      
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        if($data['level'] == 2){
            $data['me'] = $this->staff_model->get_staff_by_email($data['email']);
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('profile/index',$data);
            $this->load->view('templates/footer');    
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('profile/index',$data);
            $this->load->view('templates/footer');       
        }
    }
    
    public function view($id){
        $data['staff'] = $this->staff_model->view_staff($id);
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        $data['header_title'] = 'View Profile';
        if($data['level'] == 2){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('profile/view',$data);
            $this->load->view('templates/footer');          
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('profile/view',$data);
            $this->load->view('templates/footer');          
        }      
    }
    
    public function create() {
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        if($data['level'] == 2){
            $data['header_title'] = 'My Profile | Create';          
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('profile/create', $data);
            $this->load->view('templates/footer');          
        }else{
            $data['header_title'] = 'Staff\'s Profile | Create';           
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('profile/create', $data);
            $this->load->view('templates/footer');          
        }      
    }
    
    public function __upload_profile($level) {
        if($level == 2){
            $this->staff_model->add_staff($this->session->userdata('email'));
        }else{
            $this->staff_model->add_staff($this->input->post('email'));
        }
    }
    
    public function upload() {
        $data['email'] = $this->session->userdata('email');
        $data['level'] = $this->session->userdata('level');
        
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload',$config);
        
        if($data['level'] == 1){
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[staffs.email]');
        }       
        if (!$this->upload->do_upload('photo')){
            $this->create();
        }else{  
            $this->__upload_profile($data['level']);
            $this->index();
        }
            
    }
    
    public function update($id) {
        $data['staff'] = $this->staff_model->view_staff($id);
        $data['level'] = $this->session->userdata('level');
        $data['header_title'] = 'Update Profile';         
        if($data['level'] == 2){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/staff_sidebar');
            $this->load->view('profile/update',$data);
            $this->load->view('templates/footer');          
        }else{
            $this->load->view('templates/header',$data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('profile/update',$data);
            $this->load->view('templates/footer');          
        }      
    }
       
    public function do_update() {
        $id = $this->input->post('id');
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload',$config);
        $this->upload->do_upload('photo');
        $this->staff_model->update_staff($id);
        $this->view($id);      
    }

    public function delete(){
        $this->staff_model->delete_staff();
        redirect('profile/index');
    }
}

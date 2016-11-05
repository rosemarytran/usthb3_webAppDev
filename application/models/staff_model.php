<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff_model extends CI_Model{
    public function get_staff_by_email($email) {
        $this->db->select('id');
        $this->db->from('staffs');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_staff_by_postion($postion) {
        $this->db->select('*');
        $this->db->from('staffs');
        $this->db->where('postion',$postion);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_staff_by_title($title) {
        $this->db->select('*');
        $this->db->from('staffs');
        $this->db->where('title',$title);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_all_staffs($limit,$offset,$sort_by,$sort_order) {
        $sort_order = ($sort_order == 'desc')? 'desc':'asc';
        $sort_columns = array('title','position');
        $sort_by = (in_array($sort_by, $sort_columns))? $sort_by : 'title';
        
        $this->db->select('*');
        $this->db->from('staffs');
        $this->db->limit($limit,$offset);
        $this->db->order_by($sort_by,$sort_order); 
        $query = $this->db->get();  
        $ret['rows'] = $query->result();
        
        $this->db->select('COUNT(*) as count', FALSE);
        $this->db->from('staffs');
        $q = $this->db->get();  
        $tmp = $q->result();
        $ret['num_rows'] = $tmp[0]->count;
        
        return $ret;
    }
    
    public function add_staff($email) {
        $data = array(
            'email' => $email,
            'name' => $this->input->post('name'),
            'photo' => $this->upload->data('file_name'),
            'title' => $this->input->post('title'),
            'position' => $this->input->post('position'),
            'affiliation' => $this->input->post('affiliation'),
            'publication' => $this->input->post('publication'),
            'supervised_student' => $this->input->post('supervised_student'),
            'r_project' => $this->input->post('supervised_student')
        );
        $this->db->insert('staffs',$data);
    }
    
    public function view_staff($id) {
        $this->db->select('*');
        $this->db->from('staffs');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function update_staff($id) {
        $data = array(
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'photo' => $this->upload->data('file_name'),
            'title' => $this->input->post('title'),
            'position' => $this->input->post('position'),
            'affiliation' => $this->input->post('affiliation'),
            'publication' => $this->input->post('publication'),
            'supervised_student' => $this->input->post('supervised_student'),
            'r_project' => $this->input->post('supervised_student')
        );
        $this->db->where('id',$id);
        $this->db->update('staffs',$data);
        
    }
    
    public function delete_staff(){
        $this->db->where('id',  $this->uri->segment(3));
        $this->db->delete('staffs');
    }
    
}
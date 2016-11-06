<?php

class News_model extends CI_Model{
    public function get_all_news($limit,$offset) {      
        $this->db->select('*');
        $this->db->from('news');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();  
        $ret['rows'] = $query->result();
        
        $this->db->select('COUNT(*) as count', FALSE);
        $this->db->from('news');
        $q = $this->db->get();  
        $tmp = $q->result();
        $ret['num_rows'] = $tmp[0]->count;
        
        return $ret;
    }
    
    public function view_news($id) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
}

<?php

class Event_model extends CI_Model{
    public function get_all_events($limit,$offset) {      
        $this->db->select('*');
        $this->db->from('usth_events');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();  
        $ret['rows'] = $query->result();
        
        $this->db->select('COUNT(*) as count', FALSE);
        $this->db->from('usth_events');
        $q = $this->db->get();  
        $tmp = $q->result();
        $ret['num_rows'] = $tmp[0]->count;
        
        return $ret;
    }
    
    public function view_event($id) {
        $this->db->select('*');
        $this->db->from('usth_events');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
}

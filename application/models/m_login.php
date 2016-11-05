<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!defined('BASEPATH')) exit('Hacking Attemp: Get Out of the system ..!');

class M_login extends CI_model{
    public function __construct() {
        parent::__construct();
    }
    
    public function takeUser($username,$password,$status,$level){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('status',$status);
        $this->db->where('level', $level);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function userData($username){
        $this->db->select('username');
	$this->db->select('name');
        $this->db->where('username', $username);
	$query = $this->db->get('user');
	return $query->row();
    }
}

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!defined('BASEPATH')) exit('Hacking Attemp: Get Out of the system ..!');

class Users_model extends CI_model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getAdmin($email,$password){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getUser($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('level',2);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function addUser($email,$password) {
        $query = $this->db->get_where('users', array('email' => $email));
        if($query->num_rows() <> 0){
            $this->db->where('email',$email);
            $this->db->update('users',array(
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => 2
            ));
        }else{
            $this->db->insert('users',array(
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => 2
            ));
        }
    }
   
}
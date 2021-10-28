<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getData(){
        $this->db->select();
        return $this->db->get('auth')->result_array();
    }
}
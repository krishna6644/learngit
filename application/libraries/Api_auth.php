<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_auth
{
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
       $this->CI->load->model('AuthModel');
    }
    public function login($username, $password) {
        $data = $this->CI->AuthModel->getData();
        if($username == $data[0]['username'] && $password == $data[0]['password'])
        {
            return true;            
        }
        else
        {
            return false;           
        }           
    }
}
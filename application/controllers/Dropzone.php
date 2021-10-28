<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Dropzone extends CI_Controller { 
    function  __construct() { 
        parent::__construct(); 
         
        // Load file model 
        $this->load->model('file'); 
    } 
     
    function index(){ 
        $header = array(
			'title' => 'Role group',
			'description' => '',
			'page' => 'dropzone',
		);
        $data = array(); 
         
        // Get files data from the database 
        $data['files'] = $this->file->getRows(); 
        $data['products'] = $this->file->getproduct();
        // Pass the files data to view 
        $this->load->view('includes/header' ,$header); 
        $this->load->view('upload_files/view', $data); 
        $this->load->view('includes/footer',$header); 

    } 
     
    function dragDropUpload(){ 
        if(!empty($_FILES)){ 
            // File upload configuration 
            $uploadPath = 'uploads/admin/'; 
            $config['upload_path'] = $uploadPath; 
            $config['allowed_types'] = '*'; 
             
            // Load and initialize upload library 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
             
            // Upload file to the server 
            if($this->upload->do_upload('file')){ 
                $fileData = $this->upload->data(); 
                $uploadData['product_id']=$this->input->post('product_id');
                $uploadData['file_name'] = $fileData['file_name']; 
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s"); 
                 
                // Insert files info into the database 
                $insert = $this->file->insert($uploadData); 
                
            }
          
        } 
    } 
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_Files extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();

        // Load file model 
        $this->load->model('file');
        $this->load->model('product_model');
    }

    public function index()
    {
        $data = array();
        $errorUploadType = $statusMsg = '';

        // If file upload form submitted 
        if ($this->input->post('fileSubmit')) {

            // If files are selected to upload 
            if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                $filesCount = count($_FILES['files']['name']);


                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                    $uploadPath = 'uploads/admin/';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    
                    if ($this->upload->do_upload('file')) {
                      
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['product_id'] = $this->input->post('product_id');
                    } else {
                        $errorUploadType .= $_FILES['file']['name'] . ' | ';
                    }
                }

                $errorUploadType = !empty($errorUploadType) ? '<br/>File Type Error: ' . trim($errorUploadType, ' | ') : '';
                if (!empty($uploadData)) {
                    // Insert files data into the database 



                    $insert = $this->file->insertmultifile($uploadData);

                    // Upload status message 
                    $statusMsg = $insert ? 'Files uploaded successfully!' . $errorUploadType : 'Some problem occurred, please try again.';
                    return redirect(base_url('upload_files/list'));
                } else {

                    $statusMsg = "Sorry, there was an error uploading your file." . $errorUploadType;
                    return redirect(base_url('upload_files'));
                }
            } else {

                $statusMsg = 'Please select image files to upload.';
            }
        }

        // Get files data from the database 
        $data['files'] = $this->file->getRows();
        $data['products'] = $this->file->getproduct();


        // Pass the files data to view 
        $data['statusMsg'] = $statusMsg;
        $this->load->view('includes/header');
        $this->load->view('upload_files/index', $data);
        $this->load->view('includes/footer');
    }
    public function list()
    {
        $data['data'] = $this->file->getRows();

        $this->load->view('includes/header');
        $this->load->view('upload_files/create', $data);
        $this->load->view('includes/footer');
    }
   
    
}

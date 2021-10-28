<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class HTMLPurifierController  extends CI_Controller { 
    public function __construct() {
		parent::__construct();		
		include APPPATH . 'third_party/HTMLPurifier/HTMLPurifier.auto.php';
       $this->load->model('Category_model','category_model');
	}
	
	
    public function index()	{		
		$config = \HTMLPurifier_Config::createDefault();
		$purifier = new \HTMLPurifier($config);
		
		$dirty_html = "<!doctype html>
			 <html lang=en>
			 <head>
			 <meta charset=utf-8>
			 <title>HTML Template</title>
			 <style type=text/css>
			 @import url(0.css);
			 </style>
			 </head>
			 <body>
			 <center><h1>
			 A simple HTML template
			 </h1></center>
			 <!-- START YOUR TEXT -->
			 ...your text goes here... <p>
			 See <a href=quick-html.html>this</a>.
			 <!-- END YOUR TEXT -->
			 <p> 2020/02/05
			 </body></html>";
		
		$data['clean_html'] = $purifier->purify($dirty_html);
		
		$this->load->view('html_purifier',$data);
	}
	
}
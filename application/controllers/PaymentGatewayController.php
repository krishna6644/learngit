<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class PaymentGatewayController extends CI_Controller {
    
    public function __construct() {
       parent::__construct();

       $this->load->library("session");

       $this->load->helper('url');
    }
    

    public function index()
    {
        $this->load->view('includes/header');
        $this->load->view('payment');
        $this->load->view('includes/footer');

    }
    
    public function makeStripePayment()
    {
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        \Stripe\Charge::create ([   
                "amount" => 100 * 100,
                "currency" => "inr",    
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment." 
        ]);
            
        $this->session->set_flashdata('success', 'Payment is successful.');
        redirect('/payment-gateway', 'refresh');
    }
}
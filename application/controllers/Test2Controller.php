<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Test2Controller extends CI_Controller{
    public function index($year = null, $month = null){
        $this->load->model('TestModel');
        
        $data['calendar'] = $this->TestModel->generate_calendar($year,$month);
       

		$this->load->view('test/test',$data);
    }
    
    public function test(){
        $this->load->helper('date');
        echo now();
        echo unix_to_human(now());
        echo date("Y-m-d H:i:s",strtotime(unix_to_human(now())));
        echo '<br><br><br>';
        echo '<pre>';
        print_r(hash_algos());
        echo '</pre>';
        echo hash('gost-crypto','supot mo tol');
    }
    
    public function send_mail(){
        $config = array(
            'protocol'=>'smtp',
            'smtp_host'=>'ssl://smtp.googlemail.com',
            'smtp_port'=>'465',
            'smtp_user'=>'bloodgrant.ph@gmail.com',
            'smtp_pass'=>'dugongbayani123',
            'charset'=>'utf-8',
            'newline'=>"\r\n",
            'wordwrap'=>true
        );/*09263200112*/
        $this->load->library('email',$config);
        $this->email->from('bloodgrant.ph@gmail.com', 'bloodgrant.ph@gmail.com');
        $this->email->to('acuestajohnmark@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if($this->email->send()){
            echo 'what';
            echo $this->email->print_debugger();
        }else{
            echo print_debugger();
        }
    }
    public function sendemail(){
        $config = array(
            'protocol'=>'smtp',
            'smtp_host'=>'ssl://smtp.googlemail.com',
            'smtp_port'=>'465',
            'smtp_user'=>'bloodgrant.ph@gmail.com',
            'smtp_pass'=>'dugongbayani123',
            'charset'=>'utf-8',
            'newline'=>"\r\n"
        );/*09155429764*/
        $this->load->library('email',$config);
        $this->email->from('acuestajohnmark@gmail.com','John Mark');
        $this->email->to('rachel.laurete@gmail.com');
        $this->email->subject('zzz');
        $this->email->message('Welcome to zdadqw');
        if($this->email->send()){
            
        }
        
    }
}
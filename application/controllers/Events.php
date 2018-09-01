<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Events extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('EventsModel');
        $this->load->helper('date');
    }
    
    public function index(){
        redirect('Events/event_details','location');
    }
    
    public function event_details(){
        $id = $this->uri->segment(3);
        $event = $this->EventsModel->get_event($id);
        $data['event']=$event[0];
        $this->load->view('event/event_details',$data);
    }
    
    public function add_event_page(){
        $this->load->view('event/add_event_view');
    }
}
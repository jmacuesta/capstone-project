<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Requests extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('RequestsModel');
        $this->load->model('BloodModel');
        $this->load->model('NotificationModel');
        $this->load->model('EventsModel');
        $this->load->helper('date');
    }
    public function index(){
        redirect('UsersProfileController/index','location');
    }
    public function interested(){
        $requestID = $this->uri->segment(3);
        $userID = $this->uri->segment(4);
        $this->RequestsModel->interestedDonor($requestID,$userID);
        $data = $this->BloodModel->get_specificRequest($requestID);
        $name = $data[0]->request_patientFName.' '.$data[0]->request_patientLName;
        $status = array(
            'informed'=>true,
            'limiter'=>'<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span></button>',
            'message'=>'You are interested in donating blood to '.$name.'. The volunteeer who made the request will also be notified that you are interested in donating your blood for the recipient.',
            'delimiter'=>'</div>'
        );
        $this->session->set_flashdata($status);
        redirect('UsersProfileController/user_home_view','location');
    }
    public function request_details(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator');
            }elseif($_SESSION['user_type']==3){
                $requestid=$this->uri->segment(3);
                $notificationid=$this->uri->segment(4);
                $this->NotificationModel->notification_is_read($notificationid);
                $_SESSION['request_id']=$requestid;
                redirect('Requests/view_request_details','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function view_request_details(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator');
            }elseif($_SESSION['user_type']==3){
                $requestid = $_SESSION['request_id'];
                $request = $this->RequestsModel->view_request($requestid);
                $data['request']=$request[0];
                $data['events']=$this->EventsModel->get_events();
                $this->load->view('users_profile/notification_details',$data);
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function request_approvedImmediateRelease(){
        $requestID = $this->uri->segment(3);
        $userid = $this->uri->segment(4);
        $request = $this->BloodModel->get_specificRequest($requestID);
        $user = $this->UsersModel->getUserDetail($userid);
        $data['request']=$request[0];
        $data['events']=$this->EventsModel->get_events();
        $this->load->view('users_profile/approved_immediate_request',$data);
    }
}
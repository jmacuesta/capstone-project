<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

class BloodController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('BloodTypeModel');
        $this->load->model('AreaModel');
        $this->load->model('NotificationModel');
        $this->load->model('UsersModel');
        $this->load->model('RequestsModel');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->model('AdminModel');
        $dob = new DateTime($_SESSION['user_dateofbirth']);
        $now = new DateTime();
        $_SESSION['user_age']=$now->diff($dob)->y;
        $this->load->model('BloodModel');
    }
    public function index(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('Moderator');
            }elseif($_SESSION['user_type']==3){
                $data['list']=$this->BloodModel->get_bloodRequests();
                $this->load->view('users_profile/user_home_view',$data);
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function request_blood_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator');
            }elseif($_SESSION['user_type']==3){
                $Lists['bloodtypeslist']=$this->BloodTypeModel->getbloodtypelist();
                //loads the getarealist method of AreaModel and stores it in $Lists['arealist'];
                $Lists['arealist']=$this->AreaModel->getarealist();
                //Loads the getregionlist method of Areamodel and stores it in $Lists['regionlist'];
                $Lists['regionlist']=$this->AreaModel->getregionlist();
                $this->load->view('users_profile/request_blood_view');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function request_blood(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator')
            }elseif($_SESSION['user_type']==3){
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
                $this->form_validation->set_rules('neededBloodType','Blood Type','required');
                $this->form_validation->set_rules('neededBloodComponent','Blood Component','required');
                $this->form_validation->set_rules('patientFName', 'Patient\'s First Name', 'trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules('patientLName', 'Patient\'s Last Name', 'trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules('patientAge', 'Patient\'s Age', 'trim|numeric|callback_age_positive_number' );
                //$this->form_validation->set_rules('patientCondition','Patient\'s Medical Condition', 'required');
                $this->form_validation->set_rules('patientRoomNumber','Room Number','trim|required|numeric');
                $this->form_validation->set_rules('patientHospital','Hospital','trim|required|regex_match[/^[a-zA-Z ]*$/]');
                $this->form_validation->set_rules('patientHospitalAddress','Hospital Street Address','trim|required|regex_match[/^[a-zA-Z0-9 ]*$/]');
                //$this->form_validation->set_rules('patientExactLocation','Patient\'s Exact Location', 'trim|required|regex_match[/^[,0-9a-zA-Z ]*$/]');
                $this->form_validation->set_rules('hospitalArea','Hospital Area','trim|required');
                $this->form_validation->set_rules('bloodUnits','Units of Blood','required|numeric|callback_positive_number');
                $this->form_validation->set_rules('dateNeeded', 'Date Needed', 'required');
                $this->form_validation->set_rules('otherInfo', 'Other information', 'trim|alpha_numeric_spaces');
                $this->form_validation->set_rules('relativeFName','Relative\'s First Name', 'trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules('relativeLName','Relative\'s Last Name', 'trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules('relativeContactNumber','Relative\'s Contact Number', 'trim|required|numeric|exact_length[10]');
                $this->form_validation->set_rules('relativeEmail','Relative\'s Email','trim|valid_email');
                if($this->form_validation->run()){
                    $RoomNo=$this->input->post('patientRoomNumber');
                    $Hospital=$this->input->post('patientHospital');
                    $HospitalAddress=$this->input->post('patientHospitalAddress');
                    $inputBloodComponent=$this->input->post('neededBloodComponent');
                    if($inputBloodComponent=='Whole Blood'){
                        $neededBloodComponent='Whole Blood';
                    }elseif($inputBloodComponent=='Blood Platelets'){
                        $neededBloodComponent='Blood Platelets';
                    }elseif($inputBloodComponent=='Blood Plasma'){
                        $neededBloodComponent='Blood Plasma';
                    }else{
                        $neededBloodComponent='Other: '.$this->input->post('otherBloodComponent');
                    }
                    $data = array(
                        'request_by_id'=>$_SESSION['user_id'],
                        'request_neededBloodType'=>$this->input->post('neededBloodType'),
                        'request_neededBloodComponent'=>$neededBloodComponent,
                        'request_patientFName'=>ucwords(strtolower($this->input->post('patientFName'))),
                        'request_patientLName'=>ucwords(strtolower($this->input->post('patientLName'))),
                        'request_patientAge'=>$this->input->post('patientAge'),
                        'request_patientCondition'=>$this->input->post('patientCondition'),
                        'request_patientExactLocation'=>$RoomNo.', '.$Hospital.', '.$HospitalAddress,
                        'request_patientExactLocationArea'=>$this->input->post('hospitalArea'),
                        'request_numberUnits'=>$this->input->post('bloodUnits'),
                        'request_dateNeeded'=>$this->input->post('dateNeeded'),
                        'request_otherInfo'=>$this->input->post('otherInfo'),
                        'request_relativeFName'=>ucwords(strtolower($this->input->post('relativeFName'))),
                        'request_relativeLName'=>ucwords(strtolower($this->input->post('relativeLName'))),
                        'request_relativeContact'=>$this->input->post('relativeContactNumber'),
                        'request_relativeEmail'=>$this->input->post('relativeEmail')
                    );
                    $this->BloodModel->insert_bloodRequest($data);
                    $success = array(
                        'inserted'=>true,
                        'limiter'=>'<div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>',
                        'message'=>'<strong>request successful, wait for confirmation from the staffs</strong>',
                        'delimiter'=>'</div>'
                    );
                    $this->session->set_flashdata($success);
                    //$request_id = $this->session->flashdata('last_id');
                    //$neededBloodType = $this->input->post('neededBloodType');
                    //$request_by_id = $_SESSION['user_id'];
                    //$recipientName = ucwords(strtolower($this->input->post('patientFName'))).' '.ucwords(strtolower($this->input->post('patientLName')));
                    //$notificationMessage = $recipientName.' needs your help!';
                    $request_id = $this->session->flashdata('last_id');
                    $request_by_id = $_SESSION['user_id'];
                    $this->notify_adminRequest($request_id,$request_by_id);
                    redirect('UsersProfileController/user_home_view','location');
                }else{
                    $this->load->view('users_profile/request_blood_view');
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function positive_number($data){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderatior');
            }elseif($_SESSION['user_type']==3){
                if($data < 1){
                    $this->form_validation->set_message('positive_number', 'The %s cannot be zero or below');
                    return false;
                }else{
                    return true;
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function age_positive_number($data){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('mods')
            }elseif($_SESSION['user_type']==3){
                if($data < 0){
                    $this->form_validation->set_message('positive_number', 'The %s cannot be zero or below');
                    return false;
                }else{
                    return true;
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function notify_adminRequest($request_id,$request_by_id){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                //redirect('moderator');
            }elseif($_SESSION['user_type']==3){
                //get admin list to notify
                $request_by = $this->UsersModel->getUserDetail($request_by_id);
                //$data['request_by']=$request_by[0];
                $requestor = $request_by[0]->users_firstname.' '.$request_by[0]->users_lastname;
                $message = $requestor.' has made a blood request';
                $data['admins']=$this->AdminModel->adminlist();
                foreach($data['admins'] as $row){
                    $notification = array(
                        'notification_details'=>$message,
                        'notification_time'=>date("Y-m-d H:i:s",strtotime(unix_to_human(now()))),
                        'notification_url'=>base_url().'AdminController/request_details_view/'.$request_id,
                        'request_id'=>$request_id,
                        'user_type'=>1,
                        'user_id'=>$row->users_id
                    );
                    $this->NotificationModel->addNotification($notification);
                    $notifid =  $this->session->flashdata('insertedId');
                    $notifURL = base_url().'AdminController/request_details_view/'.$request_id.'/'.$notifid;
                    $this->NotificationModel->addURLtoNotification($notifid,$notifURL);
                    
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersProfileController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('UsersModel');
        $this->load->model('BloodModel');
        $this->load->model('RequestsModel');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('BloodTypeModel');
        $this->load->model('AreaModel');
        $this->load->model('EventsModel');
        $this->load->model('NotificationModel');
        $this->load->helper('date');
        $this->check_notifications();
    }
    public function index(){
            if(isset($_SESSION['user_loggedin'])){
                if($_SESSION['user_type']==1){
                    redirect('AdminController/index','location');
                }elseif($_SESSION['user_type']==2){
                    redirect('Moderator/index','location');
                }elseif($_SESSION['user_type']==3){
                    redirect('UsersProfileController/user_home_view','location');
                }else{
                    redirect('UsersController/login','location');
                }
            }else{
                redirect('UsersController/login','location');
            }
    }
    public function user_home_view(){  
        if(isset($_SESSION['user_loggedin'])){            
            if($_SESSION['user_type']==3){
                $config['base_url'] = base_url().'UsersProfileController/user_home_view';
                $config['total_rows']=$this->RequestsModel->count_postedRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['events']=$this->EventsModel->get_events();
                $data['requests']=$this->RequestsModel->get_postedRequests($config['per_page'],$this->uri->segment(3),$_SESSION['user_bloodtype']);
                $this->load->view('users_profile/user_home_view',$data);
            }elseif($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function user_profile_view(){
       if(isset($_SESSION['user_loggedin'])){
           if($_SESSION['user_type']==1){
               redirect('AdminController/index','location');
           }elseif($_SESSION['user_type']==2){
               redirect('Moderator/index','location');
           }elseif($_SESSION['user_type']==3){
               $id = $this->uri->segment(3);
               $userDetail = $this->UsersModel->getUserDetail($id);
               $data['userDetail']=$userDetail[0];
               $data['events']=$this->EventsModel->get_events();
               $this->load->view('users_profile/user_profile_view',$data);
           }else{
               redirect('UsersController/login','location');
           }
       }else{
           redirect('UsersController/login','location');
       }
    }
    public function update_profile_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $id = $this->uri->segment(3);
                $userDetail = $this->UsersModel->getUserDetail($id);
                $data['arealist']=$this->AreaModel->getarealist();
                $data['regionlist']=$this->AreaModel->getregionlist();
                $data['bloodtypelist'] = $this->BloodTypeModel->getbloodtypelist();
                $data['userDetail']=$userDetail[0];
                $this->load->view('users_profile/update_profile_view',$data);
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function update_user(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $id = $this->input->post('UserId');
                $userDetail = $this->UsersModel->getUserDetail($id);
                $data['userDetail']=$userDetail[0];
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
                $this->form_validation->set_rules('UsersBloodType','Blood Type', 'required');
                $this->form_validation->set_rules('UsersEmail','Email Address', 'trim|required|valid_email');
                $this->form_validation->set_rules('UsersContact','Contact Number','trim|required|exact_length[10]');
                $this->form_validation->set_rules('UsersArea', 'Area', 'trim|required');
                $this->form_validation->set_rules('UsersDOB','Date of Birth','trim|required|callback_age_check');
                $this->form_validation->set_rules('UsersGender','Gender','required');
                if($this->form_validation->run()){
                    $DBemail=$userDetail[0]->users_email;
                    $DBcontact=$userDetail[0]->users_contact;
                    unset($_SESSION['user_bloodtype']);
                    $_SESSION['user_bloodtype']=$this->input->post('UsersBloodType');
                    /*if($userDetail[0]->users_emailactivated==1){
                        $EMstatus=1;
                    }else{
                        $EMstatus=0;
                    }
                    if($userDetail[0]->users_mobileactivated==1){
                        $Mstatus=1;
                    }else{
                        $Mstatus=0;
                    }*/
                    if($DBemail==$this->input->post('UsersEmail')&&$DBcontact==$this->input->post('UsersContact')){
                        $data = array(
                            'users_bloodtype'=>$this->input->post('UsersBloodType'),
                            'users_area'=>$this->input->post('UsersArea'),
                            'users_dateofbirth'=>$this->input->post('UsersDOB'),
                            'users_gender'=>$this->input->post('UsersGender')
                        );
                    }
                    elseif($DBemail==$this->input->post('UsersEmail')&&$DBcontact!=$this->input->post('UsersContact')){
                        if($userDetail[0]->users_mobileactivated==1){
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_contact'=>$this->input->post('UsersContact'),
                                'users_mobileactivated'=>0
                            );
                        }else{
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_contact'=>$this->input->post('UsersContact')
                            );
                        }
                    }
                    elseif($DBemail!=$this->input->post('UsersEmail')&&$DBcontact==$this->input->post('UsersContact')){
                        if($userDetail[0]->users_emailactivated==1){
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail'),
                                'users_emailactivated'=>0
                            );
                        }else{
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail')
                            );
                        }
                    }
                    else{
                        if($userDetail[0]->users_emailactivated==1&&$userDetail[0]->users_mobileactivated==1){
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail'),
                                'users_emailactivated'=>0,
                                'users_contact'=>$this->input->post('UsersContact'),
                                'users_mobileactivated'=>0
                            );
                        }elseif($userDetail[0]->users_emailactivated==1&&$userDetail[0]->users_mobileactivated==0){
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail'),
                                'users_emailactivated'=>0,
                                'users_contact'=>$this->input->post('UsersContact')
                            );
                        }elseif($userDetail[0]->users_emailactivated==0&&$userDetail[0]->users_mobileactivated==1){
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail'),
                                'users_contact'=>$this->input->post('UsersContact'),
                                'users_mobileactivated'=>0
                            );
                        }else{
                            $data = array(
                                'users_bloodtype'=>$this->input->post('UsersBloodType'),
                                'users_area'=>$this->input->post('UsersArea'),
                                'users_dateofbirth'=>$this->input->post('UsersDOB'),
                                'users_gender'=>$this->input->post('UsersGender'),
                                'users_email'=>$this->input->post('UsersEmail'),
                                'users_contact'=>$this->input->post('UsersContact'),
                                'users_mobileactivated'=>0
                            );
                        }
                    }
                    $this->UsersModel->updateProfile($data,$id);
                    $this->session->set_flashdata('updatesuccess',true);
                    $this->session->set_flashdata('updatemessage',
                    '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    Profile Updated <span class="glyphicon glyphicon-ok-sign"></span>
                    </div>');
                    redirect('UsersProfileController/user_profile_view/'.$id,'location');
                }else{
                    $data['arealist']=$this->AreaModel->getarealist();
                    $data['regionlist']=$this->AreaModel->getregionlist();
                    $data['bloodtypelist'] = $this->BloodTypeModel->getbloodtypelist();
                    $this->load->view('users_profile/update_profile_view',$data);
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function age_check($date){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $dob = new DateTime($date);
                $now = new DateTime();
                if($now->diff($dob)->y > 16){
                    return true;
                }else{
                    $this->form_validation->set_message('age_check', 'You must be at least 17 years old');
                    return false;
                }
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
	}
    public function user_events_view(){
        $prefs = array(
                    'start_day'         => 'sunday',
                    'month_type'        => 'long',
                    'day_type'          => 'short',
                    'show_next_prev'    => TRUE,
                    'next_prev_url'     => base_url().'UsersProfileController/user_events_view/',
                    'show_other_days'   => TRUE,
                    'template'          => 
               '
        {table_open}
            <table class="table table-striped table-hover text-center">
        {/table_open}
        {heading_row_start}<tr>{/heading_row_start}
        {heading_previous_cell}
            <th>
                <a href="{previous_url}">&lt;&lt;</a>
            </th>
        {/heading_previous_cell}
        {heading_title_cell}
            <th colspan="{colspan}">
                {heading}
            </th>
        {/heading_title_cell}
        {heading_next_cell}
            <th>
                <a href="{next_url}">&gt;&gt;</a>
            </th>
        {/heading_next_cell}
        {heading_row_end}</tr>{/heading_row_end}
        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}
        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td class="success"><strong>{/cal_cell_start_today}
        {cal_cell_start_other}<td style="color:#ccc;">{/cal_cell_start_other}
        {cal_cell_content}<a href="{content}" class="btn btn-danger btn-xs">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}" class="btn btn-success btn-xs">{day}</a></div>{/cal_cell_content_today}
        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}
        {cal_cell_blank}&nbsp;{/cal_cell_blank}
        {cal_cell_other}{day}{/cal_cel_other}
        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</strong></td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}
        {table_close}</table>{/table_close}
');
        $year = $this->uri->segment(3);
        $month= $this->uri->segment(4);
        $this->load->library('calendar', $prefs);
        $event=$this->EventsModel->get_events($year, $month);
        $events = array();
        foreach($event as $row){
            $events[$row->event_day]=$row->event_name;
        }
        $data['events'] = $events;
        $this->load->view('users_profile/user_events_view',$data);
    }
    public function MyRequests(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $data['my_requests'] = $this->RequestsModel->get_MyRequests($_SESSION['user_id']);
                $data['events']=$this->EventsModel->get_events();
                $this->load->view('users_profile/myrequests',$data);
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function notifications(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $id = $this->uri->segment(3);
                $data['notifications']=$this->NotificationModel->get_notificationsById($id,$_SESSION['user_type']);
                $data['events']=$this->EventsModel->get_events();
                $this->load->view('users_profile/notifications',$data);
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function check_notifications(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $id = $_SESSION['user_id'];
                $notifications = $this->NotificationModel->count_unreadNotifications($id,$_SESSION['user_type']);
                $_SESSION['notifications'] = $notifications;
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function request_rejected(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                $requestID = $this->uri->segment(3);
                $notificationID = $this->uri->segment(4,null);
                $this->NotificationModel->notification_is_read($notificationID);
                $request = $this->BloodModel->get_specificRequest($requestID);
                $data['request']=$request[0];
                $data['events']=$this->EventsModel->get_events();
                $this->load->view('users_profile/request_rejected',$data);
            }else{
                redirect('UsersConroller/login','location');
            }
        }else{
            redirect('UsersConroller/login','location');
        }
        
    }
}
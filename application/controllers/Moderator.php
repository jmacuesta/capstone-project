<?php
defined('BASEPATH')OR exit('No Direct Script access allowed!');

class Moderator extends CI_Controller{
    public function __construct(){
        parent::__construct();
        
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('UsersModel');
        $this->load->model('NotificationModel');
        $this->load->model('RequestsModel');
        $this->check_notifications();
        
    }
    public function index(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                if($this->UsersModel->verify_emailActivation($_SESSION['user_email'])){
                    redirect('Moderator/landing_page','location');
                }else{
                    $this->load->view('users/verifyemailview');	
                }
                
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function logout(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $this->session->sess_destroy();
                redirect('UsersController/login','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function landing_page(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $this->load->view('moderator/landing_page');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
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
                $id = $_SESSION['user_id'];
                $notifications = $this->NotificationModel->count_unreadNotifications($id,$_SESSION['user_type']);
                $_SESSION['notifications']=$notifications;
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function pending_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $config['base_url']=base_url().'Moderator/pending_requests_view';
                $config['total_rows']=$this->RequestsModel->count_pendingRequests();
                $config['per_page']=10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_pendingBloodRequests($config['per_page'], $this->uri->segment(3));
                $this->load->view('moderator/pending_requests_view',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function rejected_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $config['base_url'] = base_url().'Moderator/rejected_requests_view';
                $config['total_rows']=$this->RequestsModel->count_rejectedRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_rejectedRequests($config['per_page'], $this->uri->segment(3));
                $this->load->view('moderator/rejected_requests_view',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function approved_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
            if($_SESSION['user_type']==1){
                $config['base_url'] = base_url().'Moderator/approved_requests_view';
                $config['total_rows']=$this->RequestsModel->count_approvedRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_approvedBloodRequests($config['per_page'],$this->uri->segment(3));
                $this->load->view('moderator/approved_requests_view',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function request_details_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $id = $this->uri->segment(3);
                $notifID = $this->uri->segment(4,null);
                $request = $this->BloodModel->get_specificRequest($id);
                $data['request']=$request[0];
                if(empty($request[0]->request_approvedBy)){
                    $request[0]->request_approvedBy = '';
                }else{
                    $approved = $this->UsersModel->getUserDetail($request[0]->request_approvedBy);
                    $request[0]->request_approvedBy = $approved[0]->users_firstname.' '.$approved[0]->users_lastname;
                    $request[0]->request_approvedByID = $approved[0]->users_id;
                }
                if(empty($request[0]->request_postedBy)){
                    $request[0]->request_postedBy = '';
                }else{
                    $posted = $this->UsersModel->getUserDetail($request[0]->request_postedBy);
                    $request[0]->request_postedBy = $posted[0]->users_firstname.' '.$posted[0]->users_lastname;
                    $request[0]->request_postedByID = $posted[0]->users_id;
                }
                if($request[0]->request_rejectedBy == null){
                    $request[0]->request_rejectedBy = '';
                }else{
                    $rejected = $this->UsersModel->getUserDetail($request[0]->request_rejectedBy);
                    $request[0]->request_rejectedBy = $rejected[0]->users_firstname.' '.$rejected[0]->users_lastname;
                    $request[0]->requrest_rejectedByID = $rejected[0]->users_id;
                }
                $user = $this->UsersModel->getUserDetail($request[0]->request_by_id);
                $data['user']=$user[0];
                $this->NotificationModel->notification_is_read($notifID);
                $this->load->view('moderator/request_details_view',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }public function in_approve_request_immediately(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $reqid = $this->uri->segment(3);
                $userid = $this->uri->segment(4);
                $this->RequestsModel->approve_request_immediately($reqid,$_SESSION['user_id']);
                //echo 'Request for immediate blood release approved for request #'.$id;
                $this->notify_userImmediateRelease($reqid,$userid);
                 $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been approved for blood bank release.',
                    'limiter'=>'<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                redirect('Moderator/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function notify_userImmediateRelease($request_id,$user_id){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $notification = array(
                    'notification_details'=>'Your blood request has been granted for blood bank release',
                    'notification_time'=>date("Y-m-d H:i:s",strtotime(unix_to_human(now()))),
                    'user_id'=>$user_id,
                    'request_id'=>$request_id,
                    'notification_url'=>base_url().'Requests/request_approvedImmediateRelease/'.$request_id.'/'.$user_id
                );
                $this->NotificationModel->addNotification($notification);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_approve_request_for_post(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->approve_request_for_posting($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been approved for posting.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                redirect('Moderator/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_disapprove_request_for_post(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->disapprove_request_posting($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been disapproved.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                redirect('Moderator/request_details_view/'.$reqid,'location');
               
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_post_request(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->post_request($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been posted',
                    'limiter'=>'<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                $this->session->set_flashdata($data);
                redirect('Moderator/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_remove_post(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->remove_post($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Posted request number <strong>'.$reqid.'</strong> has been removed.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                $this->session->set_flashdata($data);
                redirect('Moderator/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
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
                $dob = new DateTime($date);
                $now = new DateTime();
                if($now->diff($dob)->y > 16){
                    return true;
                }else{
                    $this->form_validation->set_message('age_check', 'Moderator must be at least 17 years old to use this site');
                    return false;
                }
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function users_list_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $config['base_url'] = base_url().'Moderator/users_list_view';
                $config['total_rows']=$this->AdminModel->count_usersList();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['list']=$this->AdminModel->get_UsersList($config['per_page'],$this->uri->segment(3));
                $this->load->view('moderator/users_list_view',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function user_details(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $id=$this->uri->segment(3);
                $userDetails = $this->AdminModel->getUserDetails($id);
                $data['userDetails']=$userDetails[0];
                $this->load->view('moderator/user_details',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function add_points_user(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $id=$this->uri->segment(3);
                $this->AdminModel->add_points_user($id);
                redirect('Moderator/user_details/'.$id,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
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
                $id = $_SESSION['user_id'];
                $notifications = $this->NotificationModel->count_unreadNotifications($id,$_SESSION['user_type']);
                $_SESSION['notifications'] = $notifications;
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
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
                $data['notifs'] = $this->NotificationModel->get_notificationsById($_SESSION['user_id'],$_SESSION['user_type']);
                $this->load->view('moderator/notifications',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function notification_details(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $request_id = $this->uri->segment(3);
                $notification_id = $this->uri->segment(4);
                $this->NotificationModel->notification_is_read($notification_id);
                $_SESSION['request_id']=$request_id;
                redirect('Moderator/view_notification_details','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function view_notification_details(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $requestid=$_SESSION['request_id'];
                $request = $this->RequestsModel->view_request($requestid);
                $data['request']=$request[0];
                $user = $this->UsersModel->getUserDetail($request[0]->request_by_id);
                $data['user']=$user[0];
                $this->load->view('moderator/notification_details',$data);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function reject_request(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $this->form_validation->set_rules('reject_reason', 'Reason', 'trim|required');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger>','</div>');
                $id = $this->input->post('request_id');
                $reason = $this->input->post('reject_reason');
                $data = array(
                    'request_rejected'=>1,
                    'request_rejectedBy'=>$_SESSION['user_id'],
                    'request_rejectionDetails'=>$reason,
                    'request_rejectionDate'=>date("Y-m-d H:i:s",strtotime(unix_to_human(now())))
                );
                $this->RequestsModel->rejectRequest($id,$data);
                $request = $this->RequestsModel->view_request($id);
                $userid = $request[0]->request_by_id;
                $this->notifyUserRejectedRequest($id,$userid);
                redirect('Moderator/request_details_view/'.$id,'location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function notifyUserRejectedRequest($id,$userid){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                $notificationdata = array(
                    'notification_details'=>'Your request has been rejected',
                    'notification_time'=>date("Y-m-d H:i:s",strtotime(unix_to_human(now()))),
                    'notification_url'=>base_url().'UsersProfileController/request_rejected/'.$id,
                    'user_id'=>$userid,
                    'user_type'=>3,
                    'request_id'=>$id
                );
                $this->NotificationModel->addNotification($notificationdata);
                $notifid =  $this->session->flashdata('insertedId');
                $notifURL = base_url().'UsersProfileController/request_rejected/'.$id.'/'.$notifid;
                $this->NotificationModel->addURLtoNotification($notifid,$notifURL);
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    
}
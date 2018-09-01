<?php
defined('BASEPATH') OR exit('No direct script acccess allowed');
class AdminController extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('AdminModel');
		$this->load->library('encryption');
        $this->load->model('BloodModel');
        $this->load->library('pagination');
        $this->load->helper('date');
        $this->load->model('RequestsModel');
        $this->load->model('UsersModel');
        $this->load->model('NotificationModel');
        if(isset($_SESSION['user_id'])){
            $this->check_notifications();
        }
		$this->encryption->initialize(
				array(
					'cipher' => 'aes-256',
					'mode' => 'ctr',
					'key' => 'VoAM3FbLrqYDSOa9ikUZy7zlJCNf0Bu6'
					)
			);
	}
	public function index(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/landing_page','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $this->check_notifications();
                $this->load->view('admin/home_view');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function rejected_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $config['base_url'] = base_url().'AdminController/rejected_requests_view';
                $config['total_rows']=$this->RequestsModel->count_rejectedRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_rejectedRequests($config['per_page'], $this->uri->segment(3));
                $this->load->view('admin/rejected_requests_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function pending_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $config['base_url'] = base_url().'AdminController/pending_requests_view';
                $config['total_rows']=$this->RequestsModel->count_pendingRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_pendingBloodRequests($config['per_page'], $this->uri->segment(3));
                $this->load->view('admin/pending_requests_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function approved_requests_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $config['base_url'] = base_url().'AdminController/approved_requests_view';
                $config['total_rows']=$this->RequestsModel->count_approvedRequests();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['user']=$this->UsersModel->getuserslist();
                $data['list']=$this->RequestsModel->get_approvedBloodRequests($config['per_page'],$this->uri->segment(3));
                $this->load->view('admin/approved_requests_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $this->load->view('admin/request_details_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_approve_request_immediately(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
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
                redirect('AdminController/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $notification = array(
                    'notification_details'=>'Your blood request has been granted for blood bank release',
                    'notification_time'=>date("Y-m-d H:i:s",strtotime(unix_to_human(now()))),
                    'user_id'=>$user_id,
                    'request_id'=>$request_id,
                    'notification_url'=>base_url().'Requests/request_approvedImmediateRelease/'.$request_id.'/'.$user_id
                );
                $this->NotificationModel->addNotification($notification);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->approve_request_for_posting($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been approved for posting.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                redirect('AdminController/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->disapprove_request_posting($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been disapproved.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                redirect('AdminController/request_details_view/'.$reqid,'location');
               
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->post_request($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Request number <strong>'.$reqid.'</strong> has been posted',
                    'limiter'=>'<div class="alert alert-info" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                $this->session->set_flashdata($data);
                redirect('AdminController/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $reqid = $this->uri->segment(3);
                $this->RequestsModel->remove_post($reqid,$_SESSION['user_id']);
                $data = array(
                    'success'=>true,
                    'message'=>'Posted request number <strong>'.$reqid.'</strong> has been removed.',
                    'limiter'=>'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
                    'delimiter'=>'</div>'
                );
                $this->session->set_flashdata($data);
                redirect('AdminController/request_details_view/'.$reqid,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $this->session->sess_destroy();
                redirect('UsersController/login','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function manage_moderator_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $config['base_url'] = base_url().'AdminController/manage_moderator_view';
                $config['total_rows']=$this->AdminModel->count_moderators();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $list['moderators']=$this->AdminModel->get_moderators($config['per_page'],$this->uri->segment(3));
                $this->load->view('admin/manage_moderator_view',$list);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }
        }else{
            redirect('UsersProfileController/index','location');
        }
    }
    public function moderator_details_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $id = $this->uri->segment(3);
                $mod_detail = $this->AdminModel->get_moderatorDetails($id);
                $data['mod_detail']=$mod_detail[0];
                $this->load->view('admin/moderator_details_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_deactivate_moderator(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $id = $this->uri->segment(3);
                $this->AdminModel->deactivate_moderator($id);
                $this->session->set_flashdata('deactivated',true);
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Moderator #'.$id.' has been deactivated</div>');
                redirect('AdminController/moderator_details_view/'.$id,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function in_activate_moderator(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $id = $this->uri->segment(3);
                $this->AdminModel->activate_moderator($id);
                $this->session->set_flashdata('activated',true);
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Moderator #'.$id.' has been activated</div>');
                redirect('AdminController/moderator_details_view/'.$id,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function deactivate_moderator(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $id = $this->uri->segment(3);
                $user = $this->UsersModel->getUserDetail($id);
                $this->AdminModel->deactivate_moderator($id);
                $this->session->set_flashdata('deactivated',true);
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Moderator #'.$id.', '.$user[0]->users_firstname.' '.$user[0]->users_lastname.'\'s Account has been deactivated</div>');
                redirect('AdminController/manage_moderator_view','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function activate_moderator(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $id = $this->uri->segment(3);
                $user = $this->UsersModel->getUserDetail($id);
                $this->AdminModel->activate_moderator($id);
                $this->session->set_flashdata('activated',true);
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Moderator #'.$id.', '.$user[0]->users_firstname.' '.$user[0]->users_lastname.'\'s Account has been activated</div>');
                redirect('AdminController/manage_moderator_view','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function add_moderator_view(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $this->load->model('BloodTypeModel');
                $this->load->model('AreaModel');
               //loads the getbloodtypelist method of BloodTypeModel and stores it in $Lists['bloodtypeslist'];
                $Lists['bloodtypeslist']=$this->BloodTypeModel->getbloodtypelist();
                //loads the getarealist method of AreaModel and stores it in $Lists['arealist'];
                $Lists['arealist']=$this->AreaModel->getarealist();
                //Loads the getregionlist method of Areamodel and stores it in $Lists['regionlist'];
                $Lists['regionlist']=$this->AreaModel->getregionlist();
                $this->load->view('admin/add_moderator_view',$Lists);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
    }
    public function add_moderator(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
                $this->form_validation->set_rules('modFName','First Name','trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules('modLName','Last Name','trim|required|regex_match[/^[a-zA-Z ]*$/]|min_length[2]');
                $this->form_validation->set_rules(
                'modEmail',
                'Email Address',
                'trim|required|valid_email|is_unique[users.users_email]',
                array(
                        'is_unique' => 'This %s is already used'
                    )
                );
                $this->form_validation->set_rules('modArea','Area of Residency','required');
                $this->form_validation->set_rules(
                'modContact',
                'Contact Number',
                'trim|required|numeric|exact_length[10]|is_unique[users.users_contact]',
                array(
                        'exact_length' => 'The %s must have 10 numbers in length',
                        'is_unique' => 'This %s is already used'
                    )
                );
                $this->form_validation->set_rules('modBloodType','Blood Type','required');
                $this->form_validation->set_rules('modDOB','Date of Birth','required|callback_age_check');
                $this->form_validation->set_rules('modGender','Gender','required');
                if($this->form_validation->run()){
                    $modFName=ucwords(strtolower($this->input->post('modFName')));
                    $modLName=ucwords(strtolower($this->input->post('modLName')));
                    $moderatorData = array(
                        'users_firstname'=>$modFName,
                        'users_lastname'=>$modLName,
                        'users_email'=>$this->input->post('modEmail'),
                        'users_password'=>sha1('BloodGrantModerator'),
                        'users_area'=>$this->input->post('modArea'),
                        'users_contact'=>$this->input->post('modContact'),
                        'users_bloodtype'=>$this->input->post('modBloodType'),
                        'users_dateofbirth'=>$this->input->post('modDOB'),
                        'users_gender'=>$this->input->post('modGender'),
                        'users_emailverificationcode'=>random_string('alnum',15),
                        'users_mobileverificationcode'=>strtoupper(random_string('alnum',6)),
                        'users_type'=>2
                    );
                    $this->UsersModel->add_user($moderatorData);
                    $this->session->set_flashdata('registerSuccess',true);
                    $this->session->set_flashdata('registerSuccessMsg','<div class="alert alert-success"><strong>Moderator '.$modFName.' '.$modLName.'</strong> has been created. The default password is <strong>BloodGrantPassword</strong>. This can be changed later.</div>');
                    redirect('AdminController/manage_moderator_view','location');
                }else{
                    $this-> add_moderator_view();
                }
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $dob = new DateTime($date);
                $now = new DateTime();
                if($now->diff($dob)->y > 16){
                    return true;
                }else{
                    $this->form_validation->set_message('age_check', 'Moderator must be at least 17 years old to use this site');
                    return false;
                }
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $config['base_url'] = base_url().'AdminController/users_list_view';
                $config['total_rows']=$this->AdminModel->count_usersList();
                $config['per_page'] = 10;
                $this->pagination->initialize($config);
                $data['list']=$this->AdminModel->get_UsersList($config['per_page'],$this->uri->segment(3));
                $this->load->view('admin/users_list_view',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $id=$this->uri->segment(3);
                $userDetails = $this->AdminModel->getUserDetails($id);
                $data['userDetails']=$userDetails[0];
                $this->load->view('admin/user_details',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $id=$this->uri->segment(3);
                $this->AdminModel->add_points_user($id);
                redirect('AdminController/user_details/'.$id,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $id = $_SESSION['user_id'];
                $notifications = $this->NotificationModel->count_unreadNotifications($id,$_SESSION['user_type']);
                $_SESSION['notifications'] = $notifications;
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $data['notifs'] = $this->NotificationModel->get_notificationsById($_SESSION['user_id'],$_SESSION['user_type']);
                $this->load->view('admin/notifications',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $request_id = $this->uri->segment(3);
                $notification_id = $this->uri->segment(4);
                $this->NotificationModel->notification_is_read($notification_id);
                $_SESSION['request_id']=$request_id;
                redirect('AdminController/view_notification_details','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                $requestid=$_SESSION['request_id'];
                $request = $this->RequestsModel->view_request($requestid);
                $data['request']=$request[0];
                $user = $this->UsersModel->getUserDetail($request[0]->request_by_id);
                $data['user']=$user[0];
                $this->load->view('admin/notification_details',$data);
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
                redirect('AdminController/request_details_view/'.$id,'location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
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

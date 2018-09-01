<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller{
	public function __construct(){
		parent::__construct();
		//loads the UsersModel, BloodTypeModel, AreaModel
		$this->load->model('UsersModel');
		$this->load->model('BloodTypeModel');
		$this->load->model('AreaModel');
		//loads the form validation library and encryption library
		$this->load->library('form_validation');
		$this->load->library('encryption');
        $this->load->library('recaptcha');
		$this->load->helper('date');
		//initializing the encryption settings
		$this->encryption->initialize(
				array(
					'cipher' => 'aes-256',
					'mode' => 'ctr',
					'key' => 'CyeGTTehnc6D6bpZxKN1edp6ZtMtBqf5'
					)
			);
	}
	public function index(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/landing_page');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'refresh');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            $this->load->view('users/homeview');    
        }
	}
    public function aboutview(){
        $this->load->view('users/aboutview');
    }
	public function register(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'refresh');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            //loads the getbloodtypelist method of BloodTypeModel and stores it in $Lists['bloodtypeslist'];
            $Lists['bloodtypeslist']=$this->BloodTypeModel->getbloodtypelist();
            //loads the getarealist method of AreaModel and stores it in $Lists['arealist'];
            $Lists['arealist']=$this->AreaModel->getarealist();
            //Loads the getregionlist method of Areamodel and stores it in $Lists['regionlist'];
            $Lists['regionlist']=$this->AreaModel->getregionlist();
            //passes the $Lists data into the users/registerview
            $this->load->view('users/registerview',$Lists);
        }
	}
	public function login(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            //loads the view loginview under users folder
            $this->load->view('users/loginview');    
        }
	}
	public function register_user(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            //setting up the form validation
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
            $this->form_validation->set_rules(
                'usersEmail',
                'Email Address',
                'trim|required|valid_email|is_unique[users.users_email]',
                array(
                        'is_unique' => 'This %s is already used'
                    )
                );
            $this->form_validation->set_rules('usersPassword','Password','trim|required|min_length[6]');
            $this->form_validation->set_rules('usersConfirmPassword','Confirm Password','trim|required|matches[usersPassword]');
            $this->form_validation->set_rules('usersFirstName','First Name','trim|required|min_length[2]|regex_match[/^[a-zA-Z ]*$/]');
            $this->form_validation->set_rules('usersLastName','Last Name','trim|required|min_length[2]|regex_match[/^[a-zA-Z ]*$/]');
            $this->form_validation->set_rules('usersGender','Gender','required');
            $this->form_validation->set_rules('usersBloodType','Blood Type','trim|required');
            $this->form_validation->set_rules('usersDOB', 'Birthday', 'required|callback_age_check');
            $this->form_validation->set_rules(
                'usersContactNumber',
                'Contact Number',
                'trim|required|numeric|exact_length[10]|is_unique[users.users_contact]',
                array(
                        'exact_length' => 'The %s must have 10 numbers in length',
                        'is_unique' => 'This %s is already used'
                    )
                );
            $this->form_validation->set_rules('usersArea','Area','trim|required');
            $this->form_validation->set_rules('usersAgreeTaC','Terms and Conditions','required',array('required'=>'You must agree to the %s stated'));
            $captcha_answer = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($captcha_answer);
            //running the form validation
            if($this->form_validation->run() && $response['success']){
                //if form validation is successful & captcha is verified
                //getting the data from view and inserting it to the $usersData
                $usersData = array(
                'users_email'=>$this->input->post('usersEmail'),
                'users_password'=>sha1($this->input->post('usersConfirmPassword')),
                'users_firstname'=>ucwords(strtolower($this->input->post('usersFirstName'))),
                'users_lastname'=>ucwords(strtolower($this->input->post('usersLastName'))),
                'users_gender'=>$this->input->post('usersGender'),
                'users_dateofbirth'=>$this->input->post('usersDOB'),
                'users_bloodtype'=>$this->input->post('usersBloodType'),
                'users_contact'=>$this->input->post('usersContactNumber'),
                'users_area'=>$this->input->post('usersArea'),
                'users_emailverificationcode'=>random_string('alnum',15),
                'users_mobileverificationcode'=>strtoupper(random_string('alnum',6)),
                'users_type'=>3
                );
                //for sending email verification after registration, we put some of the data registered into an expiring $_session
                $_SESSION['email_message_recipient']=$usersData['users_email'];
                $_SESSION['users_registrationemail']=str_replace(array('+', '/', '='), array('-', '_', '~'),$this->encryption->encrypt($usersData['users_email']));
                    /*
                        Note that the email has str replace function and encrypt function.	
                        It encrypts the email first into a string.
                        The encrypted string will contain characters '+', '/', and '=' which are characters not allowed in the URI
                        We replace this allowed characters in the URI with '-', '_' and '~' respectively
                    */
                $_SESSION['users_registrationgender']=$usersData['users_gender'];
                $_SESSION['users_registrationlastname']=$usersData['users_lastname'];
                $_SESSION['users_registrationcode']=$usersData['users_emailverificationcode'];
                //makes the sessions above temporary and available only for 10 minutes(600 seconds)
                $this->session->mark_as_temp('users_registrationemail', 'users_registrationgender','users_registrationlastname','users_registrationcode',600);
                //passes the $usersData array to UsersModel.php under add_user() method
                $this->UsersModel->add_user($usersData);
                //loads the send email verification after registration
                redirect('UsersController/send_email_verification_after_registration','location');
            }else{
                //if form validation encounters a violation on the rules set above, it goes back to the register page
                $this->load->model('BloodTypeModel');
                $BloodTypesList['bloodtypes'] = $this->BloodTypeModel->getbloodtypelist();
                $this->load->model('AreaModel');
                $AreaList['areas'] = $this->AreaModel->getarealist();
                $this->register();
            }
        }
	}
	public function age_check($date){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            $dob = new DateTime($date);
            $now = new DateTime();
            if($now->diff($dob)->y > 16){
                return true;
            }else{
                $this->form_validation->set_message('age_check', 'Must be at least 17 years old to register');
                return false;
            }
        }
	}
	public function send_email_verification_after_registration(){
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
            //configuring the smtp settings
            $config=array(
                'protocol'=>'smtp',
                'smtp_host'=>'ssl://smtp.googlemail.com',
                'smtp_port'=>'465',
                'smtp_user'=>'bloodgrant.ph@gmail.com',
                'smtp_pass'=>'dugongbayani123',
                'mailtype'=>'html',
                'charset'=>'iso-8859-1',
                'newline'=>"\r\n",
                'wordwrap'=>TRUE
                );
            //determining the title of the user if male/female
            if($_SESSION['users_registrationgender']=="Male"){
                $salutations ="Mr. ";
            }else{
                $salutations ="Ms. ";
            }
            //verification message to be sent on email
            $message = 	'Greetings, '.$salutations.$_SESSION['users_registrationlastname']."!\n".
                        'Your email is used to sign up to the website, BloodGrant.ph.'.
                        "Your account is almost ready, but before you can login to access this website, you need to verify your email by clicking the link below:\n".
                        base_url().'UsersController/activate_email/'.$_SESSION['users_registrationemail'].'/'.$_SESSION['users_registrationcode'].
                        "\n".
                        'If you did not register your email to BloodGrant.ph, Ignore this message.';
            //configuring the message header
            $this->load->library('email',$config);
            $this->email->from('noreply@jmnaoperations.info');
            $this->email->to($_SESSION['email_message_recipient']);
            $this->email->subject('BloodGrant.ph - Email Verification');
            $this->email->message($message);
            //sending the email
            if($this->email->send()){
                //when sending the email successfully
                $_SESSION['emailsuccess'] = true;
                $this->load->view('users/loginview');
            }else{
                //when sending the email fails
                echo '<script>';
                echo 'alert("an error has occured")';
                echo '</script>';
                $this->load->view('users/loginview');
            }
        }
	}
	public function resend_email_verification(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==3||$_SESSION['user_type']==2){
                $gender=$this->UsersModel->get_gender($_SESSION['user_email']);
                $registrationcode=$this->UsersModel->get_code($_SESSION['user_email']);
                //configuring the smtp settings
                $config=array(
                    'protocol'=>'smtp',
                    'smtp_host'=>'ssl://smtp.googlemail.com',
                    'smtp_port'=>'465',
                    'smtp_user'=>'bloodgrant.ph@gmail.com',
                    'smtp_pass'=>'dugongbayani123',
                    'mailtype'=>'html',
                    'charset'=>'iso-8859-1',
                    'newline'=>"\r\n",
                    'wordwrap'=>TRUE
                    );
                if($gender==="Male"){
                    $title="Mr. ";
                }else{
                    $title="Ms. ";
                }//09263200112
                $encryptedemail=$this->encryption->encrypt($_SESSION['user_email']);
                $clean_encryptedemail=str_replace(array('+', '/', '='),array('-', '_', '~'),$encryptedemail);
                //verification message to be sent on email
                $message = 	'Greetings, '.$title.$_SESSION['user_lastname']."!\n".
                            "\n".
                            'Your email is used to sign up to the website, BloodGrant.ph.'.
                            "Your account is almost ready, but before you can login to access this website, you need to verify your email by clicking the link below:\n".
                            base_url().'UsersController/activate_email/'.$clean_encryptedemail.'/'.$registrationcode.
                            "\n".
                            'If you did not register your email to BloodGrant.ph, Ignore this message.';
                $this->load->library('email',$config);
                $this->email->from('noreply@jmnaoperations.info');
                $this->email->to($_SESSION['user_email']);
                $this->email->subject('BloodGrant.ph - Email Verification');
                $this->email->message($message);
                //sending the email
                if($this->email->send()){
                    //when sending the email successfully
                    $_SESSION['emailsuccess'] = true;
                    $this->session->mark_as_temp('emailsuccess',600);
                    $this->load->view('users/verifyemailview');
                }else{
                    //when sending the email fails
                    echo '<script>';
                    echo 'alert("an error has occured")';
                    echo '</script>';
                    redirect('UsersController/login','location');
                }
            }else{
                redirect('UsersController/login','locaton');
            }
        }else{
            redirect('UsersController/login','locaton');
        }
	}
	public function activate_email(){
		/*
			the $email contains the uri segment 3 in the link (encrypted email address).
			Now we have to decrypt the email before we verify the email and code if it matches in the database.
			Before we decrypt the email, remember that we replaced the 
			characters '+', '/' and '=' with '-', '_' and '~' so that will be allowed in the URI
			now that we got it, we need to change '-', '_' and '~' back to ('+','/' and '=').
			After changing it back, we can now decrypt the string.
		*/
		$email=$this->encryption->decrypt(str_replace(array('-', '_', '~'),array('+', '/', '='),$this->uri->segment(3)));
		$code=$this->uri->segment(4);
		//loads the verifyemail method of UsersModel and passes the $email and $code
		if($this->UsersModel->verifyemail($email,$code)){
			//if verify email returns true, then account is now activated
            $emailverified = array(
                'verified'=>true,
                'limiter'=>'<div class="alert alert-success" role="alert">',
                'delimiter'=>'</div>',
                'message'=>'email is now verified! you may now login!'
            );
            $this->session->set_flashdata($emailverified);
			//loads the login method of this controller
			redirect('UsersController/login','location');
		}else{
			//it will say that the email is not verified.
			echo '<div class="alert alert-info" role="alert">';
            echo 'Email not verified. Try again';
            echo '</div>';
            echo '<script>';
            echo 'window.setTimeout(function() {';
            echo '  window.location.href=\''.base_url().'UsersController/login;\'';
            echo '}, 5000);';
            echo '</script>';
		}
	}
	public function login_user(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                if($_SESSION['user_emailactivated']==0){
                    $this->load->view('users/verifyemailview'/*,$users*/);
                }else{
                redirect('Moderator/index','location');
                }
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            //$users['userslist'] = $this->UsersModel->getuserslist();
            //set rules validation in login form
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
            $this->form_validation->set_rules('usersEmail','Email Address', 'required|valid_email');
            $this->form_validation->set_rules('usersPassword','Password', 'required');
            //running the form validation
            if($this->form_validation->run() == FALSE){
                //if form validation is not successful it loads back to the login section
                $this->login();
            }else{
                //data from the fiels inserted into $email and $userpassword variables
                $email=$this->input->post('usersEmail');
                $userpassword=sha1($this->input->post('usersPassword'));
                //checks if there is a match in the database
                if($this->UsersModel->login_matching($email,$userpassword)){
                    /*if there's a match in the accounts table*/
                    //get last name
                    $lastname=$this->UsersModel->get_userslastname($email);	
                    //get firstname
                    $firstname=$this->UsersModel->get_usersfirstname($email);
                    //get user data
                    $userdetails = $this->UsersModel->get_user($email);
                    $data['userdetails']=$userdetails[0];
                    $_SESSION['user_id']=$userdetails[0]->users_id;
                    $_SESSION['user_firstname']=$userdetails[0]->users_firstname;
                    $_SESSION['user_lastname'] =$userdetails[0]->users_lastname;
                    $_SESSION['user_fullname'] =$userdetails[0]->users_firstname.' '.$userdetails[0]->users_lastname;
                    $_SESSION['user_formalname']=$userdetails[0]->users_lastname.', '.$userdetails[0]->users_firstname;
                    $_SESSION['user_email']=$email;
                    $_SESSION['user_loggedin'] = true;
                    $_SESSION['user_bloodtype']=$userdetails[0]->users_bloodtype;
                    $_SESSION['user_contact']='+63'.$userdetails[0]->users_contact;
                    $_SESSION['user_gender']=$userdetails[0]->users_gender;
                    $_SESSION['user_area']=$userdetails[0]->users_area;
                    $_SESSION['user_dateofbirth']=$userdetails[0]->users_dateofbirth;
                    $_SESSION['user_deferred']=$userdetails[0]->users_deferred;
                    $_SESSION['user_defferred_type']=$userdetails[0]->users_deferred_type;
                    $_SESSION['user_last_donation']=$userdetails[0]->users_last_donation;
                    $_SESSION['user_type']=$userdetails[0]->users_type;
                    $_SESSION['user_emailactivated']=$userdetails[0]->users_emailactivated;
                    //checks if email is verified
                    if($this->UsersModel->verify_emailActivation($email)){
                        //if verified
                        redirect('UsersProfileController/user_home_view', 'location');
                    }else{
                        if($_SESSION['user_type']==1){
                            redirect('AdminController/index','location');
                        }elseif($_SESSION['user_type']==2){
                            //redirect('Moderator/index','location');
                            $this->load->view('users/verifyemailview'/*,$users*/);
                        }elseif($_SESSION['user_type']==3){
                            $this->load->view('users/verifyemailview'/*,$users*/);
                        }else{
                            redirect('UsersController/login','location');
                        }
                    }
                }else if($this->UsersModel->email_only_matches($email,$userpassword)){
                    //if an email matches but the password is incorrect
                    $data = array(
                        'wrongpassword' => true,
                        'message' => '<strong> The password you entered is incorrect!</strong>'
                        );
                    $this->load->view('users/loginview',$data);
                }else{//if there is no registered email	
                    $data = array(
                            'noemail' => true,
                            'message' => '<strong> The email you entered doesn\'t match any account</strong>'
                        );
                    $this->load->view('users/loginview',$data);
                }
            }
        }
	}
	public function message_sender(){
		$mobile_number = $this->UsersModel->
		$arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => "639181234567",
        "shortcode" => "29290123456",
        "message_id" => "12345678901234567890123456789012",
        "message" => urlencode("Welcome to My Service!"),
        "client_id" => "1e6d92a6e8794a7bb6aea67f008420e56a0272dfb21047369dc1ea0c9c8f8a19",
        "secret_key" => "502f3b2ecce940f5b750dab07bf6b222de86f6e270a6427e9a0ea6b194bb4bdc"
    );
    $query_string = "";
    foreach($arr_post_body as $key => $frow)
    {
        $query_string .= '&'.$key.'='.$frow;
    }
    $URL = "https://post.chikka.com/smsapi/request";
    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);
    exit(0);
	}//this is for mobile verification. Work in progress
	public function user_logout(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index');
            }elseif($_SESSION['user_type']==3||$_SESSION['user_type']==2){
                $this->session->sess_destroy();
                redirect('UsersController/login','location');
            }
        }else{
            redirect('UsersController/login','location');
        }
	}
	public function unverifiedemail(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                if($this->UsersModel->verify_emailActivation($_SESSION['user_email'])){
                    redirect('Moderator/index','location');
                }else{
                    $this->load->view('users/verifyemailview');	
                }
                
            }elseif($_SESSION['user_type']==3){
                if($this->UsersModel->verify_emailActivation($_SESSION['user_email'])){
                    redirect('UsersProfileController/user_home_view', 'location');
                }else{
                    $this->load->view('users/verifyemailview');	
                }
            }
		}else{
            redirect('UsersController/login','location');
		}
	}
	public function begin_password_reset(){
        if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view', 'location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            $this->load->view('users/recoverpasswordview');    
        }
	}
	public function send_password_reset(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/index','location');
            }else{
                redirect('UsersController/login','location');
            }
        }else{
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
            $this->form_validation->set_rules('emailtoken','Email', 'trim|required|valid_email');
            if($this->form_validation->run()){
                $emailtoken=$this->input->post('emailtoken');
                $_SESSION['emailtoken']=$emailtoken;
                if($this->UsersModel->emailchecker($emailtoken)){
                    //display information
                    $data['userinfo']=$this->UsersModel->getusersinfo($emailtoken);
                    //var_dump($data);
                    $this->load->view('users/confirmresetpassword',$data);
                }else{
                    $data = array(
                            'noemail' => true,
                            'message' => '<strong> The email you entered doesn\'t match any account</strong>'
                        );
                    $this->load->view('users/recoverpasswordview',$data);
                }
            }else{
                $this->load->view('users/recoverpasswordview');
            }
        }
	}
	public function not_me(){
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
            redirect('UsersController/begin_password_reset','location');
        }
	}
	public function reset_email_sent(){
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
            $this->form_validation->set_rules('sendMessage', 'Send Message', 'required');
            if($this->form_validation->run()){
                $config=array(
                    'protocol'=>'smtp',
                    'smtp_host'=>'ssl://smtp.googlemail.com',
                    'smtp_port'=>465,
                    'smtp_user'=>'bloodgrant.ph@gmail.com',
                    'smtp_pass'=>'dugongbayani123',
                    'mailtype'=>'html',
                    'charset'=>'iso-8859-1',
                    'wordwrap'=>TRUE,
                    'newline'=>"\r\n"
                    );
                $this->load->library('email',$config);
                $data['userinfo']=$this->UsersModel->getusersinfo($_SESSION['emailtoken']);
                $encryptedemail = $this->encryption->encrypt($data['userinfo']->users_email);
                $replacedencrypted = str_replace(array('+', '/', '='),array('-', '_', '~'),$encryptedemail);
                $message = 	'Hi '.$data['userinfo']->users_firstname.",\n".
                            "\n".
                            "We received a request to reset the password for your account.\n".
                            "If you requested a reset for ".$data['userinfo']->users_email.', '.
                            'click the link below. If you did not make this request, please ignore this email'.
                            "\n".
                            base_url().'UsersController/reset_password/'.$replacedencrypted;
                $this->email->set_newline("\r\n");
                $this->email->from('noreply@jmnaoperations.info');
                $this->email->to($data['userinfo']->users_email);
                $this->email->subject('BloodGrant.ph - Reset Password');
                $this->email->message($message);
                if($this->email->send()){
                    echo $message;
                    unset($_SESSION['emailtoken']);
                    $data = array(
                        'success' => true,
                        'msg'=>'Password reset sent'
                        );
                    $this->load->view('users/loginview',$data);
                }
            }else{
                redirect('UsersController/begin_password_reset','location');
            }
        }
	}
	public function reset_password(){
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
            $replacedencrypted = $this->uri->segment(3);
            $revert_replace = str_replace(array('-', '_', '~'),array('+', '/', '='),$replacedencrypted);
            $decryptedemail = $this->encryption->decrypt($revert_replace);
            $_SESSION['email'] = $decryptedemail;
            $data['userinfo']=$this->UsersModel->getusersinfo($decryptedemail);
            $this->load->view('users/resetpasswordview',$data);
        }
	}
	public function reset_user_password(){
		if(isset($_SESSION['user_loggedin'])){
            if($_SESSION['user_type']==1){
                redirect('AdminController/index','location');
            }elseif($_SESSION['user_type']==2){
                redirect('Moderator/index','location');
            }elseif($_SESSION['user_type']==3){
                redirect('UsersProfileController/user_home_view','location');
            }
        }else{
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
            $this->form_validation->set_rules('usersPassword', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('usersConfirmPassword', 'Confirm Password', 'trim|required|matches[usersPassword]');
            if($this->form_validation->run()){
                $password = sha1($this->input->post('usersPassword'));
                $this->UsersModel->update_password($_SESSION['email'],$password);
                $data = array(
                        'success' => true,
                        'msg'=>'Password updated'
                        );
                $this->load->view('users/loginview',$data);
            }else{
                $data['userinfo']=$this->UsersModel->getusersinfo($_SESSION['email']);
                $this->load->view('users/resetpasswordview',$data);
            }
        }
	}
}
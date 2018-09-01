<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('UsersModel');
		
	}

	public function index(){
		$this->load->model('BloodTypeModel');
		$data['bloodtypes'] = $this->BloodTypeModel->getbloodtypelist();
		$this->load->view('users/registerview',$data);
	}

	public function register(){
		$data['email']=$this->input->post('usersEmail');
		$data['password']=$this->input->post('usersPassword');
		$data['firstname']=$this->input->post('usersFirstName');
		$data['lastname']=$this->input->post('usersLastName');
		$data['bloodtype']=$this->input->post('usersBloodtype');
		$data['contactnumber']=$this->input->post('usersContactNumber');
		$this->UsersModel->add_user($data);
		$this->index();

		header('Location: http://localhost/BG/');
	}

	public function registerUser(){
		$userData = array(
			'users_email'=>$this->input->post('usersEmail'),
			'users_password'=>$this->input->post('usersPassword'),
			'users_firstname'=>$this->input->post('usersFirstName'),
			'users_lastname'=>$this->input->post('usersLastName'),
			'users_bloodtype'=>$this->input->post('usersBloodtype'),
			'users_contact'=>$this->input->post('usersContactNumber')
			);

		$this->UsersModel->add_user($userData);
		$this->index();

		header('Location: http://localhost/BG/');
	}

	public function login(){
		$this->load->view('users/loginview');
	}
}

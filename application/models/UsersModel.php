<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UsersModel extends CI_Model{
	public function getuserslist(){
		$users = $this->db->get('users');
		return $users->result();
	}
	public function get_user($email){
		$query = $this->db->get_where('users',array('users_email'=>$email));
		return $query->result();
	}
	public function get_gender($email){
		$this->db->select('users_gender');
		$query = $this->db->get_where('users',array('users_email'=>$email));
		return $query->result();
	}
	public function get_code($email){
		$this->db->select('users_emailverificationcode');
		$this->db->from('users');
		$this->db->where('users_email',$email);
		$dbemailcode=$this->db->get()->row('users_emailverificationcode');
		return $dbemailcode;
	}
	public function login_matching($email,$userpassword){
		$this->db->select('users_password');
		$this->db->from('users');
		$this->db->where('users_email', $email);
		$dbpassword=$this->db->get()->row('users_password');
		if($dbpassword===$userpassword){
			return true;
		}else{
			return false;
		}
	}
	public function email_only_matches($email,$userpassword){
		$this->db->select('users_email');
		$this->db->from('users');
		$this->db->where('users_email', $email);
		$dbemail=$this->db->get()->row('users_email');
		$this->db->select('users_password');
		$this->db->from('users');
		$this->db->where('users_email', $email);
		$dbpassword=$this->db->get()->row('users_password');
		if($dbpassword!=$userpassword&&$dbemail==$email){
			return true;
		}else{
			return false;
		}
	}
	public function verify_emailActivation($email){
		$this->db->select('users_emailactivated');
		$this->db->from('users');
		$this->db->where('users_email', $email);
		$dbaccountstatus=$this->db->get()->row('users_emailactivated');
		if($dbaccountstatus == 1){
			return true;
		}else{
			return false;
		}
	}
	public function add_user($data){
		$this->db->insert('users',$data);
	}
	public function get_userslastname($email){
		$this->db->select('users_lastname');
		$this->db->from('users');
		$this->db->where('users_email',$email);
		$userlastname=$this->db->get()->row('users_lastname');
		return $userlastname;
	}
	public function get_usersfirstname($email){
		$this->db->select('users_firstname');
		$this->db->from('users');
		$this->db->where('users_email',$email);
		$userfirstname=$this->db->get()->row('users_firstname');
		return $userfirstname;
	}
	public function verifyemail($email,$code){
		$this->db->select('users_emailverificationcode');
		$this->db->from('users');
		$this->db->where('users_email',$email);
		$dbcode=$this->db->get()->row('users_emailverificationcode');
		if($code === $dbcode){
			$this->db->set('users_emailactivated',1);
			$this->db->update('users');
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//work in progress
	public function get_mobile(){
	}
	public function emailchecker($email){
		$this->db->select('users_email');
		$this->db->from('users');
		$this->db->where('users_email',$email);
		$results = $this->db->count_all_results();
		if($results > 0){
			return true;
		}else{
			return false;
		}
	}
	public function getusersinfo($email){
		$userinfo=$this->db->get_where('users', array('users_email' => $email));
		return $userinfo->row();
	}
	public function update_password($email,$password){
		$this->db->set('users_password',$password);
		$this->db->where('users_email',$email);
		$this->db->update('users');
	}
    public function getUserDetail($id){
       $query = $this->db->get_where('users',array('users_id'=>$id));
       return $query->result();
   }
    public function updateProfile($data,$id){
        $this->db->where('users_id',$id);
        $this->db->update('users',$data);
    }
    public function get_usersByBloodtype($bloodtype){
        if($bloodtype=='ANY'){
            $query = $this->db->get('users');
        }else{
            $this->db->where('users_bloodtype',$bloodtype);
            $query = $this->db->get('users');
        }
        return $query->result();
    }
}
<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class AdminModel extends CI_Model{
	public function get_account($email){
		$query = $this->db->get_where('admin',array('admin_email'=>$email));
		return $query->result();
	}
	public function login_checking($email,$password){
		$this->db->select('admin_password');
		$this->db->from('admin');
		$this->db->where('admin_email',$email);
		$dbpassword=$this->db->get()->row('admin_password');
		if($dbpassword===$password){
			return true;
		}else{
			return false;
		}
	}
	public function email_only_matches($email,$password){
		$this->db->select('admin_password');
		$this->db->from('admin');
		$this->db->where('admin_email',$email);
		$dbpassword=$this->db->get()->row('admin_password');
		$this->db->select('admin_email');
		$this->db->from('admin');
		$this->db->where('admin_email',$email);
		$dbemail=$this->db->get()->row('admin_email');
		if(($dbemail===$email)&&($dbpassword!=$password)){
			return true;
		}else{
			return false;
		}
	}
	public function emailchecker($email){
		$this->db->select('admin_email');
		$this->db->from('admin');
		$this->db->where('admin_email', $email);
		$count = $this->db->count_all_results();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
	public function update_password($email,$password){
		$this->db->set('admin_password',$password);
		$this->db->where('admin_email',$email);
		$this->db->update('admin');
	}  
    public function get_moderators($limit,$offset){
        $this->db->limit($limit,$offset);
        $this->db->where('users_type','2');
        $query = $this->db->get('users ');
        return $query->result();
    }
    public function count_moderators(){
        $this->db->where('users_type','2');
        return $this->db->count_all('users');
    }
    public function get_moderatorDetails($id){
        $query = $this->db->get_where('users',array('users_id'=>$id,'users_type'=>'2'));
        return $query->result();
    }
    public function deactivate_moderator($id){
        $this->db->where('users_id',$id);
        $this->db->update('users',array('moderator_activated'=>null));
    }
    public function activate_moderator($id){
        $this->db->where('users_id',$id);
        $this->db->update('users',array('moderator_activated'=>1));
    }
    public function addModerator($moderatorData){
        $this->db->insert('moderator',$moderatorData);
    }
    public function count_usersList(){
        //$this->db->where('users_emailactivated',1);
        return $this->db->count_all_results('users');
    }
    public function get_UsersList($limit,$offset){
        $this->db->limit($limit,$offset);
        //$query = $this->db->get_where('users',array('users_emailactivated'=>1));
        $query = $this->db->get('users');
        return $query->result();
    }
    public function getUserDetails($id){
        $query = $this->db->get_where('users',array('users_id'=>$id));
        return $query->result();
    }
    public function add_points_user($id){
        $this->db->where('users_id',$id);
        $this->db->set('users_points', 'users_points+1', FALSE);
        $this->db->update('users');
    }
    public function adminlist(){
        $query = $this->db->get_where('users',array('users_type'=>1));
        return $query->result();
    }
}
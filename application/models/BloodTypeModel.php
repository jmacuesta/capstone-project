<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BloodTypeModel extends CI_Model{
	public function getbloodtypelist(){
		$bloodtype = $this->db->get('bloodtype');
		return $bloodtype->result();
	}
}
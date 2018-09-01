<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AreaModel extends CI_Model{
	public function getarealist(){
		$area = $this->db->get('area');
		return $area->result();
	}
	public function getregionlist(){
		$region = $this->db->get('region');
		return $region->result();
	}
}
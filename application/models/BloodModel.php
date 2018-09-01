<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class BloodModel extends CI_Model {
    public function insert_bloodRequest($data){
        $this->db->insert('requests',$data);
        $insertedID = $this->db->insert_id();
        $this->session->set_flashdata('last_id',$insertedID);
    }
    public function get_bloodRequests($limit, $offset){
        $this->db->order_by('request_time','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('requests');
        return $query->result();
    }
    public function count_requests(){
        $count = $this->db->count_all('requests');
        return $count;
    }
    public function get_specificRequest($id){
        $q = $this->db->get_where('requests', array('request_id' => $id));
        return $q->result();
    }
    public function approve_request($id,$adminApproved,$approveTime){
        $data = array(
            'request_approved'=>1,
            'request_approvedBy'=>$adminApproved,
            'request_approvalTime'=>$approveTime
        );
        $this->db->where('request_id',$id);
        $this->db->update('requests', $data);
    }
    public function disapprove_request($id,$adminDisapproved,$disapproveTime){
        $data = array(
            'request_approved'=>0,
            'request_approvedBy'=>$adminDisapproved,
            'request_approvalTime'=>$disapproveTime
        );
        $this->db->where('request_id',$id);
        $this->db->update('requests', $data);
    }
    public function post_request($id,$adminPosted,$postTime){
        $data = array(
            'request_posted'=>1,
            'request_postedBy'=>$adminPosted,
            'request_postingTime'=>$postTime
        );
        $this->db->where('request_id',$id);
        $this->db->update('requests',$data);
    }
    public function removePost_request($id,$adminPosted,$removePostTime){
        $data = array(
            'request_posted'=>0,
            'request_postedBy'=>$adminPosted,
            'request_postingTime'=>$removePostTime
        );
        $this->db->where('request_id',$id);
        $this->db->update('requests',$data);
    }
}
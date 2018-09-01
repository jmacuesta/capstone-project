<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RequestsModel extends CI_Model{
    public function get_pendingBloodRequests($limit, $offset){
        $this->db->order_by('request_time','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get_where('requests',array('request_approved'=>0,'request_rejected'=>null));
        return $query->result();
    }
    public function get_rejectedRequests($limit, $offset){
        $this->db->order_by('request_time','desc');
        $this->db->limit($limit,$offset);
        $query = $this->db->get_where('requests',array('request_rejected'=>1));
        return $query->result();
    }
    public function get_approvedBloodRequests($limit, $offset){
        $this->db->order_by('request_time','desc');
        $this->db->limit($limit, $offset);
        $query = $this->db->get_where('requests',array('request_approved'=>1));
        return $query->result();
    }
    public function count_rejectedRequests(){
        $this->db->from('requests');
        $this->db->where(array('request_rejected'=>1));
        return $this->db->count_all_results();
    }
    public function count_pendingRequests(){
        $this->db->from('requests');
        $this->db->where(array('request_approved'=>0));
        return $this->db->count_all_results();
    }
    public function count_approvedRequests(){
        $this->db->from('requests');
        $this->db->where(array('request_approved'=>1));
        return $this->db->count_all_results();
    }
    public function delete_request($id){
        $this->db->where('request_id',$id);
        $this->db->delete('requests');
    }
    public function get_postedRequests($limit,$offset,$bloodtype){
        $this->db->order_by('request_approvalTime','desc');
        $this->db->limit($limit,$offset);
        $this->db->where('request_posted',1);
        $this->db->where('request_neededBloodType','ANY');
        $this->db->or_where('request_neededBloodType',$bloodtype);
        $query = $this->db->get('requests');
        return $query->result();
    }
    public function count_postedRequests(){
        $this->db->from('requests');
        $this->db->where(array('request_posted'=>1));
        return $this->db->count_all_results();
    }
    public function interestedDonor($requestID, $userId){
        $query = $this->db->get_where('requests',array('request_id'=>$requestID));
        $column = $query->result();
        if($column[0]->request_InterestedDonors==null){
            $this->db->set('request_InterestedDonors', $userId, FALSE);
        }else{
            $this->db->set('request_InterestedDonors', "CONCAT(request_InterestedDonors, ',', ".$userId.")", FALSE);
        }
        $this->db->where('request_id',$requestID);
        $this->db->set('request_NumInterestedDonors', 'request_NumInterestedDonors+1', FALSE);
        $this->db->update('requests');
    }
    public function get_myRequests($userID){
        //$u_query = $this->db->get_where('users',array('users_id'=>$userID));
        //$data = $u_query->result();
        //$request_by = $data[0]->users_lastname.', '.$data[0]->users_firstname;
        $r_query = $this->db->get_where('requests',array('request_by_id'=>$userID));
        return $r_query->result();
    }
    public function view_request($id){
        $query = $this->db->get_where('requests',array('request_id'=>$id));
        return $query->result();
    }
    public function approve_request_immediately($request_id,$user_id){
        $this->db->set('request_approved','1');
        $this->db->set('request_approvalType','1');
        $this->db->set('request_approvedBy',$user_id);
        $this->db->set('request_approvalTime',date("Y-m-d H:i:s",strtotime(unix_to_human(now()))));
        $this->db->where('request_id',$request_id);
        $this->db->update('requests');
    }
    public function approve_request_for_posting($request_id,$user_id){
        $this->db->set('request_approved','1');
        $this->db->set('request_approvalType','2');
        $this->db->set('request_approvedBy',$user_id);
        $this->db->set('request_approvalTime',date("Y-m-d H:i:s",strtotime(unix_to_human(now()))));
        $this->db->where('request_id',$request_id);
        $this->db->update('requests');
    }
    public function rejectRequest($id,$data){
        $this->db->set($data);
        $this->db->where('request_id',$id);
        $this->db->update('requests');
    }
    
    public function disapprove_request_posting($request_id,$user_id){
        $this->db->set('request_approved','0');
        $this->db->set('request_approvalType','');
        $this->db->set('request_approvedBy',$user_id);
        $this->db->set('request_approvalTime',date("Y-m-d H:i:s",strtotime(unix_to_human(now()))));
        $this->db->where('request_id',$request_id);
        $this->db->update('requests');
    }
    public function post_request($reqid,$userid){
        $this->db->set('request_posted','1');
        $this->db->set('request_postedBy',$userid);
        $this->db->set('request_postingTime',date("Y-m-d H:i:s",strtotime(unix_to_human(now()))));
        $this->db->where('request_id',$reqid);
        $this->db->update('requests');
    }
    public function remove_post($reqid,$userid){
        $this->db->set('request_posted','0');
        $this->db->set('request_postedBy',$userid);
        $this->db->set('request_postingTime',date("Y-m-d H:i:s",strtotime(unix_to_human(now()))));
        $this->db->where('request_id',$reqid);
        $this->db->update('requests');
    }
}
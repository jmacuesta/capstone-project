<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class NotificationModel extends CI_Model{
    public function addNotification($notification){
        $this->db->insert('notifications',$notification);
        $insertedID = $this->db->insert_id();
        $this->session->set_flashdata('insertedId',$insertedID);
    }
    public function get_notificationsById($userid,$usertype){
        $this->db->order_by('notification_time','desc');
        $this->db->limit('5');
        //$query = $this->db->get_where('notifications', array('user_id',$userid));
        $this->db->where('user_type',$usertype);
        $this->db->where('user_id',$userid);
        $query = $this->db->get('notifications');
        return $query->result();
    }
    public function count_unreadNotifications($id,$usertype){
        $this->db->from('notifications');
        $this->db->where('user_type',$usertype);
        $this->db->where('user_id',$id);
        $this->db->where('notification_read','0');
        return $this->db->count_all_results();
    }
    public function notification_is_read($notificationid){
        $this->db->set('notification_read','1');
        $this->db->where('notification_id',$notificationid);
        $this->db->update('notifications');
    }
    
    public function addURLtoNotification($id, $url){
        $this->db->set('notification_url',$url);
        $this->db->where('notification_id',$id);
        $this->db->update('notifications');
    }
}
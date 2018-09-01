<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class EventsModel extends CI_Model{
    public function get_events(){
        //$this->db->like('event_date',"$year-$month");
        $today = date("Y-m-d",strtotime(unix_to_human(now())));
        $nextmonth = date("Y-m-d",strtotime($today. "+1 month"));
        $this->db->where('event_date >=', $today);
        $this->db->where('event_date <=', $nextmonth);
        $this->db->order_by('event_date', 'ASC');
        $query = $this->db->get('events');
        return $query->result();
    }
    public function count_events(){
        return $this->db->count_all_results('events');
    }
    public function get_event($id){
        $query = $this->db->get_where('events',array('event_id'=>$id));
        return $query->result();
    }
}

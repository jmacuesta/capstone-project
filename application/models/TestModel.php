<?php
defined('BASEPATH')OR exit('No direct Script access allowed');

class TestModel extends CI_Model{
    function generate_calendar($year,$month){
        $prefs = array(
		        'start_day'    => 'sunday',
		        'month_type'   => 'long',
		        'day_type'     => 'short',
		        'show_next_prev'  => TRUE,
        		'next_prev_url'   => base_url().'Test2Controller/index'
		);
        $events = $this->get_events($year, $month);
        print_r($events);
        $this->load->library('calendar', $prefs);
        return $this->calendar->generate($year,$month,$events);
    }
    
    function get_events($year, $month){
        $events = array();
        $this->db->like('event_date',"$year-$month");
        $query = $this->db->get('events');
        $query = $query->result();
        foreach($query as $row){
            $day = (int)substr($row->event_date, 8, 2);
            
            $events[$day] = $row->event_name;
        }
        return $events;
    }
}
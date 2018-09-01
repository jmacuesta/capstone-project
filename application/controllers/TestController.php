<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class TestController extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library('image_lib');
        }

        public function index()
        {
                //$config['file_name']            = 'Sample';
                //$this->load->view('test/upload_form', array('error' => ' ' ));
                $this->load->view('test/test');
        }

        public function do_upload()
        {
                $this->load->library('upload');

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('test/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('test/upload_success', $data);
                }
        }
    
        public function resize_image(){
            $config['image_library'] = 'GD2';
            $config['source_image'] = base_url().'assets/uploads/users/1.jpg';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 75;
            $config['height']       = 50;
            $config['create_thumb']       = true;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
        }
    
        public function extra(){
            $prefs = array(
                    'start_day'         => 'sunday',
                    'month_type'        => 'long',
                    'day_type'          => 'short',
                    'show_next_prev'    => TRUE,
                    'next_prev_url'     => base_url().'UsersProfileController/user_home_view/',
                    'show_other_days'   => TRUE,
                    'template'          => 
               '

        {table_open}
            <table class="table table-striped table-hover table-condensed text-center">
        {/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}
            <th>
                <a href="{previous_url}">&lt;&lt;</a>
            </th>
        {/heading_previous_cell}
        
        {heading_title_cell}
            <th colspan="{colspan}">
                {heading}
            </th>
        {/heading_title_cell}
        {heading_next_cell}
            <th>
                <a href="{next_url}">&gt;&gt;</a>
            </th>
        {/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td class="success"><strong>{/cal_cell_start_today}
        {cal_cell_start_other}<td style="color:#ccc;">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}" class="btn btn-danger btn-xs">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}" class="btn btn-success btn-xs">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}{day}{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</strong></td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
'
            );
            $this->load->library('calendar', $prefs);
            
           $year = $this->uri->segment(3);
           $month= $this->uri->segment(4);
           $event=$this->EventsModel->get_events($year, $month);
           $events = array();
           foreach($event as $row){
               $events[$row->event_day]=$row->event_name;
           }
           $data['events'] = $events;
            $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4),$events);
        }
}
?>
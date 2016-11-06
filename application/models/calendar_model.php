<?php

class Calendar_model extends CI_Model{
    var $prefs;
    function __construct() {
        parent::__construct();
        $this->prefs = array(
            'start_day'    => 'monday',
            'day_type'     => 'long',
            'show_next_prev'  => TRUE,
            'next_prev_url'   =>  base_url('index.php/internal_calendar/index/')
        );
        
        $this->prefs['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr class="heading_row">{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
            <div class="day_num">{day}</div>
            <div class="content">{content}</div>
        {/cal_cell_content}
        {cal_cell_content_today}
            <div class="day_num highlight">{day}</div>
            <div class="content">{content}</div>
        {/cal_cell_content_today}

        {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
        ';
    }
    function get_calendar_data($year, $month){
        $this->db->select('i_date, i_data');
        $this->db->from('internal_calendar');
        $this->db->like('i_date', "$year-$month", 'after');
        $query = $this->db->get();       
        $cal_data = array();      
        foreach ($query->result() as $row){
            $cal_data[intval(substr($row->i_date, 8, 2))] = $row->i_data;
        }  
        return $cal_data;
    }
    
    function add_calendar_data($date,$data){
        $query = $this->db->get_where('internal_calendar', array('i_date' => $date));
        if($query->num_rows() <> 0){
            $this->db->where('i_date',$date);
            $this->db->update('internal_calendar',array(
                'i_date' => $date,
                'i_data' => $data
            ));
        }else{
            $this->db->insert('internal_calendar',array(
                'i_date' => $date,
                'i_data' => $data
            ));
        }
    }
    function generate($year,$month){      
        $this->load->library('calendar',$this->prefs);
        //$this->add_calendar_data('2016-11-07', 'More test');
        $cal_data = $this->get_calendar_data($year, $month);
        return $this->calendar->generate($year,$month,$cal_data);
    }
}

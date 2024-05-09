<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alerts extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Alerts_model');
    }

    public function index(){
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }

        $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

        $year_month_array = array();
        $yearcurrent=date("Y");
        $reached_end = false;
      
        $count = 1;
        for($y=$yearcurrent;$y>=2022;$y--) 
        {
            
          $monthcurrent=date('m');
          $year_month_array[$count]['year'] = $y;
          $month_count = 1;
          for($m=1;$m<=12;$m++) 
          {	
                  $mname = $mons[$m];
                  $enable_link = false;
                  $_m = sprintf("%02d", $m); //month in 01,02 format
                  $datecurrent = $y."-".$_m."-01";
                  $query = $this->Alerts_model->get_alert_count($y,$_m);
                  
                  foreach($query as $row){
                    if($row->row_count>0) { $enable_link=true; }
                  }
                    
                  if($reached_end==false && $enable_link==true)
                  { 
                    $year_month_array[$count]['months'][$month_count] = $mname; 
                  } else {
                    $year_month_array[$count]['months'][$month_count] = '-'; 
                  }
                  if($monthcurrent==$m && $yearcurrent==$y) { $reached_end=true; }
                  $month_count++;
          } 
          $count++;
        }
        $data['alerts_info'] = $this->Alerts_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Alerts_model->getAlertsCount();
      
         $data['year_month'] = $year_month_array;
         $this->load->view('alerts/index',$data);
    }

    public function get_month_vice_alert_lst($timestamp)
    {
        $date_array = explode("-",$timestamp);

        $year = $date_array[0];
        $month_in_texts = $date_array[1];

        $months = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

        for($m=1;$m<=12;$m++) {
          if($months[$m] == $month_in_texts) {
            $month_in_number = sprintf("%02d",$m);
          }
        }

        $data['alert_list'] = $this->Alerts_model->get_month_list($year,$month_in_number,'');
        $data['alerts_info'] = $this->Alerts_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Alerts_model->getAlertsCount();
        $this->load->view('alerts/month_list',$data);
    }

    public function delete_list(){
       $delete_list_id = $this->input->post('alert_ids');
       for($i=0;$i<count($delete_list_id);$i++){
          $this->Alerts_model->delete_list($delete_list_id[$i]);
       }
      
    }

    public function delete_single_list(){
      $delete_list_id = $this->input->post('alert_id');
      $this->Alerts_model->delete_list($delete_list_id);
   }

   public function alert_details(){
      $list_id = $this->uri->segment('3');
      $data['list_details'] = $this->Alerts_model->get_alert_details($list_id);
      $data['alerts_info'] = $this->Alerts_model->getAlertsInfo();
		  $data['alerts_cnt'] = $this->Alerts_model->getAlertsCount();
      $this->load->view('alerts/alerts_details',$data);
   }

   public function change_status(){
      $alert_id = $this->input->post('alert_id');
      $status = $this->input->post('status');
      $this->Alerts_model->change_status($alert_id,$status);
   }

   public function alert_config(){
     $data['get_alert_config'] = $this->Alerts_model->get_alert_config();
     $data['alerts_info'] = $this->Alerts_model->getAlertsInfo();
		 $data['alerts_cnt'] = $this->Alerts_model->getAlertsCount();
     $this->load->view('alerts/alert_config',$data);
   }

   public function get_menu_details(){

    $menu_type = $this->input->post('menu_type');
    $menu_data = $this->Alerts_model->get_month_list('','',$menu_type);

    $lists = '';
    if($menu_data == 'redirect') {
      echo 'redirect to current page';
    } else {
    foreach($menu_data as $list){ 
    $url =  base_url("Alerts/alert_details/".$list->id);
    $status = "'$list->id'".','."'$list->status'";
        if($list->status == 'new'){
            $bg_color= 'red';
        } else {
            $bg_color= 'gray';
        }
    
       
   $lists .= '<tr>
        <td><input type="checkbox" class="row-checkbox"></td>
        <td>'.$list->id.'</td>
        <td>'.$list->status.'</td>
        <td>'.$list->title.'</td>
        <td>'.$list->log_timestamp.'</td>
        
        <td>
            <div align="center">
             <a href="'.$url.'">
                <i class="far fa-file-alt" style="font-size:24px">&#xf233;</i>
             </a> 
            </div>
            
        </td>
        
        <td>
            <div align="center">
              <i onclick="change_status('.$status.')" class="fa fa-close" style="font-size:24px;cursor:pointer;color:'.$bg_color.'"></i>
            </div>
        </td>

        <td>
            <div align="center">
              <i  onclick="deleteid('.$list->id.')" class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;cursor:pointer;"></i>
            </div>
        </td>

    </tr>';

  } 
    echo $lists;
   }
   }


   public function update_alert_config(){
       $data['edge_up_down'] =  $this->input->post('edge_up_down') == 'on' ? 'TRUE' : 'FALSE';
       $data['edge_up_down_mail'] = $this->input->post('edge_up_down_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['gw_up_down'] = $this->input->post('gw_up_down') == 'on' ? 'TRUE' : 'FALSE';
       $data['gw_up_down_mail'] = $this->input->post('gw_up_down_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['fw_high_pkt_drop'] = $this->input->post('fw_high_pkt_drop') == 'on' ? 'TRUE' : 'FALSE';
       $data['fw_high_pkt_drop_mail'] = $this->input->post('fw_high_pkt_drop_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['core_ui_user_login'] = $this->input->post('core_ui_user_login') == 'on' ? 'TRUE' : 'FALSE';
       $data['core_ui_user_login_mail'] = $this->input->post('core_ui_user_login_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['link_status_sdwan_down'] = $this->input->post('link_status_sdwan_down') == 'on' ? 'TRUE' : 'FALSE';
       $data['link_status_sdwan_down_mail'] = $this->input->post('link_status_sdwan_down_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['link_status_sdwan_up'] = $this->input->post('link_status_sdwan_up') == 'on' ? 'TRUE' : 'FALSE';
       $data['link_status_sdwan_up_mail'] = $this->input->post('link_status_sdwan_up_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_usage'] = $this->input->post('sdwan_link_high_usage') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_usage_mail'] = $this->input->post('sdwan_link_high_usage_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_latency'] = $this->input->post('sdwan_link_high_latency') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_latency_mail'] = $this->input->post('sdwan_link_high_latency_mail') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_jitter'] = $this->input->post('sdwan_link_high_jitter') == 'on' ? 'TRUE' : 'FALSE';
       $data['sdwan_link_high_jitter_mail'] = $this->input->post('sdwan_link_high_jitter_mail') == 'on' ? 'TRUE' : 'FALSE';
       $updated_data['get_alert_config'] = $this->Alerts_model->update_alert_config($data);
       $updated_data['alerts_info'] = $this->Alerts_model->getAlertsInfo();
		   $updated_data['alerts_cnt'] = $this->Alerts_model->getAlertsCount();
       $this->load->view('alerts/alert_config',$updated_data);
   }

}

?>
<?php

class Alerts_model extends CI_Model
{

   function get_alert_count($y, $_m)
   {

      $query = $this->db->query("select count(*) row_count FROM smoad_alerts
    WHERE year(log_timestamp) = $y and month(log_timestamp) = $_m");
      return $query->result();

   }

   function get_month_list($y, $m, $type)
   {

      if ($type == '') {
         $query = $this->db->query("select * from smoad_alerts where year(log_timestamp) = $y and month(log_timestamp) = $m order by id desc");
      } else if ($type == 'historical_log') {
         return 'redirect';
      } else {
         $query = $this->db->query("select * from smoad_alerts where type='$type' order by id desc");
      }

      return $query->result();

   }
   function getAlertsInfo()
   {
     return $this->db->get('smoad_alerts')->result();
   }
 
   function getAlertsCount()
   {
     return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
   }

   function delete_list($id)
   {

      $this->db->delete('smoad_alerts', ['id' => $id]);

   }

   function get_alert_details($id)
   {

      $alert_list = $this->db->where('id', $id)->get('smoad_alerts')->result();
      return $alert_list;

   }

   function change_status($alert_id, $status)
   {

      if ($status == 'new') {
         $change_status = 'dismiss';
      } else {
         $change_status = 'new';
      }
      $data['status'] = $change_status;

      $this->db->where('id', $alert_id);
      $this->db->update('smoad_alerts', $data);

   }

   function get_menu_details()
   {

   }

   function get_alert_config()
   {
      return $this->db->where('id', 1)->get('smoad_alert_config')->result();
   }

   function update_alert_config($data)
   {
      $this->db->where('id', 1);
      $this->db->update('smoad_alert_config', $data);
      return $this->db->where('id', 1)->get('smoad_alert_config')->result();
   }

}

?>
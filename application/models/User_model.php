<?php

class User_model extends CI_Model {


    function get_users(){
      return $this->db->where_not_in('access_level','customer')->get('smoad_users')->result();
    }
    
   function save_user($data) {
        if($this->db->insert('smoad_users',$data)){
            return true;
        } else {
            return false;
        }
   }

   function delete_user($id){

    if($this->db->delete('smoad_users',['id'=>$id])){
      return true;
    } else {
        return false;
    }
    
   }
   function getAlertsInfo()
   {
     return $this->db->get('smoad_alerts')->result();
   }
 
   function getAlertsCount()
   {
     return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
   }

   function get_user_info($id){
       return $this->db->where('id',$id)->get('smoad_users')->result();
   }

   function update_user($data,$id) {

    $this->db->where('id',$id);
    $this->db->update('smoad_users',$data);
    return $this->db->get('smoad_users')->result();
   }


   function getUserHistory($id){
    $username_qry = $this->db->where('id',$id)->get('smoad_users')->result();
    $username = $username_qry[0]->username;
    
    $qry = $this->db->query("select id, access_type, username, device_serialnumber, auth_status, access_timestamp, id_rand_key from 
	smoad_user_device_access_log where username='$username' order by id desc limit 50");

    return $qry->result();
   }

}

?>
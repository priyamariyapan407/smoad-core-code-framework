<?php

class Ims_model extends CI_Model {


    function get_smoad_ticketing_servers(){
      return $this->db->get('smoad_ticketing_servers')->result();
    }
    
   function add_smoad_ticketing_server($data) {

        if($this->db->insert('smoad_ticketing_servers',$data)){
            return true;
        } else {
            return false;
        }

   }

   function delete_server($id){

    if($this->db->delete('smoad_ticketing_servers',['id'=>$id])){
      return true;
    } else {
        return false;
    }
    
   }

   function get_ims_info($id){
       return $this->db->where('id',$id)->get('smoad_ticketing_servers')->result();
   }

   function updateIms($data,$id) {

    $this->db->where('id',$id)->update('smoad_ticketing_servers',$data);
    return $this->db->get('smoad_ticketing_servers')->result();
   }

   function getAlertsInfo()
   {
     return $this->db->get('smoad_alerts')->result();
   }
 
   function getAlertsCount()
   {
     return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
   }

}

?>
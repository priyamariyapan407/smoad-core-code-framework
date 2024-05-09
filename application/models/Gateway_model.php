<?php

class Gateway_model extends CI_Model {


    function get_smoad_servers(){

      $servers = $this->db->order_by('id','desc')->get('smoad_sdwan_servers')->result();
      $all_servers = array();

      foreach($servers as $server){
        $data['id'] = $server->id;
        $data['details'] = $server->details;
        $data['license'] = $server->license;
        $data['serialnumber'] = $server->serialnumber;
        $data['ipaddr'] = $server->ipaddr;
        $data['type'] = $server->type;
        $data['area'] = $server->area;
        $data['status'] = $server->status;
        $count_qry = $this->db->query("select count(*) as assigned_devices from smoad_devices WHERE sdwan_server_id='$server->id'");
        $count = $count_qry->result();
        $data['assigned_devices'] = $count[0]->assigned_devices;
        array_push($all_servers,$data);
      }

       return $all_servers;

    }

    public function circuitSummary()
    {
        $query = $this->db->query(" select * from smoad_sdwan_servers");
        //return $query->result();

        $sdwan_results = $query->result();

        $sdwan_data = array();

        foreach ($sdwan_results as $sdwan_result) {
            $peer_qry = $this->db->query("select count(*) as total_cnt,sum( CASE when sdwan_link_status='UP' THEN 1 ELSE 0 END) as up_count, sum(CASE WHEN sdwan_link_status='DOWN' THEN 1 ELSE 0 END) as down_count from smoad_sds_wg_peers where serialnumber='$sdwan_result->serialnumber'");

            $peer_qry_result = $peer_qry->result();

            array_push($sdwan_data, ['serialnumber' => $sdwan_result->serialnumber, 'ipaddr' => $sdwan_result->ipaddr, 'details' => $sdwan_result->details, 'total_cnt' => $peer_qry_result[0]->total_cnt, 'up_count' => $peer_qry_result[0]->up_count, 'down_count' => $peer_qry_result[0]->down_count]);

        }

        return $sdwan_data;

    }
    
   function save_server($data) {

       $existing_serialnumber = $this->db->get('smoad_sdwan_servers')->result();
       foreach($existing_serialnumber as $serialnumber){
        if($serialnumber->serialnumber == $data['serialnumber']){
            return "exists";
        }
       }

        if($this->db->insert('smoad_sdwan_servers',$data)){
            return "true";
        } else {
            return "false";
        }

   }

   function save_vlan($data) {

    $existing_vlan_id = $this->db->get('smoad_sdwan_server_vlans')->result();
    foreach($existing_vlan_id as $vlan_id){
     if($vlan_id->vlan_id == $data['vlan_id']){
         return "exists";
     }
    }

     if($this->db->insert('smoad_sdwan_server_vlans',$data)){
         return "true";
     } else {
         return "false";
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
   

   function delete_server($id){

    if($this->db->delete('smoad_sdwan_servers',['id'=>$id])){
      return true;
    } else {
        return false;
    }
    
   }


   function delete_vlan($id){

    if($this->db->delete('smoad_sdwan_server_vlans',['id'=>$id])){
      return true;
    } else {
        return false;
    }
    
   }


   function delete_job($id){
    if($this->db->delete('smoad_sdwan_server_jobs',['sds_serialnumber'=>$id])){
      return true;
    } else {
      return false;
    }
   }
   

   function get_server_info($id){
       return $this->db->where('id',$id)->get('smoad_sdwan_servers')->result();
   }

   function update_server($data,$id) {
    $this->db->where('id',$id);
    $this->db->update('smoad_sdwan_servers',$data);
  //  return $this->db->get('smoad_sdwan_servers')->result();
   }

   function update_vlan($data,$id) {
    $this->db->where('id',$id);
    $this->db->update('smoad_sdwan_server_vlans',$data);
  //  return $this->db->get('smoad_sdwan_servers')->result();
   }

   


   function getGatewayDevices($id){
     $all_info['server'] = $this->db->where('id',$id)->get('smoad_sdwan_servers')->result();
     $all_info['notset_devices'] = $this->db->where('sdwan_server_id',NULL)->get('smoad_devices')->result();
     $all_info['assigned_devices'] = $this->db->where('sdwan_server_id',$id)->get('smoad_devices')->result();
     return $all_info;
   }

   function set_device($device_id,$server_id,$status,$sdwan_proto){
    
    if($status == 'assign'){
       $data['sdwan_server_id']=$server_id;
       $data['sdwan_proto']=$sdwan_proto;
       $data['vlan_id']=0;
       $data['sdwan_enable']='FALSE';
       $this->db->where('id',$device_id)->update('smoad_devices',$data);
       return 'assigned';
    }

    if($status == 'unassign'){
        $data['sdwan_server_id']= NULL;
        $data['sdwan_proto']= 'notset';
        $data['vlan_id']=0;
        $data['sdwan_enable']='FALSE';
        $this->db->where('id',$device_id)->update('smoad_devices',$data);
        return 'unassigned';
     }
    
   }


   function getGatewayNetwork($serialnumber){
        return $this->db->where('serialnumber',$serialnumber)->get('smoad_sds_wg_peers')->result();
   }

   function getVlanInfo($id) {
    return $this->db->where('id_smoad_sdwan_servers',$id)->get('smoad_sdwan_server_vlans')->result();
   }

   function getVlanIdInfo($id) {
    return $this->db->where('id',$id)->get('smoad_sdwan_server_vlans')->result();
   }

   function get_job_info($serialnumber){
    return $this->db->query("select count(*) as quantity from smoad_sdwan_server_jobs where sds_serialnumber='$serialnumber'")->result();
   }

   function get_server_job_info($serialnumber){
    return $this->db->where("device_serialnumber",$serialnumber)->get('smoad_server_jobs')->result();
   }

   function getCircuitInfo($sno){
    return $this->db->query("select sum(case when serialnumber='$sno' then 1 else 0 end) as total_circuits, sum(case when serialnumber='$sno' and sdwan_link_status='UP' then 1 else 0 end) as up_count,sum(case when serialnumber ='$sno' and sdwan_link_status='DOWN' then 1 else 0 end) as down_count from smoad_sds_wg_peers")->result();
   }


   function get_server_info_by_serial_number($sno){
    return $this->db->where('serialnumber',$sno)->get('smoad_sdwan_servers')->result();
   }

   function get_peer_info($id){
    return $this->db->where('id',$id)->get('smoad_sds_wg_peers')->result();
   }
   
   function ztp_sds_dev_cfg($edge_serialnumber,$gateway_serialnumber){

     $all_info = array();
     $device_info =  $this->db->where('serialnumber',$edge_serialnumber)->get('smoad_devices')->result();
     $all_info['device_info'] = $device_info;

     $sdwan_server_info = $this->db->where('serialnumber',$gateway_serialnumber)->get('smoad_sdwan_servers')->result(); 
     $all_info['sdwan_server_info']= $sdwan_server_info ? $sdwan_server_info : [];
     $sdwan_server_id = '';

     foreach($sdwan_server_info as $info){
      $sdwan_server_id = $info->id ? $info->id : '';
     }

     if($sdwan_server_id != ''){

      $device_info_with_sdwan_id =  $this->db->where('serialnumber',$edge_serialnumber)->where('sdwan_server_id',$sdwan_server_id)->get('smoad_devices')->result();
      $all_info['device_info_with_sdwan_id']=$device_info_with_sdwan_id;
     
      $vlan_info =  $this->db->where('id_smoad_sdwan_servers',$sdwan_server_id)->get('smoad_sdwan_server_vlans')->result();
      $all_info['vlan_info']=$vlan_info;
     
    } else {

      $all_info['device_info_with_sdwan_id']= [];
      $all_info['vlan_info']= [];

    }

    return $all_info;
    
  }

  function sm_ztp_sds_add_job($sno,$job){
    $data['sds_serialnumber'] = $sno;
    $data['job'] = $job;
    if($this->db->insert('smoad_sdwan_server_jobs',$data)){
      return "true";
    } else {
      return "false";
    }
  }

  function save_ztp_sds_dev_cfg($id,$data){

    if($this->db->where('id',$id)->update('smoad_devices',$data)){
      return true;
    } else {
      return false;
    }
    
  }

}

?>
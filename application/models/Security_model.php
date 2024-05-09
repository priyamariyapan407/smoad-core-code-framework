<?php

class Security_model extends CI_Model
{


    function get_rules()
    {
        return $this->db->order_by('id', 'asc')->get('smoad_fw_rules')->result();
    }

    function get_ip_list()
    {
        return $this->db->order_by('id', 'acs')->get('smoad_fw_ip_list')->result();
    }

    function getAlertsInfo()
    {
      return $this->db->get('smoad_alerts')->result();
    }
  
    function getAlertsCount()
    {
      return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
    }

    function save_rule($data)
    {

        $len = strlen($data['src_port']);
        $conv = base_convert($data['src_port'], 10, 16);
        if ($len == 2) {
            $conv = "00" . $conv;
        } else if ($len == 3) {
            $conv = "0" . $conv;
        } else {
            $conv = "0000";
        }
        $data['src_port'] == $conv;



        $len = strlen($data['dst_port']);
        $conv = base_convert($data['dst_port'], 10, 16);
        if ($len == 2) {
            $conv = "00" . $conv;
        } else if ($len == 3) {
            $conv = "0" . $conv;
        } else {
            $conv = "0000";
        }
        $data['dst_port'] == $conv;



        $id_rand_key = bin2hex(random_bytes(6));
        $data['id_rand_key'] = $id_rand_key;
        //return $data;
        if ($this->db->insert('smoad_fw_rules', $data)) {
            $newly_generate_id = $this->db->insert_id();
            $port = $data['port'];
            $src_mac = $data['src_mac'];
            $dst_mac = $data['dst_mac'];
            $src_ip = $data['src_ip'];
            $dst_ip = $data['dst_ip'];
            $proto = $data['proto'];
            $src_port = $data['src_port'];
            $dst_port = $data['dst_port'];
            $action = $data['action'];
            $description = $data['description'];
            $cmd = "add,$newly_generate_id,$port,$src_mac,$dst_mac,$src_ip,$dst_ip,$proto,$src_port,$dst_port,$action,$description";
            $kernel_cmd = "echo \"$cmd\" > /proc/smoad_fw_rules";
            $job['job'] = $kernel_cmd;
            $this->db->insert('smoad_jobs', $job);
            return true;
        } else {
            return false;
        }

    }

    function delete_rule($id)
    {

        $smoad_fw_rules = $this->db->where('id', $id)->get('smoad_fw_rules')->result();
        $cmd = '';
        foreach ($smoad_fw_rules as $rule) {

            if ($rule->action == "allow") {
                $_action = "ALLOW";
                $bg_style = "color:#2981e4;font-weight:bold;\"";
            } else if ($rule->action == "monitor") {
                $_action = "MONITOR";
                $bg_style = "color:#4d916a;font-weight:bold;\"";
            } else if ($rule->action == "drop") {
                $_action = "DROP";
                $bg_style = "color:#D84430;font-weight:bold;\"";
            }

            if ($rule->proto == "6") {
                $_proto = "TCP";
            } else if ($rule->proto == "17") {
                $_proto = "UDP";
            } else if ($rule->proto == "1") {
                $_proto = "ICMP";
            } else if ($rule->proto == "*") {
                $_proto = "ANY";
            }

            $cmd = "del,$rule->id,$rule->port,$rule->src_mac,$rule->dst_mac,$rule->src_ip,$rule->dst_ip,$_proto,$rule->src_port,$rule->dst_port,$_action,$rule->description";

        }

        $kernel_cmd = "echo \"$cmd\" > /proc/smoad_fw_rules";

        $data['job'] = $kernel_cmd;

        $this->db->insert('smoad_jobs', $data);

        if ($this->db->delete('smoad_fw_rules', ['id' => $id])) {
            return true;
        } else {
            return false;
        }

    }

    function save_ip($data)
    {
        if ($this->db->insert('smoad_fw_ip_list', $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_ip($id)
    {

        if ($this->db->delete('smoad_fw_ip_list', ['id' => $id])) {
            return true;
        } else {
            return false;
        }

    }

    function get_log_index()
    {

        $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
        $yearcurrent = date("Y");
        $date_array = array();

        for ($y = $yearcurrent; $y >= 2022; $y--) {
            $monthcurrent = date('m');
            $data['year'] = $y;
            $data['month_info'] = array();
            for ($m = 1; $m <= 12; $m++) {
                $mname = $mons[$m];
                $enable_link = false;
                $_m = sprintf("%02d", $m); //month in 01,02 format
                $current_date = $y . "-" . $_m . "-01";
                $log_count = $this->db->query("select count(*) as row_count FROM smoad_fw_log WHERE year(log_timestamp) = $y and month(log_timestamp) = $_m")->result();

                foreach ($log_count as $count) {
                    $row_count = $count->row_count;
                }

                for ($i = 0; $i < $row_count; $i++) {
                    $month_info['month'] = $_m;
                    $month_info['month_name'] = $mname;
                    $month_info['current_date'] = $current_date;

                    array_push($data['month_info'], $month_info);
                }

                //   $data['month_info'] = array_unique($data['month_info']);

            }

            array_push($date_array, $data);
        }

        return $date_array;

    }

    function get_month_info($date)
    {

        $split_info = explode('-', $date);
        $year = $split_info[0];
        $month = $split_info[1];

        return $this->db->where('year(log_timestamp)', $year)->where('month(log_timestamp)', $month)->order_by('id', 'desc')->get('smoad_fw_log')->result();
    }

    function delete_month($id)
    {
        if ($this->db->delete('smoad_fw_log', ['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }


    function get_packet_drops()
    {
        return $this->db->query("SELECT DATE_FORMAT(log_timestamp, '%H:%i') log_timestamp, pkt_count FROM smoad_fw_log
        WHERE action='drop' and log_timestamp>=DATE_SUB(NOW(),INTERVAL 24 HOUR)")->result();
    }

    function get_content_firewall_data()
    {
        return $this->db->query("select sum(CASE WHEN (action='drop' and type='user' and log_timestamp>=DATE_SUB(NOW(),INTERVAL 24 HOUR)) THEN 1 ELSE 0 END) as user_packet_cnt, sum(CASE WHEN (action='drop' and type='ips' and log_timestamp>=DATE_SUB(NOW(),INTERVAL 24 HOUR)) THEN 1 ELSE 0 END) as type_packet_cnt from smoad_fw_log")->result();
    }

    function get_ip_track()
    {
        return $this->db->query("SELECT COUNT(src_ip) as src_ip_cnt,src_ip FROM smoad_fw_log WHERE action='drop' and log_timestamp>=DATE_SUB(NOW(),INTERVAL 24 HOUR) GROUP BY src_ip")->result();
    }

    //    function get_user_info($id){
//        return $this->db->where('id',$id)->get('smoad_users')->result();
//    }

    //    function update_user($data,$id) {

    //     $this->db->where('id',$id);
//     $this->db->update('smoad_users',$data);
//     return $this->db->get('smoad_users')->result();
//    }


    //    function getUserHistory($id){
//     $username_qry = $this->db->where('id',$id)->get('smoad_users')->result();
//     $username = $username_qry[0]->username;

    //     $qry = $this->db->query("select id, access_type, username, device_serialnumber, auth_status, access_timestamp, id_rand_key from 
// 	smoad_user_device_access_log where username='$username' order by id desc limit 50");

    //     return $qry->result();
//    }

}

?>
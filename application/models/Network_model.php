<?php

class Network_model extends CI_Model
{


    function getPortData($type)
    {
        return $this->db->where('type', $type)->get('smoad_port_cfg')->result();
    }


    function getPortInfo($id)
    {
        return $this->db->where('id', $id)->get('smoad_port_cfg')->result();
    }

    function getAlertsInfo()
    {
      return $this->db->get('smoad_alerts')->result();
    }
  
    function getAlertsCount()
    {
      return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
    }

    function api_ubuntu_server_set_port_ip_mask_gw($data)
    {

        $port = $data['port'];
        $proto = $data['proto'];
        $ip = $data['ipaddr'];
        $mask = $data['netmask'];
        $gw = $data['gateway'];
        if ($proto == 'dhcp') {
            $command = "sudo netplan set network.ethernets." . $port . ".dhcp4=true";
            $query = "insert into smoad_jobs (job) values (\"$command\")";


            $this->db->query($query);

            $command = "sudo netplan apply";
            $query = "insert into smoad_jobs (job) values (\"$command\")";

            $this->db->query($query);

            $query = "update smoad_port_cfg set ipaddr=\"0.0.0.0\", netmask=\"0.0.0.0\", gateway=\"0.0.0.0\" where port = \"$port\"";

            $this->db->query($query);
            
        } else if ($proto == 'static') {
            if ($ip == null || $mask == null) {
                return false;
            }

            $dq = explode(".", $mask);
            for ($i = 0; $i < 4; $i++) {
                $bin[$i] = str_pad(decbin($dq[$i]), 8, "0", STR_PAD_LEFT);
            }
            $bin = implode("", $bin);
            $cidr = strlen(rtrim($bin, "0"));

            $command = "sudo netplan set network.ethernets." . $port . ".addresses=[" . $ip . "/" . $cidr . "]";
            $query = "insert into smoad_jobs (job) values (\"$command\")";
            $this->db->query($query);

            if ($gw == null || $gw == "") {
                $command = "sudo netplan set network.ethernets." . $port . ".gateway4=";
                $query = "insert into smoad_jobs (job) values (\"$command\")";
                $this->db->query($query);

                $query = "update smoad_port_cfg set gateway=\"$gw\" where port = \"$port\"";
                $this->db->query($query);
            } else {
                $command = "sudo netplan set network.ethernets." . $port . ".gateway4=$gw";
                $query = "insert into smoad_jobs (job) values (\"$command\")";
                $this->db->query($query);

                $query = "update smoad_port_cfg set gateway=\"$gw\" where port = \"$port\"";
                $this->db->query($query);
            }

            $command = "sudo netplan set network.ethernets." . $port . ".dhcp4=false";
            $query = "insert into smoad_jobs (job) values (\"$command\")";
            $this->db->query($query);

            $command = "sudo netplan apply";
            $query = "insert into smoad_jobs (job) values (\"$command\")";
            $this->db->query($query);

            $query = "update smoad_port_cfg set ipaddr=\"$ip\", netmask=\"$mask\" where port = \"$port\"";
            $this->db->query($query);
        }
    }

    function save_proto($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('smoad_port_cfg', $data);
    }

}

?>
<?php

class Edge_model extends CI_Model
{

    public function get_smoad_devices()
    {

        $devices = $this->db->order_by('id', 'desc')->get('smoad_devices')->result();

        $devices_info = array();

        foreach ($devices as $device) {
            $data['id']              = $device->id;
            $data['details']         = $device->details;
            $data['license']         = $device->license;
            $data['serialnumber']    = $device->serialnumber;
            $data['status']          = $device->status;
            $data['sdwan_server_id'] = $device->sdwan_server_id;
            $model                   = $device->model;
            if ($model == "spider") {
                $_model = "Spider";
            } elseif ($model == "spider2") {
                $_model = "Spider2";
            } elseif ($model == "beetle") {
                $_model = "Beetle";
            } elseif ($model == "bumblebee") {
                $_model = "BumbleBee";
            } elseif ($model == "wasp1") {
                $_model = "Wasp1";
            } elseif ($model == "wasp2") {
                $_model = "Wasp2";
            } elseif ($model == "vm") {
                $_model = "VM";
            } elseif ($model == "soft_client") {
                $_model = "Soft-client";
            } else {
                $_model = '';
            }

            $data['model'] = $_model ? $_model : '';
            $model_variant = $device->model_variant;
            if ($model_variant == "l2") {
                $_model_variant = "L2 SD-WAN";
            } elseif ($model_variant == "l2w1l2") {
                $_model_variant = "L2 SD-WAN (L2W1L2)";
            } elseif ($model_variant == "l3") {
                $_model_variant = "L3 SD-WAN";
            } elseif ($model_variant == "mptcp") {
                $_model_variant = "MPTCP";
            } else {
                $_model_variant = '';
            }

            $data['model_variant'] = $_model_variant ? $_model_variant : '';
            $data['area']          = $device->area;
            // $data['sdwan_server_ipaddr'] = $device->sdwan_server_ipaddr;
            // $data['vlan_id'] = $device->vlan_id;
            // $data['enable'] = $device->enable;
            // $data['updated'] = $device->updated;
            $data['server_details'] = '';
            $data['server_id']      = '';
            $data['server_sno']     = '';
            $server_details         = $this->db->where('id', $device->sdwan_server_id)->get('smoad_sdwan_servers')->result();
            $get_port_color_qry     = $this->db->query("select ( CASE when (wan_link_status='up' or wan2_link_status='up' or wan3_link_status='up')
            and (lte1_link_status='down' or lte1_link_status='notset')
            and (lte2_link_status='down' or lte2_link_status='notset')
            and (lte3_link_status='down' or lte3_link_status='notset')  THEN 'true' ELSE 'false' END) as wan_up, ( CASE when (lte1_link_status='up' or lte2_link_status='up' or lte3_link_status='up')
            and (wan_link_status='down' or wan_link_status='notset')
            and (wan2_link_status='down' or wan2_link_status='notset')
            and (wan3_link_status='down' or wan3_link_status='notset')  THEN 'true' ELSE 'false' END) as lte_up,
   (CASE when (wan_link_status='up' or wan2_link_status='up' or wan3_link_status='up')
            and (lte1_link_status='up' or lte2_link_status='up' or lte3_link_status='up') THEN 'true' ELSE 'false' END) as wan_lte_up,
   (CASE when (wan_link_status='down' or wan_link_status='notset')
            and (wan2_link_status='down' or wan2_link_status='notset')
            and (wan3_link_status='down' or wan3_link_status='notset')
            and (lte1_link_status='down' or lte1_link_status='notset')
            and (lte2_link_status='down' or lte2_link_status='notset')
            and (lte3_link_status='down' or lte3_link_status='notset') THEN 'true' ELSE 'false' END) as wan_lte_down
FROM smoad_device_network_cfg where
device_serialnumber= '$device->serialnumber'")->result();

            foreach ($get_port_color_qry as $port_color) {
                $data['wan_up']       = $port_color->wan_up;
                $data['lte_up']       = $port_color->lte_up;
                $data['wan_lte_up']   = $port_color->wan_lte_up;
                $data['wan_lte_down'] = $port_color->wan_lte_down;
            }

            foreach ($server_details as $details) {
                $data['server_details'] = $details->details ? $details->details : '';
                $data['server_id']      = $details->id ? $details->id : '';
                $data['server_sno']     = $details->serialnumber ? $details->serialnumber : '';
            }
            array_push($devices_info, $data);

        }

        return $devices_info;
    }

    public function get_dev_config_templates()
    {
        $where_clause = $where_clause_customer = null;
        if ($this->session->userdata('accesslevel') == 'customer') {$where_clause_customer = " customer_id = $id_customer ";}
        //  if($_search_serialnumber!=null) { $where_clause_search_serialnumber=" serialnumber = \"$_search_serialnumber\" "; }

        if ($where_clause_customer != null) {if ($where_clause == null) {$where_clause = " where ";} //first where
            $where_clause .= $where_clause_customer;}

        return $this->db->query("select id, template_details, details, model, model_variant, area, vlan_id, enable
        from smoad_device_templates $where_clause order by id desc")->result();
    }

    public function get_dev_config_templates_cnt()
    {
        $where_clause = $where_clause_customer = null;
        if ($this->session->userdata('accesslevel') == 'customer') {$where_clause_customer = " customer_id = $id_customer ";}
        //  if($_search_serialnumber!=null) { $where_clause_search_serialnumber=" serialnumber = \"$_search_serialnumber\" "; }

        if ($where_clause_customer != null) {if ($where_clause == null) {$where_clause = " where ";} //first where
            $where_clause .= $where_clause_customer;}
        return $this->db->query("select count(*) as total_items
        from smoad_device_templates $where_clause order by id desc")->result();
    }

    public function get_firmware_server()
    {
        return $this->db->where('id', 1)->get('smoad_update_firmware_server')->result();
    }

    public function save_edge($data)
    {

        if ($this->db->insert('smoad_devices', $data)) {
            $cfg['device_serialnumber'] = $data['serialnumber'];
            $this->db->insert('smoad_device_network_cfg', $cfg);
            return "true";
        } else {
            return "false";
        }

    }

    public function save_firmware_info($data)
    {
        if ($this->db->where('id', 1)->update('smoad_update_firmware_server', $data)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function sno_existance_check($sno)
    {
        $existing_serialnumber = $this->db->get('smoad_devices')->result();
        foreach ($existing_serialnumber as $serialnumber) {
            if ($serialnumber->serialnumber == $sno) {
                return "exists";
            }
        }
    }

    public function save_vlan($data)
    {

        $existing_vlan_id = $this->db->get('smoad_sdwan_server_vlans')->result();
        foreach ($existing_vlan_id as $vlan_id) {
            if ($vlan_id->vlan_id == $data['vlan_id']) {
                return "exists";
            }
        }

        if ($this->db->insert('smoad_sdwan_server_vlans', $data)) {
            return "true";
        } else {
            return "false";
        }

    }

    public function delete_edge($id)
    {

        if ($this->db->delete('smoad_devices', ['id' => $id])) {
            return true;
        } else {
            return false;
        }

    }

    public function delete_firewall_log($id)
    {

        if ($this->db->delete('smoad_device_fw_stats_log', ['id' => $id])) {
            return 'true';
        } else {
            return 'false';
        }

    }

    public function delete_template($id)
    {
        if ($this->db->delete('smoad_device_templates', ['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_vlan($id)
    {

        if ($this->db->delete('smoad_sdwan_server_vlans', ['id' => $id])) {
            return true;
        } else {
            return false;
        }

    }

    public function delete_job($id)
    {
        if ($this->db->delete('smoad_sdwan_server_jobs', ['sds_serialnumber' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    public function get_edge_info($id)
    {
        $device_info = array();
        $devices     = $this->db->where('id', $id)->get('smoad_devices')->result();
        foreach ($devices as $device) {
            $data['id']                  = $device->id;
            $data['serialnumber']        = $device->serialnumber;
            $data['license']             = $device->license;
            $data['details']             = $device->details;
            $data['area']                = $device->area;
            $data['model']               = $device->model;
            $data['model_variant']       = $device->model_variant;
            $data['firmware']            = $device->firmware;
            $data['uptime']              = $device->uptime;
            $data['root_password']       = $device->root_password;
            $data['superadmin_password'] = $device->superadmin_password;
            $data['os']                  = $device->os;
            $data['boot_up_count']       = '';
            $bootup_time_cnt_24hrs       = $this->db->query("select sum(boot_up_count) as boot_up_count from smoad_device_status_log where device_serialnumber='$device->serialnumber' and log_timestamp > (NOW() - interval 24 hour)")->result();
            foreach ($bootup_time_cnt_24hrs as $count) {
                $data['boot_up_count'] = $count->boot_up_count;
            }
            $data['boot_up_count_timestamp'] = '';
            $bootup_time_cnt                 = $this->db->query("SELECT log_timestamp boot_up_count_timestamp FROM smoad_device_status_log
				where device_serialnumber='$device->serialnumber' and boot_up_count = 1 order by id desc limit 1")->result();
            foreach ($bootup_time_cnt as $count) {
                $data['boot_up_count_timestamp'] = $count->boot_up_count_timestamp ? $count->boot_up_count_timestamp : '';
            }
            $sdwan_server_status     = "down";
            $smoad_sdwan_servers     = $this->db->where('id', $device->sdwan_server_id)->get('smoad_sdwan_servers')->result();
            $data['gateway_details'] = '';
            foreach ($smoad_sdwan_servers as $smoad_sdwan_server) {
                $data['gateway_details'] = $smoad_sdwan_server->details;
                $sdwan_server_status     = $smoad_sdwan_server->status;
            }

            $smoad_customers        = $this->db->where('id', $device->customer_id)->get('smoad_customers')->result();
            $data['smoad_customer'] = '';
            foreach ($smoad_customers as $smoad_customer) {
                $data['smoad_customer'] = $smoad_customer->custname;
            }

            $sdwan_proto     = $device->sdwan_proto;
            $help            = "";
            $provision_ready = false;
            if ($sdwan_proto == 'wg') {
                $wg_peers = false;

                $smoad_sds_wg_peers = $this->db->where('device_serialnumber', $device->serialnumber)->get('smoad_sds_wg_peers')->result();
                foreach ($smoad_sds_wg_peers as $smoad_sds_wg_peer) {
                    $sdwan_server_serialnumber = $smoad_sds_wg_peer->serialnumber;
                    $wg_peers                  = true;
                }
                if ($wg_peers == true) {
                    $help .= "WG peer configured\n";
                } else {
                    $help .= "no WG peer configured\n";
                }

                if ($sdwan_server_status == "up") {
                    $help .= "GW is up\n";
                } else {
                    $help .= "GW is down\n";
                }

                if ($wg_peers == true && $sdwan_server_status == "up") {
                    $provision_ready = true;
                }
            } else {
                $provision_ready = true;
                $help .= "no GW assigned\n";
            }

            if ($provision_ready == true) {
                $data['provision_ready'] = true;
            } else {
                $data['provision_ready'] = false;
            }

            $data['provision_value'] = $help;
            array_push($device_info, $data);
        }
        return $device_info;
    }
    public function getAlertsInfo()
    {
        return $this->db->get('smoad_alerts')->result();
    }

    public function getAlertsCount()
    {
        return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
    }
    public function update_edge($data, $id)
    {
        if ($this->db->where('id', $id)->update('smoad_devices', $data)) {
            return 'true';
        } else {
            return 'false';
        }
        //  return $this->db->get('smoad_sdwan_servers')->result();
    }

    public function update_vlan($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('smoad_sdwan_server_vlans', $data);
        //  return $this->db->get('smoad_sdwan_servers')->result();
    }

    public function getGatewayNetwork($serialnumber)
    {
        return $this->db->where('serialnumber', $serialnumber)->get('smoad_sds_wg_peers')->result();
    }

    public function getVlanInfo($id)
    {
        return $this->db->where('id_smoad_sdwan_servers', $id)->get('smoad_sdwan_server_vlans')->result();
    }

    public function getVlanIdInfo($id)
    {
        return $this->db->where('id', $id)->get('smoad_sdwan_server_vlans')->result();
    }

    public function get_job_info($serialnumber)
    {
        return $this->db->query("select count(*) as quantity from smoad_sdwan_server_jobs where sds_serialnumber='$serialnumber'")->result();
    }

    public function get_server_job_info($serialnumber)
    {
        return $this->db->where("device_serialnumber", $serialnumber)->get('smoad_server_jobs')->result();
    }

    public function getCircuitInfo($sno)
    {
        return $this->db->query("select sum(case when serialnumber='$sno' then 1 else 0 end) as total_circuits, sum(case when serialnumber='$sno' and sdwan_link_status='UP' then 1 else 0 end) as up_count,sum(case when serialnumber ='$sno' and sdwan_link_status='DOWN' then 1 else 0 end) as down_count from smoad_sds_wg_peers")->result();
    }

    public function get_server_info_by_serial_number($sno)
    {
        return $this->db->where('serialnumber', $sno)->get('smoad_sdwan_servers')->result();
    }

    public function get_peer_info($id)
    {
        return $this->db->where('id', $id)->get('smoad_sds_wg_peers')->result();
    }

    public function reboot($sno, $job)
    {
        $data['job']                 = $job;
        $data['device_serialnumber'] = $sno;
        if ($this->db->insert('smoad_device_jobs', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function reprovision($id, $sno)
    {
        $device_info = $this->db->where('id', $id)->get('smoad_devices')->result();
        foreach ($device_info as $info) {
            $id                  = $info->id;
            $details             = $info->details;
            $license             = $info->license;
            $serialnumber        = $info->serialnumber;
            $model_variant       = $info->model_variant;
            $root_password       = $info->root_password;
            $superadmin_password = $info->superadmin_password;
            $sdwan_server_ipaddr = $info->sdwan_server_ipaddr;
            $sdwan_server_id     = $info->sdwan_server_id;
            $sdwan_proto         = $info->sdwan_proto;
            $output_script       = "uci set smoad.device.details=\"$details\"\n";
            $output_script .= "uci set smoad.device.serial=\"$serialnumber\"\n";
            $output_script .= "uci set smoad.device.license=\"$license\"\n";
            $output_script .= "uci set smoad.device.gw_server=\"$sdwan_server_ipaddr\"\n";
            $output_script .= "uci set smoad.device.sdwan_proto=\"$sdwan_proto\"\n";
            $output_script .= "uci set smoad.device.wg=\"0\"\n"; //disable initially wg
            $output_script .= "uci set network.wg0.addresses=\"0.0.0.0/0\"\n";
            $output_script .= "uci set network.wg0.private_key=\"notset\"\n";              //device prikey
            $output_script .= "uci set network.@wireguard_wg0[0].public_key=\"notset\"\n"; //server pubkey
            if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                $output_script .= "uci set network.vxlan0.peeraddr=\"0.0.0.0\"\n";
            }
            $output_script .= "uci set smoad.device.wgaddresses=\"0.0.0.0\"\n";
            if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                $output_script .= "uci set network.vxlan0.vid=\"0\"\n";
            }
            $output_script .= "uci set smoad.login.superadmin_pass=\"$superadmin_password\"\n";
            $output_script .= "uci commit network\n";
            $output_script .= "uci commit smoad\n";
            $output_script .= "uci commit\n";
            $output_script .= "ifup wg0\n";
            $output_script .= "echo -e \"" . $root_password . "\\n" . $root_password . "\" | passwd root > /dev/null\n";
            if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                $output_script .= "ifup vxlan0\n";
            }
        }

        if ($sdwan_server_id != null && $sdwan_server_id != "notset") {
            if ($sdwan_proto == "wg") {
                $output_script .= "uci set network.@wireguard_wg0[0].endpoint_host=\"$sdwan_server_id\"\n";
                $output_script .= "uci set smoad.device.wg=\"1\"\n"; //enable wg

                $smoad_servers = $this->db->where('sdwan_server_id', $sdwan_server_id)->get('smoad_sdwan_servers')->result();
                foreach ($smoad_servers as $servers) {
                    $gw_server_serialnumber = $servers->serialnumber;
                    $gw_server_pubkey       = $servers->pubkey;
                    $gw_server_wg_address   = $servers->address;
                    $gw_server_mtu          = $servers->mtu;
                }

                $smoad_sds_peers_info = $this->db->where('serialnumber', $gw_server_serialnumber)->where('device_serialnumber'->$serialnumber)->get('smoad_sds_wg_peers')->result();
                foreach ($smoad_sds_peers_info as $info) {

                    $id              = $info->id;
                    $port            = $info->port;
                    $details         = $info->details;
                    $license         = $info->license;
                    $serialnumber    = $info->serialnumber;
                    $pubkey          = $info->pubkey;
                    $prikey          = $info->prikey;
                    $allowedipsubnet = $info->allowedipsubnet;
                    $vxlan_id        = $info->vxlan_id;
                    $status          = $info->status;
                    $enable          = $info->enable;
                    $updated         = $info->updated;

                    $allowedipsubnet = str_replace("/32", "/16", $allowedipsubnet);
                    $output_script .= "uci set network.wg0.addresses=\"$allowedipsubnet\"\n";
                    $output_script .= "uci set network.wg0.private_key=\"$prikey\"\n";                        //device prikey
                    $output_script .= "uci set network.@wireguard_wg0[0].public_key=\"$gw_server_pubkey\"\n"; //server pubkey

                    $temp                 = explode("/", $gw_server_wg_address);
                    $gw_server_wg_address = $temp[0];
                    if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                        $output_script .= "uci set network.vxlan0.peeraddr=\"$gw_server_wg_address\"\n";
                    }
                    $output_script .= "uci set smoad.device.wgaddresses=\"$allowedipsubnet\"\n";
                    $output_script .= "uci set smoad.device.sdwan_mtu=\"$gw_server_mtu\"\n";
                    if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                        $output_script .= "uci set network.vxlan0.vid=\"$vxlan_id\"\n";
                    }
                    $output_script .= "uci commit network\n";
                    $output_script .= "uci commit smoad\n";
                    $output_script .= "uci commit\n";
                    $output_script .= "ifup wg0\n";
                    if ($model_variant == "l2" || $model_variant == "l2w1l2") {
                        $output_script .= "ifup vxlan0\n";
                    }
                }

            }
        }

        $lines = explode("\n", $output_script);
        foreach ($lines as $line) {
            $line                        = chop($line);
            $data['job']                 = $line;
            $data['device_serialnumber'] = $sno;
            if ($this->db->insert('smoad_device_jobs', $data)) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function networkcfg($sno)
    {
        return $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
    }

    public function get24HrsStatsCount($sno)
    {

        return $this->db->query("select sum(link_status_wan_up_count) as link_status_wan_up_count, sum(link_status_wan2_up_count) as link_status_wan2_up_count, sum(link_status_sdwan_up_count) as link_status_sdwan_up_count, sum(link_status_lte1_up_count) as link_status_lte1_up_count, sum(link_status_lte2_up_count) as link_status_lte2_up_count, sum(link_status_lte3_up_count) as link_status_lte3_up_count, sum(link_status_wan3_up_count) as link_status_wan3_up_count from smoad_device_status_log where device_serialnumber='$sno' and log_timestamp > (NOW() - INTERVAL 24 HOUR)")->result();
        // return $this->db->where('device_serialnumber',$sno)->where('log_timestamp >',`(NOW() - INTERVAL 24 HOUR)`)->get('smoad_device_status_log')->result();
    }

    public function get_last_24_port_down_count($sno)
    {

        return $this->db->query("select sum(link_status_wan_down_count) as link_status_wan_down_count, sum(link_status_wan2_down_count) as link_status_wan2_down_count, sum(link_status_lte1_down_count) as link_status_lte1_down_count, sum(link_status_lte2_down_count) as link_status_lte2_down_count, sum(link_status_sdwan_down_count) as link_status_sdwan_down_count, sum(link_status_wan3_down_count) as link_status_wan3_down_count from smoad_device_status_log where device_serialnumber='$sno' and log_timestamp > (NOW() - INTERVAL 24 HOUR)")->result();
        // return $this->db->where('device_serialnumber',$sno)->where('log_timestamp >',`(NOW() - INTERVAL 24 HOUR)`)->get('smoad_device_status_log')->result();
    }

    public function getPortInfo($sno, $wanport)
    {
        $wanport_proto                = $wanport . '_proto';
        $wanport_ipaddr               = $wanport . '_ipaddr';
        $wanport_netmask              = $wanport . '_netmask';
        $wanport_gateway              = $wanport . '_gateway';
        $wanport_dns                  = $wanport . '_dns';
        $wanport_username             = $wanport . '_username';
        $wanport_password             = $wanport . '_password';
        $wanport_link_status          = $wanport . '_link_status';
        $wanport_max_bandwidth        = $wanport . '_max_bandwidth';
        $wanport_medium_bandwidth_pct = $wanport . '_medium_bandwidth_pct';
        $wanport_low_bandwidth_pct    = $wanport . '_low_bandwidth_pct';

        return $this->db->query("select id, $wanport_proto _wan_proto,
		$wanport_ipaddr _wan_ipaddr, $wanport_netmask _wan_netmask, $wanport_gateway _wan_gateway,
		$wanport_dns _wan_dns, $wanport_username _wan_username, $wanport_password _wan_password,
		$wanport_link_status _wan_link_status,
		$wanport_max_bandwidth _max_bandwidth, $wanport_medium_bandwidth_pct _medium_bandwidth_pct,
		$wanport_low_bandwidth_pct _low_bandwidth_pct
		from smoad_device_network_cfg where device_serialnumber='$sno'")->result();
    }

    public function smZtpAddJob($sno, $job)
    {
        $data['device_serialnumber'] = $sno;
        $data['job']                 = $job;
        if ($this->db->insert('smoad_device_jobs', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePortStatus($sno, $data)
    {
        if ($this->db->where('device_serialnumber', $sno)->update('smoad_device_network_cfg', $data)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_lan_data_by_sno($sno)
    {
        return $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
    }

    public function get_existing_id_info($sno)
    {
        return $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->row();
    }

    public function save_ztp_dev_lan($id, $data)
    {
        $this->db->where('id', $id)->update('smoad_device_network_cfg', $data);
    }

    public function sm_ztp_add_job($sno, $data)
    {
        $job['job']                 = $data;
        $job['device_serialnumber'] = $sno;
        if ($this->db->insert('smoad_device_jobs', $job)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_network_cfg_info($sno)
    {
        return $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
    }

    public function save_ztp_dev_wireless($id, $data)
    {

        if ($this->db->where('id', $id)->update('smoad_device_network_cfg', $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function get_device_info($sno)
    {
        $smoad_devices            = $this->db->where('serialnumber', $sno)->get('smoad_devices')->result();
        $smoad_device_network_cfg = $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
        return array('smoad_devices' => $smoad_devices, 'smoad_device_network_cfg' => $smoad_device_network_cfg);
    }

    public function save_device_info($id, $data, $table)
    {
        if ($this->db->where('id', $id)->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function api_generate_device_api_keys(&$api_prikey, &$api_pubkey)
    {

        $config = array(
            "digest_alg"       => "sha512",
            "private_key_bits" => 1024,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        // Create the private and public key
        $res = openssl_pkey_new($config);

        // Extract the private key into $private_key
        openssl_pkey_export($res, $api_prikey);

        // Extract the public key into $public_key
        $api_pubkey = openssl_pkey_get_details($res);
        $api_pubkey = $api_pubkey["key"];

        $api_prikey = bin2hex($api_prikey);
        $api_pubkey = bin2hex($api_pubkey);

    }

    public function get_consolidated_logs($sno)
    {
        $logs_array = array();
        $logs       = $this->db->where('device_serialnumber', $sno)->get('smoad_device_consolidated_stats_log')->result();
        foreach ($logs as $log) {

            $data['sum_lan_rx_bytes']   = $this->api_net_stats_get_disp($log->sum_lan_rx_bytes);
            $data['sum_lan_tx_bytes']   = $this->api_net_stats_get_disp($log->sum_lan_tx_bytes);
            $data['sum_wan1_rx_bytes']  = $this->api_net_stats_get_disp($log->sum_wan1_rx_bytes);
            $data['sum_wan1_tx_bytes']  = $this->api_net_stats_get_disp($log->sum_wan1_tx_bytes);
            $data['sum_wan2_rx_bytes']  = $this->api_net_stats_get_disp($log->sum_wan2_rx_bytes);
            $data['sum_wan2_tx_bytes']  = $this->api_net_stats_get_disp($log->sum_wan2_tx_bytes);
            $data['sum_lte1_rx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte1_rx_bytes);
            $data['sum_lte1_tx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte1_tx_bytes);
            $data['sum_lte2_rx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte2_rx_bytes);
            $data['sum_lte2_tx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte2_tx_bytes);
            $data['sum_lte3_rx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte3_rx_bytes);
            $data['sum_lte3_tx_bytes']  = $this->api_net_stats_get_disp($log->sum_lte3_tx_bytes);
            $data['sum_sdwan_rx_bytes'] = $this->api_net_stats_get_disp($log->sum_sdwan_rx_bytes);
            $data['sum_sdwan_tx_bytes'] = $this->api_net_stats_get_disp($log->sum_sdwan_tx_bytes);

            $data['avg_lan_rx_bytes_rate']   = $this->api_net_rate_stats_get_disp($log->avg_lan_rx_bytes_rate);
            $data['avg_lan_tx_bytes_rate']   = $this->api_net_rate_stats_get_disp($log->avg_lan_tx_bytes_rate);
            $data['avg_wan1_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_wan1_rx_bytes_rate);
            $data['avg_wan1_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_wan1_tx_bytes_rate);
            $data['avg_wan2_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_wan2_rx_bytes_rate);
            $data['avg_wan2_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_wan2_tx_bytes_rate);
            $data['avg_lte1_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte1_rx_bytes_rate);
            $data['avg_lte1_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte1_tx_bytes_rate);
            $data['avg_lte2_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte2_rx_bytes_rate);
            $data['avg_lte2_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte2_tx_bytes_rate);
            $data['avg_lte3_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte3_rx_bytes_rate);
            $data['avg_lte3_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->avg_lte3_tx_bytes_rate);
            $data['avg_sdwan_rx_bytes_rate'] = $this->api_net_rate_stats_get_disp($log->avg_sdwan_rx_bytes_rate);
            $data['avg_sdwan_tx_bytes_rate'] = $this->api_net_rate_stats_get_disp($log->avg_sdwan_tx_bytes_rate);

            $data['id']                             = $log->id;
            $data['avg_wan1_latency']               = $log->avg_wan1_latency;
            $data['avg_wan1_jitter']                = $log->avg_wan1_jitter;
            $data['avg_wan2_latency']               = $log->avg_wan2_latency;
            $data['avg_wan2_jitter']                = $log->avg_wan2_jitter;
            $data['avg_lte1_latency']               = $log->avg_lte1_latency;
            $data['avg_lte1_jitter']                = $log->avg_lte1_jitter;
            $data['avg_lte2_latency']               = $log->avg_lte2_latency;
            $data['avg_lte2_jitter']                = $log->avg_lte2_jitter;
            $data['avg_lte3_latency']               = $log->avg_lte3_latency;
            $data['avg_lte3_jitter']                = $log->avg_lte3_jitter;
            $data['avg_sdwan_latency']              = $log->avg_sdwan_latency;
            $data['avg_sdwan_jitter']               = $log->avg_sdwan_jitter;
            $data['sum_link_status_wan_up_count']   = $log->sum_link_status_wan_up_count;
            $data['sum_link_status_wan2_up_count']  = $log->sum_link_status_wan2_up_count;
            $data['sum_link_status_lte1_up_count']  = $log->sum_link_status_lte1_up_count;
            $data['sum_link_status_lte2_up_count']  = $log->sum_link_status_lte2_up_count;
            $data['sum_link_status_lte3_up_count']  = $log->sum_link_status_lte3_up_count;
            $data['sum_link_status_sdwan_up_count'] = $log->sum_link_status_sdwan_up_count;
            $data['timestamp']                      = $log->log_timestamp;
            array_push($logs_array, $data);
        }
        return $logs_array;
    }

    public function api_net_stats_get_disp($value)
    {
        $unit = " KB";
        if ($value > 1000000000) {
            $value = $value / 1000000000;
            $unit  = " TB";
        }
        if ($value > 1000000) {
            $value = $value / 1000000;
            $unit  = " GB";
        }
        if ($value > 1000) {
            $value = $value / 1000;
            $unit  = " MB";
        }
        $value = number_format($value, 1);
        return $value . $unit;
    }

    public function api_net_rate_stats_get_disp($value)
    {
        $unit  = " K";
        $value = $value * 8; //convert to bits
        if ($value > 1000000000) {
            $value = $value / 1000000000;
            $unit  = " T";
        }
        if ($value > 1000000) {
            $value = $value / 1000000;
            $unit  = " G";
        }
        if ($value > 1000) {
            $value = $value / 1000;
            $unit  = " M";
        }
        $value = number_format($value, 1);
        return $value . $unit . "b/s";
    }

    public function get_device_details($sno)
    {
        return $this->db->where('serialnumber', $sno)->get('smoad_devices')->result();
    }

    public function delete_log($id)
    {
        if ($this->db->delete('smoad_user_device_access_log', ['id' => $id])) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function delete_jobs($table_name)
    {
        if ($this->db->delete($table_name, [1 => 1])) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function get_ztp_dev_qos_app_prio($sno)
    {
        return $this->db->where('serialnumber', $sno)->get('smoad_devices')->result();
    }

    public function get_logs_info($page, $sno)
    {
        if ($page == 'link_status') {
            $link_status_qry = $this->db->where('device_serialnumber', $sno)->get('smoad_device_status_log')->result();
            return $link_status_qry;
        } elseif ($page == 'network_status') {
            $stats_log_array = array();
            $stats_log       = $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_stats_log')->result();
            foreach ($stats_log as $log) {
                $data['lan_rx_bytes']   = $this->api_net_stats_get_disp($log->lan_rx_bytes);
                $data['lan_tx_bytes']   = $this->api_net_stats_get_disp($log->lan_tx_bytes);
                $data['wan1_rx_bytes']  = $this->api_net_stats_get_disp($log->wan1_rx_bytes);
                $data['wan1_tx_bytes']  = $this->api_net_stats_get_disp($log->wan1_tx_bytes);
                $data['wan2_rx_bytes']  = $this->api_net_stats_get_disp($log->wan2_rx_bytes);
                $data['wan2_tx_bytes']  = $this->api_net_stats_get_disp($log->wan2_tx_bytes);
                $data['lte1_rx_bytes']  = $this->api_net_stats_get_disp($log->lte1_rx_bytes);
                $data['lte1_tx_bytes']  = $this->api_net_stats_get_disp($log->lte1_tx_bytes);
                $data['lte2_rx_bytes']  = $this->api_net_stats_get_disp($log->lte2_rx_bytes);
                $data['lte2_tx_bytes']  = $this->api_net_stats_get_disp($log->lte2_tx_bytes);
                $data['lte3_rx_bytes']  = $this->api_net_stats_get_disp($log->lte3_rx_bytes);
                $data['lte3_tx_bytes']  = $this->api_net_stats_get_disp($log->lte3_tx_bytes);
                $data['sdwan_rx_bytes'] = $this->api_net_stats_get_disp($log->sdwan_rx_bytes);
                $data['sdwan_tx_bytes'] = $this->api_net_stats_get_disp($log->sdwan_tx_bytes);

                $data['lan_rx_bytes_rate']   = $this->api_net_rate_stats_get_disp($log->lan_rx_bytes_rate);
                $data['lan_tx_bytes_rate']   = $this->api_net_rate_stats_get_disp($log->lan_tx_bytes_rate);
                $data['wan1_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->wan1_rx_bytes_rate);
                $data['wan1_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->wan1_tx_bytes_rate);
                $data['wan2_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->wan2_rx_bytes_rate);
                $data['wan2_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->wan2_tx_bytes_rate);
                $data['lte1_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte1_rx_bytes_rate);
                $data['lte1_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte1_tx_bytes_rate);
                $data['lte2_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte2_rx_bytes_rate);
                $data['lte2_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte2_tx_bytes_rate);
                $data['lte3_rx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte3_rx_bytes_rate);
                $data['lte3_tx_bytes_rate']  = $this->api_net_rate_stats_get_disp($log->lte3_tx_bytes_rate);
                $data['sdwan_rx_bytes_rate'] = $this->api_net_rate_stats_get_disp($log->sdwan_rx_bytes_rate);
                $data['sdwan_tx_bytes_rate'] = $this->api_net_rate_stats_get_disp($log->sdwan_tx_bytes_rate);
                $data['id']                  = $log->id;
                $data['log_timestamp']       = $log->log_timestamp;
                $data['lan_rx_pkts']         = $log->lan_rx_pkts;
                $data['lan_rx_drop']         = $log->lan_rx_drop;
                $data['lan_tx_pkts']         = $log->lan_tx_pkts;
                $data['wan1_rx_pkts']        = $log->wan1_rx_pkts;
                $data['wan1_tx_pkts']        = $log->wan1_tx_pkts;
                $data['wan2_rx_pkts']        = $log->wan2_rx_pkts;
                $data['wan2_tx_pkts']        = $log->wan2_tx_pkts;
                $data['lte1_rx_pkts']        = $log->lte1_rx_pkts;
                $data['lte1_tx_pkts']        = $log->lte1_tx_pkts;
                $data['lte2_rx_pkts']        = $log->lte2_rx_pkts;
                $data['lte2_tx_pkts']        = $log->lte2_tx_pkts;
                $data['lte3_rx_pkts']        = $log->lte3_rx_pkts;
                $data['lte3_tx_pkts']        = $log->lte3_tx_pkts;
                $data['sdwan_rx_pkts']       = $log->sdwan_rx_pkts;
                $data['sdwan_tx_pkts']       = $log->sdwan_tx_pkts;
                $data['lan_tx_drop']         = $log->lan_tx_drop;
                $data['lan_rx_drop']         = $log->lan_rx_drop;
                $data['wan1_rx_drop']        = $log->wan1_rx_drop;
                $data['wan1_tx_drop']        = $log->wan1_tx_drop;
                $data['wan2_rx_drop']        = $log->wan2_rx_drop;
                $data['wan2_tx_drop']        = $log->wan2_tx_drop;
                $data['lte1_rx_drop']        = $log->lte1_rx_drop;
                $data['lte1_tx_drop']        = $log->lte1_tx_drop;
                $data['lte2_rx_drop']        = $log->lte2_rx_drop;
                $data['lte2_tx_drop']        = $log->lte2_tx_drop;
                $data['lte3_rx_drop']        = $log->lte3_rx_drop;
                $data['lte3_tx_drop']        = $log->lte3_tx_drop;
                $data['sdwan_rx_drop']       = $log->sdwan_rx_drop;
                $data['log_timestamp']       = $log->log_timestamp;
                $data['id_rand_key']         = $log->id_rand_key;
                $data['sdwan_tx_drop']       = $log->sdwan_tx_drop;

                array_push($stats_log_array, $data);
            }
            return $stats_log_array;
        } elseif ($page == 'user_access') {
            return $this->db->where('device_serialnumber', $sno)->get('smoad_user_device_access_log')->result();
        }
    }

    public function get_port_info($lteport, $sno)
    {
        $_lte_ipaddr          = $lteport . '_ipaddr';
        $_lte_netmask         = $lteport . '_netmask';
        $_lte_gateway         = $lteport . '_gateway';
        $_lte_carrier         = $lteport . '_carrier';
        $_lte_imei            = $lteport . '_imei';
        $_lte_signal_strength = $lteport . '_signal_strength';
        $_lte_link_status     = $lteport . '_link_status';

        return $this->db->query("select id, $_lte_ipaddr as _lte_ipaddr, $_lte_netmask as _lte_netmask, $_lte_gateway as _lte_gateway,$_lte_carrier as _lte_carrier, $_lte_imei as _lte_imei, $_lte_signal_strength as _lte_signal_strength,$_lte_link_status as _lte_link_status from smoad_device_network_cfg where device_serialnumber='$sno'")->result();

    }

    public function ztp_dev_agg($sno)
    {
        return $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
    }

    public function ztp_dev_firmware($id)
    {
        return $this->db->where('id', $id)->get('smoad_devices')->result();
    }

    public function update_firmware($id, $sno)
    {
        $data['firmware_status'] = 'yes';
        if ($this->db->where('id', $id)->update('smoad_devices', $data)) {
            $status = 'true';
        } else {
            $status = 'false';
        }

        $update_firmware_server_user      = '';
        $update_firmware_server_ipaddr    = '';
        $update_firmware_server_base_path = '';
        $update_firmware_server_pass      = '';

        $firmware_server = $this->db->where('id', 1)->get('smoad_update_firmware_server')->result();
        foreach ($firmware_server as $server) {
            $update_firmware_server_user      = $server->update_firmware_server_user;
            $update_firmware_server_ipaddr    = $server->update_firmware_server_ipaddr;
            $update_firmware_server_base_path = $server->update_firmware_server_base_path;
            $update_firmware_server_pass      = $server->update_firmware_server_pass;

            $job = "uci set smoad.device.update_firmware_server_user=^" . $update_firmware_server_user . "^";
            $this->sm_ztp_add_job($sno, $job);

            $job = "uci set smoad.device.update_firmware_server_ipaddr=^" . $update_firmware_server_ipaddr . "^";
            $this->sm_ztp_add_job($sno, $job);

            $job = "uci set smoad.device.update_firmware_server_base_path=^" . $update_firmware_server_base_path . "^";
            $this->sm_ztp_add_job($sno, $job);

            $job = "uci set smoad.device.update_firmware_server_pass=^" . $update_firmware_server_pass . "^";
            $this->sm_ztp_add_job($sno, $job);

            $job = "uci set smoad.device.update_firmware=^yes^";
            $this->sm_ztp_add_job($sno, $job);

            $job = "uci commit smoad";
            $this->sm_ztp_add_job($sno, $job);

            return $status;
        }
    }

    public function get_ztp_dev_debug_jobs($sno)
    {
        $jobs_with_count_array = array();
        $smoad_device_jobs_qry = $this->db->query("select count(*) as device_job_count from smoad_device_jobs where device_serialnumber='$sno'")->result();
        foreach ($smoad_device_jobs_qry as $info) {
            $device_job_count = $info->device_job_count;
            array_push($jobs_with_count_array, ['name' => 'smoad_device_jobs', 'count' => $device_job_count]);
        }

        $smoad_device_jobs_qry = $this->db->query("select count(*) as server_job_count from smoad_server_jobs where device_serialnumber='$sno'")->result();
        foreach ($smoad_device_jobs_qry as $info) {
            $server_job_count = $info->server_job_count;
            array_push($jobs_with_count_array, ['name' => 'smoad_server_jobs', 'count' => $server_job_count]);
        }

        return $jobs_with_count_array;
    }

    public function get_job_list($job_name)
    {
        return $this->db->get($job_name)->result();
    }

    public function getOsInfo($sno)
    {
        return $this->db->where('serialnumber', $sno)->get('smoad_devices')->result();
    }

    public function get_date_month_info($sno)
    {
        $current_year = date('Y');

        $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

        $year_month_array = array();

        for ($y = $current_year; $y >= 2022; --$y) {
            $months = array();
            for ($m = 1; $m <= 12; ++$m) {

                $_m           = sprintf('%02d', $m);
                $mname        = $mons[$m];
                $yr_month_qry = $this->db->query("select count(*) as row_count from smoad_device_consolidated_stats_log where year(log_timestamp)='$y' and month(log_timestamp)='$_m' and device_serialnumber='$sno'")->result();
                $enable_link  = 'false';
                foreach ($yr_month_qry as $info) {
                    $row_count = $info->row_count;
                    if ($row_count > 0) {
                        $enable_link = 'true';
                    }
                }

                array_push($months, ['month' => $_m, 'count' => $m, 'name' => $mname, 'enable_link' => $enable_link]);
            }
            array_push($year_month_array, ['year' => $y, 'months' => $months]);
        }
        return $year_month_array;
    }

    public function get_logs_by_sno($G_device_serialnumber, $date)
    {
        return $this->db->query("SELECT
        AVG(avg_lan_rx_bytes_rate) avg_lan_rx_bytes_rate, AVG(avg_lan_tx_bytes_rate) avg_lan_tx_bytes_rate,
        AVG(avg_wan1_rx_bytes_rate) avg_wan1_rx_bytes_rate, AVG(avg_wan1_tx_bytes_rate) avg_wan1_tx_bytes_rate,
        AVG(avg_wan2_rx_bytes_rate) avg_wan2_rx_bytes_rate, AVG(avg_wan2_tx_bytes_rate) avg_wan2_tx_bytes_rate,
        AVG(avg_lte1_rx_bytes_rate) avg_lte1_rx_bytes_rate, AVG(avg_lte1_tx_bytes_rate) avg_lte1_tx_bytes_rate,
        AVG(avg_lte2_rx_bytes_rate) avg_lte2_rx_bytes_rate, AVG(avg_lte2_tx_bytes_rate) avg_lte2_tx_bytes_rate,
        AVG(avg_lte3_rx_bytes_rate) avg_lte3_rx_bytes_rate, AVG(avg_lte3_tx_bytes_rate) avg_lte3_tx_bytes_rate,
        AVG(avg_sdwan_rx_bytes_rate) avg_sdwan_rx_bytes_rate, AVG(avg_sdwan_tx_bytes_rate) avg_sdwan_tx_bytes_rate,
        AVG(avg_wan1_latency) avg_wan1_latency, AVG(avg_wan1_jitter) avg_wan1_jitter,
        AVG(avg_wan2_latency) avg_wan2_latency, AVG(avg_wan2_jitter) avg_wan2_jitter,
        AVG(avg_lte1_latency) avg_lte1_latency, AVG(avg_lte1_jitter) avg_lte1_jitter,
        AVG(avg_lte2_latency) avg_lte2_latency, AVG(avg_lte2_jitter) avg_lte2_jitter,
        AVG(avg_lte3_latency) avg_lte3_latency, AVG(avg_lte3_jitter) avg_lte3_jitter,
        AVG(avg_sdwan_latency) avg_sdwan_latency, AVG(avg_sdwan_jitter) avg_sdwan_jitter,
        SUM(sum_lan_rx_bytes) sum_lan_rx_bytes, SUM(sum_lan_tx_bytes) sum_lan_tx_bytes,
        SUM(sum_wan1_rx_bytes) sum_wan1_rx_bytes, SUM(sum_wan1_tx_bytes) sum_wan1_tx_bytes,
        SUM(sum_wan2_rx_bytes) sum_wan2_rx_bytes, SUM(sum_wan2_tx_bytes) sum_wan2_tx_bytes,
        SUM(sum_lte1_rx_bytes) sum_lte1_rx_bytes, SUM(sum_lte1_tx_bytes) sum_lte1_tx_bytes,
        SUM(sum_lte2_rx_bytes) sum_lte2_rx_bytes, SUM(sum_lte2_tx_bytes) sum_lte2_tx_bytes,
        SUM(sum_lte3_rx_bytes) sum_lte3_rx_bytes, SUM(sum_lte3_tx_bytes) sum_lte3_tx_bytes,
        SUM(sum_sdwan_rx_bytes) sum_sdwan_rx_bytes, SUM(sum_sdwan_tx_bytes) sum_sdwan_tx_bytes,
        SUM(sum_link_status_wan_up_count) sum_link_status_wan1_up_count,
        SUM(sum_link_status_wan2_up_count) sum_link_status_wan2_up_count,
        SUM(sum_link_status_lte1_up_count) sum_link_status_lte1_up_count,
        SUM(sum_link_status_lte2_up_count) sum_link_status_lte2_up_count,
        SUM(sum_link_status_lte3_up_count) sum_link_status_lte3_up_count,
        SUM(sum_link_status_sdwan_up_count) sum_link_status_sdwan_up_count,
        SUM(sum_link_status_wan_down_count) sum_link_status_wan1_down_count,
        SUM(sum_link_status_wan2_down_count) sum_link_status_wan2_down_count,
        SUM(sum_link_status_lte1_down_count) sum_link_status_lte1_down_count,
        SUM(sum_link_status_lte2_down_count) sum_link_status_lte2_down_count,
        SUM(sum_link_status_lte3_down_count) sum_link_status_lte3_down_count,
        SUM(sum_link_status_sdwan_down_count) sum_link_status_sdwan_down_count,



        SUM(sum_link_status_wan_repeat_up_count) as sum_link_status_wan1_repeat_up_count,
        SUM(sum_link_status_wan2_repeat_up_count) as sum_link_status_wan2_repeat_up_count,
        SUM(sum_link_status_wan3_repeat_up_count) as sum_link_status_wan3_repeat_up_count,
        SUM(sum_link_status_lte1_repeat_up_count) as sum_link_status_lte1_repeat_up_count,
        SUM(sum_link_status_lte2_repeat_up_count) as sum_link_status_lte2_repeat_up_count,
        SUM(sum_link_status_lte3_repeat_up_count) as sum_link_status_lte3_repeat_up_count,
        SUM(sum_link_status_sdwan_repeat_up_count) as sum_link_status_sdwan_repeat_up_count,

        SUM(sum_link_status_any_repeat_up_count) as sum_link_status_any_repeat_up_count,
        COUNT(log_timestamp) as count_log_timestamp



        FROM smoad_device_consolidated_stats_log
        WHERE device_serialnumber=\"$G_device_serialnumber\" and year(log_timestamp) = $date[0] and month(log_timestamp) = $date[1]")->result();
    }

    public function jitter()
    {

        $query = $this->db->query("SELECT device_serialnumber, jitter FROM 
        ( SELECT device_serialnumber, AVG(sdwan_jitter) jitter
       FROM smoad_device_network_stats_log where log_timestamp > (NOW() - INTERVAL 60 MINUTE) 
        GROUP BY device_serialnumber ) AS jit ORDER BY jitter DESC LIMIT 5");

        // $query = $this->db->query("SELECT device_serialnumber,AVG(sdwan_latency) AS latency, AVG(sdwan_jitter) jitter FROM smoad_device_network_stats_log  GROUP BY device_serialnumber  ORDER BY latency DESC LIMIT 5");
        $status_log_result = $query->result();
        $login_type        = $this->session->userdata('accesslevel');
        $id_customer       = $this->session->userdata('customerId');

        $smoad_devices_array = array();

        foreach ($status_log_result as $log) {
            $device_serialnumber = $log->device_serialnumber;
            $jitter              = $log->jitter;
            $jitter              = round($jitter, 1);
            $jitter              = number_format($jitter, 1);
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
                $where_clause = "";
            } else {
                $where_clause = "and customer_id = $id_customer ";
            }
            $devices_qry = $this->db->query("select id, details, serialnumber, model, area from smoad_devices where serialnumber=\"$device_serialnumber\" $where_clause");
            $device_data = $devices_qry->result();

            foreach ($device_data as $data) {

                $info['id']           = $data->id;
                $info['details']      = $data->details;
                $info['serialnumber'] = $data->serialnumber;
                $info['model']        = $data->model;
                $info['area']         = $data->area;
                $info['jitter']       = $jitter;

                if ($info['model'] == "spider") {
                    $info['model'] = "Spider";
                } elseif ($info['model'] == "beetle") {
                    $info['model'] = "Beetle";
                } elseif ($info['model'] == "vm") {
                    $info['model'] = "VM";
                }

                array_push($smoad_devices_array, $info);

            }

        }
        return $smoad_devices_array;

    }

    public function latency()
    {

        $query = $this->db->query("SELECT device_serialnumber, latency FROM 
        ( SELECT device_serialnumber, AVG(sdwan_latency) latency
       FROM smoad_device_network_stats_log where  log_timestamp > (NOW() - INTERVAL 60 MINUTE) 
        GROUP BY device_serialnumber ) AS lat ORDER BY latency DESC LIMIT 5");

        // $query = $this->db->query("SELECT device_serialnumber,AVG(sdwan_latency) AS latency, AVG(sdwan_jitter) jitter FROM smoad_device_network_stats_log  GROUP BY device_serialnumber  ORDER BY latency DESC LIMIT 5");
        $status_log_result = $query->result();
        $login_type        = $this->session->userdata('accesslevel');
        $id_customer       = $this->session->userdata('customerId');

        $smoad_devices_array = array();

        foreach ($status_log_result as $log) {
            $device_serialnumber = $log->device_serialnumber;
            $latency             = $log->latency;
            $latency             = round($latency, 1);
            $latency             = number_format($latency, 1);
          
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
                $where_clause = "";
            } else {
                $where_clause = "and customer_id = $id_customer ";
            }
            $devices_qry = $this->db->query("select id, details, serialnumber, model, area from smoad_devices where serialnumber=\"$device_serialnumber\" $where_clause");
            $device_data = $devices_qry->result();

            foreach ($device_data as $data) {

                $info['id']           = $data->id;
                $info['details']      = $data->details;
                $info['serialnumber'] = $data->serialnumber;
                $info['model']        = $data->model;
                $info['area']         = $data->area;
                $info['latency']      = $latency;

                if ($info['model'] == "spider") {
                    $info['model'] = "Spider";
                } elseif ($info['model'] == "beetle") {
                    $info['model'] = "Beetle";
                } elseif ($info['model'] == "vm") {
                    $info['model'] = "VM";
                }

                array_push($smoad_devices_array, $info);

            }

        }
        return $smoad_devices_array;

    }

    public function get_firewall_log_info(){
        return $this->db->get('smoad_device_fw_stats_log')->result();
    }

    public function get_log_info($G_device_serialnumber, $date)
    {
        return $this->db->query("SELECT DATE_FORMAT(log_timestamp, '%d-%b-%Y') log_timestamp,
        avg_lan_rx_bytes_rate, avg_lan_tx_bytes_rate,
        avg_wan1_rx_bytes_rate, avg_wan1_tx_bytes_rate,
        avg_wan2_rx_bytes_rate, avg_wan2_tx_bytes_rate,
        avg_lte1_rx_bytes_rate, avg_lte1_tx_bytes_rate,
        avg_lte2_rx_bytes_rate, avg_lte2_tx_bytes_rate,
        avg_lte3_rx_bytes_rate, avg_lte3_tx_bytes_rate,
        avg_sdwan_rx_bytes_rate, avg_sdwan_tx_bytes_rate,
        avg_wan1_latency, avg_wan1_jitter,
        avg_wan2_latency, avg_wan2_jitter,
        avg_lte1_latency, avg_lte1_jitter,
        avg_lte2_latency, avg_lte2_jitter,
        avg_lte3_latency, avg_lte3_jitter,
        avg_sdwan_latency, avg_sdwan_jitter,
        sum_lan_rx_bytes, sum_lan_tx_bytes,
        sum_wan1_rx_bytes, sum_wan1_tx_bytes,
        sum_wan2_rx_bytes, sum_wan2_tx_bytes,
        sum_lte1_rx_bytes, sum_lte1_tx_bytes,
        sum_lte2_rx_bytes, sum_lte2_tx_bytes,
        sum_lte3_rx_bytes, sum_lte3_tx_bytes,
        sum_sdwan_rx_bytes, sum_sdwan_tx_bytes,
        sum_link_status_wan_up_count as sum_link_status_wan1_up_count,
        sum_link_status_wan2_up_count,
        sum_link_status_lte1_up_count,
        sum_link_status_lte2_up_count,
        sum_link_status_lte3_up_count,
        sum_link_status_sdwan_up_count,
        sum_link_status_wan_down_count as sum_link_status_wan1_down_count,
        sum_link_status_wan2_down_count,
        sum_link_status_lte1_down_count,
        sum_link_status_lte2_down_count,
        sum_link_status_lte3_down_count,
        sum_link_status_sdwan_down_count,

        sum_link_status_wan_repeat_up_count as sum_link_status_wan1_repeat_up_count,
        sum_link_status_wan2_repeat_up_count,
        sum_link_status_wan3_repeat_up_count,
        sum_link_status_lte1_repeat_up_count,
        sum_link_status_lte2_repeat_up_count,
        sum_link_status_lte3_repeat_up_count,
        sum_link_status_sdwan_repeat_up_count,

        sum_link_status_any_repeat_up_count

        FROM smoad_device_consolidated_stats_log
        WHERE device_serialnumber=\"$G_device_serialnumber\" and year(log_timestamp) = $date[0] and month(log_timestamp) = $date[1]")->result();
    }

    public function get_dev_config_template_details($id)
    {
        return $this->db->where('id', $id)->get('smoad_device_templates')->result();
    }

    public function get_config_info($id)
    {

        $device_info           = $this->db->where('id', $id)->get('smoad_devices')->result();
        $where_clause_customer = null;
        foreach ($device_info as $info) {
            $model         = $info->model;
            $model_variant = $info->model_variant;
        }

        $where_clause = " where model=\"$model\" and model_variant=\"$model_variant\" ";
        $total_items  = 0;
        $total_pages  = 0;
        $id_customer  = $this->session->userdata('customer_id');
        if ($this->session->userdata('accesslevel') == 'customer') {
            $where_clause_customer = "and customer_id = $id_customer ";
        }

        if ($where_clause_customer != null) {
            //first where
            $where_clause .= $where_clause_customer;
        }

        $device_template_qry = $this->db->query("select id, template_details, details, model, model_variant, area, sdwan_server_ipaddr, vlan_id, enable
        from smoad_device_templates $where_clause order by id desc")->result();

        return $device_template_qry;

    }

    public function install_dev_config_template($id, $sno, $template_id)
    {
        $device_template = $this->db->where('id', $template_id)->get('smoad_device_templates')->result();
        foreach ($device_template as $info) {
            $network_cfg_qry = $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
            //echo '<pre>'; print_r($network_cfg_qry);exit;
            foreach ($network_cfg_qry as $network) {
                $cfg_id = $network->id;
            }

            $netwrk['details'] = $info->details;
            $job               = "uci set smoad.device.details=^" . $netwrk['details'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $netwrk['area'] = $info->area;
            $job            = "uci set smoad.device.area=^" . $netwrk['area'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $this->db->where('id', $id)->update('smoad_devices', $netwrk);
            $data['lan_ipaddr'] = $info->lan_ipaddr;
            $job                = "uci set network.lan.ipaddr=^" . $data['lan_ipaddr'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['lan_netmask'] = $info->lan_netmask;
            $job                 = "uci set network.lan.netmask=^" . $data['lan_netmask'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['wireless_ssid'] = $info->wireless_ssid;
            $job                   = "uci set wireless.default_radio0.ssid=^" . $data['wireless_ssid'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['wireless_key'] = $info->wireless_key;
            $job                  = "uci set wireless.default_radio0.key=^" . $data['wireless_key'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['wireless_encryption'] = $info->wireless_encryption;
            $job                         = "uci set wireless.default_radio0.encryption=^" . $data['wireless_encryption'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['wireless_auth_server'] = $info->wireless_auth_server;
            $job                          = "uci set wireless.default_radio0.auth_server=^" . $data['wireless_auth_server'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['wireless_auth_secret'] = $info->wireless_auth_secret;
            $job                          = "uci set wireless.default_radio0.auth_secret=^" . $data['wireless_auth_secret'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['aggpolicy_mode'] = $info->aggpolicy_mode;
            $job                    = "uci set smoad.device.aggpolicy_mode=^" . $data['aggpolicy_mode'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['aggpolicy'] = $info->aggpolicy;
            $job               = "uci set smoad.device.aggpolicy=^" . $data['aggpolicy'] . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data['sdwan_link_high_usage_threshold'] = $info->sdwan_link_high_usage_threshold;
            $this->db->where('id', $cfg_id)->update('smoad_device_network_cfg', $data);
            $edge_value = $this->_install_wan_config_template_to_edge($template_id, $sno, $cfg_id, 'wan');
            $edge_value = $this->_install_wan_config_template_to_edge($template_id, $sno, $cfg_id, 'wan2');
            $edge_value = $this->_install_wan_config_template_to_edge($template_id, $sno, $cfg_id, 'wan3');
            $edge_value = $this->_install_lte_config_template_to_edge($template_id, $sno, $cfg_id, 'lte1');
            $edge_value = $this->_install_lte_config_template_to_edge($template_id, $sno, $cfg_id, 'lte2');
            $edge_value = $this->_install_lte_config_template_to_edge($template_id, $sno, $cfg_id, 'lte3');
            return $edge_value;
        }
    }

    public function install_lte_config_template_to_edge($template_id, $sno, $cfg_id, $port)
    {
        $device_template = $this->db->query("select $port" . "_ipaddr _lte_ipaddr, $port" . "_netmask _lte_netmask, $port" . "_gateway _lte_gateway,
        $port" . "_max_bandwidth _lte_max_bandwidth, $port" . "_medium_bandwidth_pct _lte_medium_bandwidth_pct, $port" . "_low_bandwidth_pct _lte_low_bandwidth_pct
        from smoad_device_templates where id=$template_id ")->result();
        foreach ($device_template as $info) {
            $data[$port . "_ipaddr"] = $info->_lte_ipaddr;
            $job                     = "uci set network." . $port . ".ipaddr=^" . $info->_lte_ipaddr . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_netmask"] = $info->_lte_netmask;
            $job                      = "uci set network." . $port . ".netmask=^" . $info->_lte_netmask . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_gateway"] = $info->_lte_gateway;
            $job                      = "uci set network." . $port . ".gateway=^" . $info->_lte_gateway . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_max_bandwidth"] = $info->_lte_max_bandwidth;
            $job                            = "uci set smoad.qos." . $port . "_max_bandwidth=^" . $info->_lte_max_bandwidth . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_medium_bandwidth_pct"] = $info->_lte_medium_bandwidth_pct;
            $job                                   = "uci set smoad.qos." . $port . "_medium_bandwidth_pct=^" . $info->_lte_medium_bandwidth_pct . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_low_bandwidth_pct"] = $info->_lte_low_bandwidth_pct;
            $job                                = "uci set smoad.qos." . $port . "_low_bandwidth_pct=^" . $info->_lte_low_bandwidth_pct . "^";
            $this->sm_ztp_add_job($sno, $job);
            if ($this->db->where('id', $cfg_id)->update('smoad_device_network_cfg', $data)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function install_wan_config_template_to_edge($template_id, $sno, $cfg_id, $port)
    {
        $device_template = $this->db->query("select $port" . "_proto _wan_proto, $port" . "_ipaddr _wan_ipaddr, $port" . "_netmask _wan_netmask,
           $port" . "_gateway _wan_gateway, $port" . "_dns _wan_dns, $port" . "_username _wan_username, $port" . "_password _wan_password,
           $port" . "_max_bandwidth _wan_max_bandwidth, $port" . "_medium_bandwidth_pct _wan_medium_bandwidth_pct, $port" . "_low_bandwidth_pct _wan_low_bandwidth_pct
           from smoad_device_templates where id=$template_id ")->result();
        foreach ($device_template as $info) {
            $data[$port . "_proto"] = $info->_wan_proto;
            $job                    = "uci set network." . $port . ".proto=^" . $info->_wan_proto . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_ipaddr"] = $info->_wan_ipaddr;
            $job                     = "uci set network." . $port . ".ipaddr=^" . $info->_wan_ipaddr . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_netmask"] = $info->_wan_netmask;
            $job                      = "uci set network." . $port . ".netmask=^" . $info->_wan_netmask . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_gateway"] = $info->_wan_gateway;
            $job                      = "uci set network." . $port . ".gateway=^" . $info->_wan_gateway . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_dns"] = $info->_wan_dns;
            $job                  = "uci set network." . $port . ".dns=^" . $info->_wan_dns . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_username"] = $info->_wan_username;
            $job                       = "uci set network." . $port . ".username=^" . $info->_wan_username . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_password"] = $info->_wan_password;
            $job                       = "uci set network." . $port . ".password=^" . $info->_wan_password . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_max_bandwidth"] = $info->_wan_max_bandwidth;
            $job                            = "uci set smoad.qos." . $port . "_max_bandwidth=^" . $info->_wan_max_bandwidth . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_medium_bandwidth_pct"] = $info->_wan_medium_bandwidth_pct;
            $job                                   = "uci set smoad.qos." . $port . "_medium_bandwidth_pct=^" . $info->_wan_medium_bandwidth_pct . "^";
            $this->sm_ztp_add_job($sno, $job);
            $data[$port . "_low_bandwidth_pct"] = $info->_wan_low_bandwidth_pct;
            $job                                = "uci set smoad.qos." . $port . "_low_bandwidth_pct=^" . $info->_wan_low_bandwidth_pct . "^";
            $this->sm_ztp_add_job($sno, $job);
            if ($this->db->where('id', $cfg_id)->update('smoad_device_network_cfg', $data)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public function set_device_template($id, $sno, $template_details)
    {
        $smoad_device_info = $this->db->where('id', $id)->get('smoad_devices')->result();
        foreach ($smoad_device_info as $info) {
            $id                  = $info->id;
            $details             = $info->details;
            $license             = $info->license;
            $serialnumber        = $info->serialnumber;
            $model               = $info->model;
            $model_variant       = $info->model_variant;
            $root_password       = $info->root_password;
            $superadmin_password = $info->superadmin_password;
            $firmware            = $info->firmware;
            $area                = $info->area;
            $sdwan_server_ipaddr = $info->sdwan_server_ipaddr;
            $sdwan_proto         = $info->sdwan_proto;
            $vlan_id             = $info->vlan_id;
            $customer_id         = $info->customer_id;
        }
        $network_cfg_info = $this->db->where('device_serialnumber', $sno)->get('smoad_device_network_cfg')->result();
        foreach ($network_cfg_info as $info) {

            $lan_ipaddr                      = $info->lan_ipaddr;
            $lan_netmask                     = $info->lan_netmask;
            $wan_proto                       = $info->wan_proto;
            $wan_ipaddr                      = $info->wan_ipaddr;
            $wan_netmask                     = $info->wan_netmask;
            $wan_gateway                     = $info->wan_gateway;
            $wan_dns                         = $info->wan_dns;
            $wan_username                    = $info->wan_username;
            $wan_password                    = $info->wan_password;
            $wan_max_bandwidth               = $info->wan_max_bandwidth;
            $wan_medium_bandwidth_pct        = $info->wan_medium_bandwidth_pct;
            $wan_low_bandwidth_pct           = $info->wan_low_bandwidth_pct;
            $wan2_proto                      = $info->wan2_proto;
            $wan2_ipaddr                     = $info->wan2_ipaddr;
            $wan2_netmask                    = $info->wan2_netmask;
            $wan2_gateway                    = $info->wan2_gateway;
            $wan2_dns                        = $info->wan2_dns;
            $wan2_username                   = $info->wan2_username;
            $wan2_password                   = $info->wan2_password;
            $wan2_max_bandwidth              = $info->wan2_max_bandwidth;
            $wan2_medium_bandwidth_pct       = $info->wan2_medium_bandwidth_pct;
            $wan2_low_bandwidth_pct          = $info->wan2_low_bandwidth_pct;
            $wan3_proto                      = $info->wan3_proto;
            $wan3_ipaddr                     = $info->wan3_ipaddr;
            $wan3_netmask                    = $info->wan3_netmask;
            $wan3_gateway                    = $info->wan3_gateway;
            $wan3_dns                        = $info->wan3_dns;
            $wan3_username                   = $info->wan3_username;
            $wan3_password                   = $info->wan3_password;
            $wan3_max_bandwidth              = $info->wan3_max_bandwidth;
            $wan3_medium_bandwidth_pct       = $info->wan3_medium_bandwidth_pct;
            $wan3_low_bandwidth_pct          = $info->wan3_low_bandwidth_pct;
            $lte1_ipaddr                     = $info->lte1_ipaddr;
            $lte1_netmask                    = $info->lte1_netmask;
            $lte1_gateway                    = $info->lte1_gateway;
            $lte1_max_bandwidth              = $info->lte1_max_bandwidth;
            $lte1_medium_bandwidth_pct       = $info->lte1_medium_bandwidth_pct;
            $lte1_low_bandwidth_pct          = $info->lte1_low_bandwidth_pct;
            $lte2_ipaddr                     = $info->lte2_ipaddr;
            $lte2_netmask                    = $info->lte2_netmask;
            $lte2_gateway                    = $info->lte2_gateway;
            $lte2_max_bandwidth              = $info->lte2_max_bandwidth;
            $lte2_medium_bandwidth_pct       = $info->lte2_medium_bandwidth_pct;
            $lte2_low_bandwidth_pct          = $info->lte2_low_bandwidth_pct;
            $lte3_ipaddr                     = $info->lte3_ipaddr;
            $lte3_netmask                    = $info->lte3_netmask;
            $lte3_gateway                    = $info->lte3_gateway;
            $lte3_max_bandwidth              = $info->lte3_max_bandwidth;
            $lte3_medium_bandwidth_pct       = $info->lte3_medium_bandwidth_pct;
            $lte3_low_bandwidth_pct          = $info->lte3_low_bandwidth_pct;
            $wireless_ssid                   = $info->wireless_ssid;
            $wireless_key                    = $info->wireless_key;
            $wireless_encryption             = $info->wireless_encryption;
            $wireless_auth_server            = $info->wireless_auth_server;
            $wireless_auth_secret            = $info->wireless_auth_secret;
            $aggpolicy_mode                  = $info->aggpolicy_mode;
            $aggpolicy                       = $info->aggpolicy;
            $sdwan_link_high_usage_threshold = $info->sdwan_link_high_usage_threshold;
        }

        $data['template_details']                = $template_details;
        $data['details']                         = $details;
        $data['model']                           = $model;
        $data['model_variant']                   = $model_variant;
        $data['area']                            = $area;
        $data['sdwan_proto']                     = $sdwan_proto;
        $data['customer_id']                     = $customer_id;
        $data['lan_ipaddr']                      = $lan_ipaddr;
        $data['lan_netmask']                     = $lan_netmask;
        $data['wan_proto']                       = $wan_proto;
        $data['wan_ipaddr']                      = $wan_ipaddr;
        $data['wan_netmask']                     = $wan_netmask;
        $data['wan_gateway']                     = $wan_gateway;
        $data['wan_dns']                         = $wan_dns;
        $data['wan_username']                    = $wan_username;
        $data['wan_password']                    = $wan_password;
        $data['wan_max_bandwidth']               = $wan_max_bandwidth;
        $data['wan_medium_bandwidth_pct']        = $wan_medium_bandwidth_pct;
        $data['wan_low_bandwidth_pct']           = $wan_low_bandwidth_pct;
        $data['wan2_proto']                      = $wan2_proto;
        $data['wan2_ipaddr']                     = $wan2_ipaddr;
        $data['wan2_netmask']                    = $wan2_netmask;
        $data['wan2_gateway']                    = $wan2_gateway;
        $data['wan2_dns']                        = $wan2_dns;
        $data['wan2_username']                   = $wan2_username;
        $data['wan2_password']                   = $wan2_password;
        $data['wan2_max_bandwidth']              = $wan2_max_bandwidth;
        $data['wan2_medium_bandwidth_pct']       = $wan2_medium_bandwidth_pct;
        $data['wan2_low_bandwidth_pct']          = $wan2_low_bandwidth_pct;
        $data['wan3_proto']                      = $wan3_proto;
        $data['wan3_ipaddr']                     = $wan3_ipaddr;
        $data['wan3_netmask']                    = $wan3_netmask;
        $data['wan3_gateway']                    = $wan3_gateway;
        $data['wan3_dns']                        = $wan3_dns;
        $data['wan3_username']                   = $wan3_username;
        $data['wan3_password']                   = $wan3_password;
        $data['wan3_max_bandwidth']              = $wan3_max_bandwidth;
        $data['wan3_medium_bandwidth_pct']       = $wan3_medium_bandwidth_pct;
        $data['wan3_low_bandwidth_pct']          = $wan3_low_bandwidth_pct;
        $data['lte1_ipaddr']                     = $lte1_ipaddr;
        $data['lte1_netmask']                    = $lte1_netmask;
        $data['lte1_gateway']                    = $lte1_gateway;
        $data['lte1_max_bandwidth']              = $lte1_max_bandwidth;
        $data['lte1_medium_bandwidth_pct']       = $lte1_medium_bandwidth_pct;
        $data['lte1_low_bandwidth_pct']          = $lte1_low_bandwidth_pct;
        $data['lte2_ipaddr']                     = $lte2_ipaddr;
        $data['lte2_netmask']                    = $lte2_netmask;
        $data['lte2_gateway']                    = $lte2_gateway;
        $data['lte2_max_bandwidth']              = $lte2_max_bandwidth;
        $data['lte2_medium_bandwidth_pct']       = $lte2_medium_bandwidth_pct;
        $data['lte2_low_bandwidth_pct']          = $lte2_low_bandwidth_pct;
        $data['lte3_ipaddr']                     = $lte3_ipaddr;
        $data['lte3_netmask']                    = $lte3_netmask;
        $data['lte3_gateway']                    = $lte3_gateway;
        $data['lte3_max_bandwidth']              = $lte3_max_bandwidth;
        $data['lte3_medium_bandwidth_pct']       = $lte3_medium_bandwidth_pct;
        $data['lte3_low_bandwidth_pct']          = $lte3_low_bandwidth_pct;
        $data['wireless_ssid']                   = $wireless_ssid;
        $data['wireless_key']                    = $wireless_key;
        $data['wireless_encryption']             = $wireless_encryption;
        $data['wireless_auth_server']            = $wireless_auth_server;
        $data['wireless_auth_secret']            = $wireless_auth_secret;
        $data['aggpolicy_mode']                  = $aggpolicy_mode;
        $data['aggpolicy']                       = $aggpolicy;
        $data['sdwan_link_high_usage_threshold'] = $sdwan_link_high_usage_threshold;

        if ($this->db->insert('smoad_device_templates', $data)) {
            return 'true';
        } else {
            return 'false';
        }

        // if($this->db->query('insert into smoad_device_templates
        // (template_details, details, model, model_variant, area, sdwan_proto, customer_id,
        //  lan_ipaddr, lan_netmask,
        //  wan_proto, wan_ipaddr, wan_netmask, wan_gateway, wan_dns, wan_username, wan_password,
        //  wan_max_bandwidth, wan_medium_bandwidth_pct, wan_low_bandwidth_pct,
        //  wan2_proto, wan2_ipaddr, wan2_netmask, wan2_gateway, wan2_dns, wan2_username, wan2_password,
        //  wan2_max_bandwidth, wan2_medium_bandwidth_pct, wan2_low_bandwidth_pct,
        //  wan3_proto, wan3_ipaddr, wan3_netmask, wan3_gateway, wan3_dns, wan3_username, wan3_password,
        //  wan3_max_bandwidth, wan3_medium_bandwidth_pct, wan3_low_bandwidth_pct,
        //  lte1_ipaddr, lte1_netmask, lte1_gateway,
        //  lte1_max_bandwidth, lte1_medium_bandwidth_pct, lte1_low_bandwidth_pct,
        //  lte2_ipaddr, lte2_netmask, lte2_gateway,
        //  lte2_max_bandwidth, lte2_medium_bandwidth_pct, lte2_low_bandwidth_pct,
        //  lte3_ipaddr, lte3_netmask, lte3_gateway,
        //  lte3_max_bandwidth, lte3_medium_bandwidth_pct, lte3_low_bandwidth_pct,
        //  wireless_ssid, wireless_key, wireless_encryption, wireless_auth_server, wireless_auth_secret,
        //  aggpolicy_mode, aggpolicy,
        //  sdwan_link_high_usage_threshold
        // )
        // values ("$template_details", "$details", "$model", "$model_variant", "$area", "$sdwan_proto", "$customer_id",
        //  "$lan_ipaddr", "$lan_netmask",
        //  "$wan_proto", "$wan_ipaddr", "$wan_netmask", "$wan_gateway", "$wan_dns", "$wan_username", "$wan_password",
        //  "$wan_max_bandwidth", "$wan_medium_bandwidth_pct", "$wan_low_bandwidth_pct",
        //  "$wan2_proto", "$wan2_ipaddr", "$wan2_netmask", "$wan2_gateway", "$wan2_dns", "$wan2_username", "$wan2_password",
        //  "$wan2_max_bandwidth", "$wan2_medium_bandwidth_pct", "$wan2_low_bandwidth_pct",
        //  "$wan3_proto", "$wan3_ipaddr", "$wan3_netmask", "$wan3_gateway", "$wan3_dns", "$wan3_username", "$wan3_password",
        //  "$wan3_max_bandwidth", "$wan3_medium_bandwidth_pct", "$wan3_low_bandwidth_pct",
        //  "$lte1_ipaddr", "$lte1_netmask", "$lte1_gateway",
        //  "$lte1_max_bandwidth", "$lte1_medium_bandwidth_pct", "$lte1_low_bandwidth_pct",
        //  "$lte2_ipaddr", "$lte2_netmask", "$lte2_gateway",
        //  "$lte2_max_bandwidth", "$lte2_medium_bandwidth_pct", "$lte2_low_bandwidth_pct",
        //  "$lte3_ipaddr", "$lte3_netmask", "$lte3_gateway",
        //  "$lte3_max_bandwidth", "$lte3_medium_bandwidth_pct", "$lte3_low_bandwidth_pct",
        //  "$wireless_ssid", "$wireless_key", "$wireless_encryption", "$wireless_auth_server", "$wireless_auth_secret",
        //  "$aggpolicy_mode", "$aggpolicy",
        //  "$sdwan_link_high_usage_threshold"
        // )')->result()){
        //     return "true";
        // } else {
        //     return "false";
        // }
    }

    public function get_chart_data_by_sno($serialnumber, $metric, $interval)
    {
        if ($interval == 'pd') {
            $interval_time = 'INTERVAL 24 HOUR';
        } elseif ($interval == 'pw') {
            $interval_time = 'INTERVAL 168 HOUR';
        }
        return $this->db->query("SELECT DATE_FORMAT(log_timestamp, '%d-%c %H:%i') log_timestamp,
        TRUNCATE($metric, 2) as metric
        FROM smoad_device_network_stats_log
              WHERE device_serialnumber = '$serialnumber' and log_timestamp>=DATE_SUB(NOW(),$interval_time)")->result();
    }

    public function get_max_metrix($metric, $serialnumber)
    {
        return $this->db->query("select  max(CAST($metric AS DECIMAL(10,2))) max_bits from smoad_device_network_stats_log
        where log_timestamp>=DATE_SUB(NOW(),INTERVAL 200 HOUR) and device_serialnumber='$serialnumber'")->result();
    }

    public function get_count_info($upCountMetric, $downCountMetric, $serialnumber, $interval)
    {
        if ($interval == 'pd') {
            $interval_time = 'INTERVAL 24 HOUR';
        } elseif ($interval == 'pw') {
            $interval_time = 'INTERVAL 168 HOUR';
        }
        return $this->db->query("SELECT DATE_FORMAT(log_timestamp, '%d-%c %H:%i') log_timestamp,
        $upCountMetric upCountMetric, $downCountMetric downCountMetric
        FROM smoad_device_status_log
        WHERE device_serialnumber = '$serialnumber' and log_timestamp>=DATE_SUB(NOW(),$interval_time)")->result();
    }

    public function get_dash_pie_chart_info($sno)
    {
        return $this->db->query("select
        avg(wan1_rx_bytes_rate) avg_wan1_rx_bytes_rate, avg(wan1_tx_bytes_rate) avg_wan1_tx_bytes_rate,
        avg(wan2_rx_bytes_rate) avg_wan2_rx_bytes_rate, avg(wan2_tx_bytes_rate) avg_wan2_tx_bytes_rate,
        avg(wan3_rx_bytes_rate) avg_wan3_rx_bytes_rate, avg(wan3_tx_bytes_rate) avg_wan3_tx_bytes_rate,
        avg(lte1_rx_bytes_rate) avg_lte1_rx_bytes_rate, avg(lte1_tx_bytes_rate) avg_lte1_tx_bytes_rate,
        avg(lte2_rx_bytes_rate) avg_lte2_rx_bytes_rate, avg(lte2_tx_bytes_rate) avg_lte2_tx_bytes_rate,
        avg(lte3_rx_bytes_rate) avg_lte3_rx_bytes_rate, avg(lte3_tx_bytes_rate) avg_lte3_tx_bytes_rate
        from smoad_device_network_stats_log where device_serialnumber = '$sno' and
        log_timestamp>=DATE_SUB(NOW(),INTERVAL 24 HOUR)")->result();
    }

    public function get_last_port_up_count_timestamp($sno, $port)
    {
        return $this->db->query("SELECT log_timestamp port_up_count_timestamp FROM smoad_device_status_log
        where device_serialnumber='$sno' and $port = 1 order by id desc limit 1")->result();
    }
    public function get_last_port_down_count_timestamp($sno, $port)
    {
        return $this->db->query("SELECT log_timestamp port_down_count_timestamp FROM smoad_device_status_log
        where device_serialnumber='$sno' and $port = 1 order by id desc limit 1")->result();
    }

    public function get_gateway_sn($id)
    {
        return $this->db->where('id', $id)->get('smoad_sdwan_servers')->result();
    }

    public function get_chart_data($qry_params, $where_clause_gw_serial_vxlan_id, $where_clause_interval)
    {
        return $this->db->query("$qry_params from smoad_device_network_qos_stats_log where $where_clause_gw_serial_vxlan_id and $where_clause_interval")->result();
    }

    public function get_query_result($columns, $time_interval, $where_clause_gw_serial_vxlan_id)
    {
        return $this->db->query("SELECT DATE_FORMAT(log_timestamp, '%Y-%m-%d %H:%i:00') AS log_timestamp_10_mins, $columns FROM smoad_device_network_qos_stats_log  WHERE log_timestamp >= NOW() - $time_interval AND log_timestamp < NOW() AND $where_clause_gw_serial_vxlan_id GROUP BY log_timestamp, MINUTE(log_timestamp) DIV 10  ORDER BY log_timestamp")->result();
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edge extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Edge_model');
        $this->load->helper('file');
        $this->load->library('pdf');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['devices']     = $this->Edge_model->get_smoad_devices();
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        // echo "<pre>";
        // print_r($data['devices']);exit;
        $this->load->view('edge/index', $data);
    }

    public function dev_config_templates()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['templates']      = $this->Edge_model->get_dev_config_templates();
        $data['template_count'] = $this->Edge_model->get_dev_config_templates_cnt();
        $data['alerts_info']    = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']     = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/dev_config_templates', $data);
    }

    
    public function jitter_tracking()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['jitter']             = $this->Edge_model->jitter();
        $data['alerts_info']    = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']     = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/jitter_tracking', $data);
    }

    public function latency_tracking()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['latency']             = $this->Edge_model->latency();
        $data['alerts_info']    = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']     = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/latency_tracking', $data);
    }

  

    public function dev_config_template_details()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $id                     = $this->uri->segment('3');
        $data['templates_info'] = $this->Edge_model->get_dev_config_template_details($id);
        $data['alerts_info']    = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']     = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/dev_config_template_details', $data);
    }

    public function update_firmware_server()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['firmware_info'] = $this->Edge_model->get_firmware_server();
        $data['alerts_info']   = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']    = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/update_firmware_server', $data);
    }

    public function save_edge()
    {
        $this->form_validation->set_rules('details', 'Details', 'required');
        //$this->form_validation->set_rules('license', 'License Name', 'required');
        $this->form_validation->set_rules('model_and_variant', 'model and variant', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/add_edge');
        }
        $_model_and_variant = strip_tags($this->input->post('model_and_variant'));
        if ($_model_and_variant == 'spider_l2') {
            $_model         = "spider";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'spider_l2w1l2') {
            $_model         = "spider";
            $_model_variant = "l2w1l2";
        } elseif ($_model_and_variant == 'spider_l3') {
            $_model         = "spider";
            $_model_variant = "l3";
        } elseif ($_model_and_variant == 'spider_mptcp') {
            $_model         = "spider";
            $_model_variant = "mptcp";
        } elseif ($_model_and_variant == 'spider2_l2') {
            $_model         = "spider2";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'spider2_l3') {
            $_model         = "spider2";
            $_model_variant = "l3";
        } elseif ($_model_and_variant == 'beetle_l2') {
            $_model         = "beetle";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'beetle_l3') {
            $_model         = "beetle";
            $_model_variant = "l3";
        } elseif ($_model_and_variant == 'bumblebee_l2') {
            $_model         = "bumblebee";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'bumblebee_l3') {
            $_model         = "bumblebee";
            $_model_variant = "l3";
        } elseif ($_model_and_variant == 'wasp1_l2') {
            $_model         = "wasp1";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'wasp2_l2') {
            $_model         = "wasp2";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'vm_l2') {
            $_model         = "vm";
            $_model_variant = "l2";
        } elseif ($_model_and_variant == 'vm_l3') {
            $_model         = "vm";
            $_model_variant = "l3";
        } elseif ($_model_and_variant == 'vm_mptcp') {
            $_model         = "vm";
            $_model_variant = "mptcp";
        } elseif ($_model_and_variant == 'soft_client') {
            $_model         = "soft_client";
            $_model_variant = "soft_client";
        }

        $data['details']             = strip_tags($this->input->post('details'));
        $data['license']             = strip_tags($this->input->post('license'));
        $data['model_variant']       = $_model_variant;
        $data['model']               = $_model;
        $data['area']                = strip_tags($this->input->post('area'));
        $data['os']                  = strip_tags($this->input->post('os'));
        $data['root_password']       = bin2hex(random_bytes(6));
        $data['superadmin_password'] = bin2hex(random_bytes(6));
        $data['sdwan_server_ipaddr'] = 'notset';
        $api_prikey                  = null;
        $api_pubkey                  = null;
        $api_device_prikey           = null;
        $api_device_pubkey           = null;
        $this->Edge_model->api_generate_device_api_keys($api_prikey, $api_pubkey);
        $this->Edge_model->api_generate_device_api_keys($api_device_prikey, $api_device_pubkey);
        $data['vlan_id'] = 0;

        $data['api_prikey']            = $api_prikey;
        $data['api_pubkey']            = $api_pubkey;
        $data['api_device_prikey']     = $api_device_prikey;
        $data['api_device_pubkey']     = $api_device_pubkey;
        $data['api_prikey_new']        = $api_prikey;
        $data['api_pubkey_new']        = $api_pubkey;
        $data['api_device_prikey_new'] = $api_device_prikey;
        $data['api_device_pubkey_new'] = $api_device_pubkey;

        $hash = "0";
        while ($hash[0] == "0") {
            $hash = substr(md5(openssl_random_pseudo_bytes(20)), -16);
        }

        $data['serialnumber'] = strip_tags($hash);

        $exists = $this->Edge_model->sno_existance_check($data['serialnumber']);

        if ($exists == 'exists') {
            $this->session->set_flashdata('error_msgs', 'Found already matching edge name. So cannot creating this new edge!');
            redirect('Edge/add_edge');
        }

        $status = $this->Edge_model->save_edge($data);

        if ($status == "true") {
            $this->session->set_flashdata('success_msg', 'The edge has been added successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in adding a edge. Please try again later.');
        }

        redirect('Edge/index');
    }

    public function save_ztp_dev_config()
    {
        $template_details = $this->input->post('template_details');
        $data['id']       = $this->uri->segment('3');
        $data['sno']      = $this->uri->segment('4');
        $status           = $this->Edge_model->set_device_template($data['id'], $data['sno'], $template_details);
        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'SUCCESS: Edge config successfully added as a device template !');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in adding device template. Please try again later.');
        }
        redirect('Edge/ztp_dev_config/' . $data['id'] . '/' . $data['sno']);
    }

    public function save_firmware_info()
    {
        $this->form_validation->set_rules('update_firmware_server_user', 'update firmware server user', 'required');
        $this->form_validation->set_rules('update_firmware_server_ipaddr', 'update firmware server ipaddr', 'required|valid_ip');
        $this->form_validation->set_rules('update_firmware_server_base_path', 'update firmware server base path', 'required');
        $this->form_validation->set_rules('update_firmware_server_pass', 'update firmware server pass', 'required');
        $this->form_validation->set_rules('update_firmware_release_version', 'update firmware release version', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/update_firmware_server');
        }
        $data['update_firmware_server_user']      = $this->input->post('update_firmware_server_user');
        $data['update_firmware_server_ipaddr']    = $this->input->post('update_firmware_server_ipaddr');
        $data['update_firmware_server_base_path'] = $this->input->post('update_firmware_server_base_path');
        $data['update_firmware_server_pass']      = $this->input->post('update_firmware_server_pass');
        $data['update_firmware_release_version']  = $this->input->post('update_firmware_release_version');

        $status = $this->Edge_model->save_firmware_info($data);
        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'SUCCESS: Firmware informations are updated successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in updating firmware information. Please try again later.');
        }
        redirect('Edge/update_firmware_server/');
    }

    public function delete_edge()
    {
        $id     = $this->input->post('edge_id');
        $status = $this->Edge_model->delete_edge($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The edge has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a edge. Please try again later.');
        }
    }

    public function delete_template()
    {
        $template_id = $this->input->post('template_id');
        $details     = $this->input->post('details');
        $status      = $this->Edge_model->delete_template($template_id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', "SUCCESS: Device config template $details deleted successfully !");
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a template. Please try again later.');
        }
    }

    public function delete_job()
    {
        $id     = $this->input->post('job_id');
        $status = $this->Edge_model->delete_job($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The job has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a job. Please try again later.');
        }
    }

    public function delete_jobs()
    {
        $id         = $this->uri->segment('3');
        $sno        = $this->uri->segment('4');
        $table_name = $this->uri->segment('5');
        $status     = $this->Edge_model->delete_jobs($table_name);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', "Deleted all jobs from the table: $table_name !");
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a job. Please try again later.');
        }
        redirect('Edge/ztp_dev_debug_jobs/' . $id . '/' . $sno);
    }

    public function delete_bulk_servers()
    {
        $delete_list_id = $this->input->post('alert_ids');
        for ($i = 0; $i < count($delete_list_id); ++$i) {
            $this->Edge_model->delete_server($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success', 'The selected Servers has been deleted successfully');
    }

    public function view_edge()
    {
        $id                  = $this->uri->segment('3');
        $data['edge_info']   = $this->Edge_model->get_edge_info($id);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/view_edge', $data);
    }

    public function add_edge()
    {
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/add_edge', $data);
    }

    public function update_edge()
    {
        $CI =& get_instance();
        $CI->session->unset_userdata('session_model');
        $CI->session->unset_userdata('session_model_variant');
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['edge_info']   = $this->Edge_model->get_edge_info($data['id']);
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        foreach ($data['device_info'] as $info) {
            $this->session->set_userdata('session_model', $info->model);
            $this->session->set_userdata('session_model_variant', $info->model_variant);
        }
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/update_edge', $data);
    }

    // public function update_vlan()
    // {
    //     $vlan_id = $this->uri->segment('3');
    //     $sdwan_id = $this->uri->segment('4');
    //     $sdwan_serial_number = $this->uri->segment('5');
    //     $data['vlan_info'] = $this->Edge_model->getVlanIdInfo($vlan_id);
    //     $data['sdwan_id'] = $sdwan_id;
    //     $data['sdwan_serial_number'] = $sdwan_serial_number;

    //     $this->load->view('edge/update_vlan', $data);
    // }

    public function save_edited_info()
    {
        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $id           = $this->input->post('edge_id');
        $job          = $this->input->post('job');
        $serialnumber = $this->input->post('serialnumber');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/update_edge/' . $id);
        }
        if ($job == 'update') {
            $data['details'] = strip_tags($this->input->post('details'));
            $data['area']    = strip_tags($this->input->post('area'));
            $data['os']      = strip_tags($this->input->post('os'));
            $this->Edge_model->update_edge($data, $id);
            $this->session->set_flashdata('update_msgs', 'The Server details has been updated successfully');
        }

        if ($job == 'reboot') {
            $status = $this->Edge_model->reboot($serialnumber, $job);
            if ($status == true) {
                $this->session->set_flashdata('success_msg', 'Edge reboot request raised. Edge will reboot shortly !');
            } elseif ($status == false) {
                $this->session->set_flashdata('error_msgs', 'There is some error in Edge reboot request. Please ret again');
            }
        }

        if ($job == 'reprovision') {
            $status = $this->Edge_model->reprovision($id, $serialnumber);
            //echo $status;exit;
            if ($status == true) {
                $this->session->set_flashdata('success_msg', 'Edge reprovision request raised. Edge will reprovision shortly !');
            } elseif ($status == false) {
                $this->session->set_flashdata('error_msgs', 'There is some error in Edge reprovision request. Please ret again');
            }
        }

        if ($job == 'reset_sdwan') {
            $jobs = array('ifdown wg0', 'ifup wg0', 'ifdown vxlan0', 'ifdown vx_vlan_br0', 'ifup vxlan0', 'ifup vx_vlan_br0', 'ifconfig wg0 mtu 1280');

            for ($i = 0; $i < count($jobs); ++$i) {
                $status = $this->Edge_model->reboot($serialnumber, $jobs[$i]);
            }

            //echo $status;exit;
            if ($status == true) {
                $this->session->set_flashdata('success_msg', 'Edge reset SDWAN request raised. Edge will reset SDWAN service shortly !');
            } elseif ($status == false) {
                $this->session->set_flashdata('error_msgs', 'There is some error in Edge reset request. Please ret again');
            }
        }

        $this->Edge_model->reboot($serialnumber, 'uci commit smoad');
    }

    public function edge_config()
    {
        $id                  = $this->uri->segment('3');
        $data['all_info']    = $this->Edge_model->get_edge_info($id);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/edge_config', $data);
    }

    public function status()
    {

        $data['id']                                        = $this->uri->segment('3');
        $data['sno']                                       = $this->uri->segment('4');
        $data['network_cfg']                               = $this->Edge_model->networkcfg($data['sno']);
        $data['last_24_port_up_count']                     = $this->Edge_model->get24HrsStatsCount($data['sno']);
        $data['get_last_24_port_down_count']               = $this->Edge_model->get_last_24_port_down_count($data['sno']);
        $data['device_info']                               = $this->Edge_model->get_device_details($data['sno']);
        $data['device_dash_pie_chart_data']                = $this->Edge_model->get_dash_pie_chart_info($data['sno']);
        $data['link_status_wan_up_count_timestamp_data']   = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_wan_up_count');
        $data['link_status_wan2_up_count_timestamp_data']  = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_wan2_up_count');
        $data['link_status_wan3_up_count_timestamp_data']  = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_wan3_up_count');
        $data['link_status_sdwan_up_count_timestamp_data'] = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_sdwan_up_count');
        $data['link_status_lte1_up_count_timestamp_data']  = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_lte1_up_count');
        $data['link_status_lte2_up_count_timestamp_data']  = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_lte2_up_count');
        $data['link_status_lte3_up_count_timestamp_data']  = $this->Edge_model->get_last_port_up_count_timestamp($data['sno'], 'link_status_lte3_up_count');

        $data['link_status_wan_down_count_timestamp_data']   = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_wan_down_count');
        $data['link_status_wan2_down_count_timestamp_data']  = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_wan2_down_count');
        $data['link_status_wan3_down_count_timestamp_data']  = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_wan3_down_count');
        $data['link_status_sdwan_down_count_timestamp_data'] = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_sdwan_down_count');
        $data['link_status_lte1_down_count_timestamp_data']  = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_lte1_down_count');
        $data['link_status_lte2_down_count_timestamp_data']  = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_lte2_down_count');
        $data['link_status_lte3_down_count_timestamp_data']  = $this->Edge_model->get_last_port_down_count_timestamp($data['sno'], 'link_status_lte3_down_count');
        // echo '<pre>';
        // print_r($data);
        // exit;
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/status', $data);
    }

    public function port_status()
    {
        $id                  = $this->uri->segment('3');
        $sno                 = $this->uri->segment('4');
        $wanport             = $this->uri->segment('5');
        $data['device_info'] = $this->Edge_model->get_device_details($sno);
        $data['redirect']    = $this->uri->segment('6');
        $data['wanport']     = $wanport;
        $data['id']          = $id;
        $data['sno']         = $sno;
        $data['port_info']   = $this->Edge_model->getPortInfo($sno, $wanport);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>";
        //print_r($data);exit;
        $this->load->view('edge/port_status', $data);
    }

    public function save_port_status()
    {

        $id       = $this->input->post('id');
        $sno      = $this->input->post('sno');
        $redirect = $this->input->post('redirect');
        $wanport  = $this->input->post('wanport');

        $port_info = $this->Edge_model->getPortInfo($sno, $wanport);
        //echo '<pre>'; print_r($port_info);exit;
        $os_info = $this->Edge_model->getOsInfo($sno);
        $os      = '';
        foreach ($os_info as $info) {
            $os = $info->os;
        }
        $_proto = $this->input->post('proto');
        //  echo $_proto;exit;
        $_config_update = false;
        foreach ($port_info as $info) {
            if ($info->_wan_proto != $_proto) {
                if ($_proto == "static" || $_proto == "dhcp" || $_proto == "pppoe") {
                    if ($os == "openwrt") {
                        $job = "uci set network." . $wanport . ".proto=^" . $_proto . "^";
                    } elseif ($os == "ubuntu") {
                        $job = "network." . $wanport . ".proto=^" . $_proto . "^";
                    }
                    $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                    $_config_update = true;
                }
            }
            $_ipaddr = $this->input->post('ipaddr');

            if ($info->_wan_ipaddr != $_ipaddr) {

                if ($_ipaddr != 'not set') {
                    $this->form_validation->set_rules('ipaddr', 'ipaddr', 'valid_ip');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata('error_msgs', validation_errors());
                        if ($redirect == 'status') {
                            redirect('Edge/port_status/' . $id . '/' . $sno . '/' . $wanport . '/status');
                        } else {
                            redirect('Edge/port_status/' . $id . '/' . $sno . '/' . $wanport . '/config');
                        }
                    }
                }

                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".ipaddr=^" . $_ipaddr . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".ipaddr=^" . $_ipaddr . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }
            $_netmask = $this->input->post('netmask');

            if ($info->_wan_netmask != $_netmask) {
                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".netmask=^" . $_netmask . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".netmask=^" . $_netmask . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_gateway = $this->input->post('gateway');

            if ($info->_wan_gateway != $_gateway) {
                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".gateway=^" . $_gateway . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".gateway=^" . $_gateway . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_dns = $this->input->post('dns');

            if ($info->_wan_dns != $_dns) {
                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".dns=^" . $_dns . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".dns=^" . $_dns . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_username = $this->input->post('username');

            if ($info->_wan_username != $_username) {
                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".username=^" . $_username . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".username=^" . $_username . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_password = $this->input->post('password');

            if ($info->_wan_password != $_password) {
                if ($os == "openwrt") {
                    $job = "uci set network." . $wanport . ".password=^" . $_password . "^";
                } elseif ($os == "ubuntu") {
                    $job = "network." . $wanport . ".password=^" . $_password . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_max_bandwidth = $this->input->post('max_bandwidth');

            if ($info->_max_bandwidth != $_max_bandwidth) {
                if ($os == "openwrt") {
                    $job = "uci set smoad.qos." . $wanport . "_max_bandwidth=^" . $_max_bandwidth . "^";
                } elseif ($os == "ubuntu") {
                    $job = "smoad.qos." . $wanport . "_max_bandwidth=^" . $_max_bandwidth . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_medium_bandwidth_pct = $this->input->post('medium_bandwidth_pct');

            if ($info->_medium_bandwidth_pct != $_medium_bandwidth_pct) {
                if ($os == "openwrt") {
                    $job = "uci set smoad.qos." . $wanport . "_medium_bandwidth_pct=^" . $_medium_bandwidth_pct . "^";
                } elseif ($os == "ubuntu") {
                    $job = "smoad.qos." . $wanport . "_medium_bandwidth_pct=^" . $_medium_bandwidth_pct . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            $_low_bandwidth_pct = $this->input->post('low_bandwidth_pct');

            if ($info->_low_bandwidth_pct != $_low_bandwidth_pct) {
                if ($os == "openwrt") {
                    $job = "uci set smoad.qos." . $wanport . "_low_bandwidth_pct=^" . $_low_bandwidth_pct . "^";
                } elseif ($os == "ubuntu") {
                    $job = "smoad.qos." . $wanport . "_low_bandwidth_pct=^" . $_low_bandwidth_pct . "^";
                }
                $status         = $this->Edge_model->smZtpAddJob($sno, $job);
                $_config_update = true;
            }

            if ($_config_update) {
                if ($os == "openwrt") {
                    $status = $this->Edge_model->smZtpAddJob($sno, 'uci commit network');
                    $status = $this->Edge_model->smZtpAddJob($sno, 'uci commit smoad');
                    $status = $this->Edge_model->smZtpAddJob($sno, "ifup $wanport");
                } elseif ($os == "ubuntu") {
                    $status = $this->Edge_model->smZtpAddJob($sno, "sudo netplan apply");
                }
            }

            // if ($status == true) {
            //     $this->session->set_flashdata('delete_msg_success', 'The job has been deleted successfully');
            // } else {
            //     $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a job. Please try again later.');
            // }
        }
        $wanport_proto                = $wanport . '_proto';
        $wanport_ipaddr               = $wanport . '_ipaddr';
        $wanport_netmask              = $wanport . '_netmask';
        $wanport_gateway              = $wanport . '_gateway';
        $wanport_dns                  = $wanport . '_dns';
        $wanport_username             = $wanport . '_username';
        $wanport_password             = $wanport . '_password';
        $wanport_max_bandwidth        = $wanport . '_max_bandwidth';
        $wanport_medium_bandwidth_pct = $wanport . '_medium_bandwidth_pct';
        $wanport_low_bandwidth_pct    = $wanport . '_low_bandwidth_pct';

        $data[$wanport_proto]                = $_proto;
        $data[$wanport_ipaddr]               = $_ipaddr;
        $data[$wanport_netmask]              = $_netmask;
        $data[$wanport_gateway]              = $_gateway;
        $data[$wanport_dns]                  = $_dns;
        $data[$wanport_username]             = $_username;
        $data[$wanport_password]             = $_password;
        $data[$wanport_max_bandwidth]        = $_max_bandwidth;
        $data[$wanport_medium_bandwidth_pct] = $_medium_bandwidth_pct;
        $data[$wanport_low_bandwidth_pct]    = $_low_bandwidth_pct;
        //echo "<pre>"; print_r($data);exit;
        $update_status = $this->Edge_model->updatePortStatus($sno, $data);
        //  echo $update_status;exit;
        if ($update_status == 'true') {
            $this->session->set_flashdata('success_msg', 'The details has been updated successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a error in updating details. Please try again later.');
        }
        if ($redirect == 'status') {
            redirect('Edge/port_status/' . $id . '/' . $sno . '/' . $wanport . '/status');
        } else {
            redirect('Edge/port_status/' . $id . '/' . $sno . '/' . $wanport . '/config');
        }
    }

    public function ztp_dev_lan()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['lan_info']    = $this->Edge_model->get_lan_data_by_sno($data['sno']);
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/ztp_dev_lan', $data);
    }

    public function ztp_dev_qos_app_prio()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['app_info']    = $this->Edge_model->get_ztp_dev_qos_app_prio($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/ztp_dev_qos_app_prio', $data);
    }

    public function ztp_dev_qos()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['app_info']    = $this->Edge_model->get_ztp_dev_qos_app_prio($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/ztp_dev_qos', $data);
    }

    public function save_ztp_dev_qos_app_prio()
    {
        $id  = $this->uri->segment('3');
        $sno = $this->uri->segment('4');

        $_config_update = false;
        $_id            = $this->input->post('id');

        $_qos_microsoft_teams        = $this->input->post('qos_microsoft_teams');
        $_qos_microsoft_teams_before = $this->input->post('qos_microsoft_teams_before');
        if ($_qos_microsoft_teams_before != $_qos_microsoft_teams && $_qos_microsoft_teams != null && $_id != null) {
            $data['qos_microsoft_teams'] = $_qos_microsoft_teams;
            $job                         = "uci set smoad.qos.microsoft_teams=^" . $_qos_microsoft_teams . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_youtube        = $this->input->post('qos_youtube');
        $_qos_youtube_before = $this->input->post('qos_youtube_before');
        if ($_qos_youtube_before != $_qos_youtube && $_qos_youtube != null && $_id != null) {
            $data['qos_youtube'] = $_qos_youtube;
            $job                 = "uci set smoad.qos.youtube=^" . $_qos_youtube . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_zoom        = $this->input->post('qos_zoom');
        $_qos_zoom_before = $this->input->post('qos_zoom_before');
        if ($_qos_zoom_before != $_qos_zoom && $_qos_zoom != null && $_id != null) {
            $data['qos_zoom'] = $_qos_zoom;
            $job              = "uci set smoad.qos.zoom=^" . $_qos_zoom . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_iperf        = $this->input->post('qos_iperf');
        $_qos_iperf_before = $this->input->post('qos_iperf_before');
        if ($_qos_iperf_before != $_qos_iperf && $_qos_iperf != null && $_id != null) {
            $data['qos_iperf'] = $_qos_iperf;
            $job               = "uci set smoad.qos.iperf=^" . $_qos_iperf . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_voip        = $this->input->post('qos_voip');
        $_qos_voip_before = $this->input->post('qos_voip_before');
        if ($_qos_voip_before != $_qos_voip && $_qos_voip != null && $_id != null) {
            $data['qos_voip'] = $_qos_voip;
            $job              = "uci set smoad.qos.voip=^" . $_qos_voip . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_skype        = $this->input->post('qos_skype');
        $_qos_skype_before = $this->input->post('qos_skype_before');
        if ($_qos_skype_before != $_qos_skype && $_qos_skype != null && $_id != null) {
            $data['qos_skype'] = $_qos_skype;
            $job               = "uci set smoad.qos.skype=^" . $_qos_skype . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        $_qos_sdwan        = $this->input->post('qos_sdwan');
        $_qos_sdwan_before = $this->input->post('qos_sdwan_before');
        if ($_qos_sdwan_before != $_qos_sdwan && $_qos_sdwan != null && $_id != null) {
            $data['qos_sdwan'] = $_qos_sdwan;
            $job               = "uci set smoad.qos.sdwan=^" . $_qos_sdwan . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        if ($_config_update) {
            $this->Edge_model->sm_ztp_add_job($sno, "uci commit smoad");
        }

        $status = '';
        if ($_config_update) {
            $status = $this->Edge_model->update_edge($data, $_id);
        } else {
            $status = 'no changes';
        }

        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'The details has been updated successfully!');
        } elseif ($status == 'no changes') {
            $this->session->set_flashdata('error_msgs', 'Please change the status of select boxes and try to update..');
        } else {
            $this->session->set_flashdata('error_msgs', 'There are some errors is updating the details. Please try again!');
        }
        redirect('Edge/ztp_dev_qos_app_prio/' . $id . '/' . $sno);
    }

    public function save_ztp_dev_qos()
    {
        $id             = $this->uri->segment('3');
        $sno            = $this->uri->segment('4');
        $_config_update = false;
        $_id            = $this->input->post('id');

        $_qos_enabled        = $this->input->post('qos_enabled');
        $_qos_enabled_before = $this->input->post('qos_enabled_before');
        if ($_qos_enabled != "TRUE") {
            $_qos_enabled = "FALSE";
        } //make binary
        if (($_qos_enabled_before != $_qos_enabled) && $_id != null) {
            $data['qos_enabled'] = $_qos_enabled;
            if ($_qos_enabled == "TRUE") {
                $_qos_enabled_dev = 1;
            } else {
                $_qos_enabled_dev = 0;
            }
            $job = "uci set smoad.qos.enabled=^" . $_qos_enabled_dev . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $_config_update = true;
        }

        if ($_config_update) {
            $this->Edge_model->sm_ztp_add_job($sno, 'uci commit smoad');
        }
        $status = '';
        if (($_qos_enabled_before != $_qos_enabled) && $_id != null) {
            $status = $this->Edge_model->update_edge($data, $_id);
        } else {
            $status = 'no changes';
        }

        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'The details has been updated successfully!');
        } elseif ($status == 'no changes') {
            $this->session->set_flashdata('error_msgs', 'Please change the status of check box and try to update..');
        } else {
            $this->session->set_flashdata('error_msgs', 'There are some errors is updating the details. Please try again!');
        }
        redirect('Edge/ztp_dev_qos/' . $id . '/' . $sno);
    }

    public function save_ztp_dev_lan()
    {
        $id  = $this->uri->segment('3');
        $sno = $this->uri->segment('4');

        $this->form_validation->set_rules('lan_ipaddr', 'Ip Address', 'required|valid_ip');
        $this->form_validation->set_rules('lan_netmask', 'Netmask', 'required|valid_ip');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/ztp_dev_lan/' . $id . '/' . $sno);
        }

        $data['lan_ipaddr']  = $this->input->post('lan_ipaddr');
        $data['lan_netmask'] = $this->input->post('lan_netmask');
        $id                  = $this->input->post('id');

        $existing_data = $this->Edge_model->get_existing_id_info($sno);

        $lan_ipaddr  = '';
        $lan_netmask = '';

        $lan_ipaddr  = $existing_data->lan_ipaddr;
        $lan_netmask = $existing_data->lan_netmask;

        $this->Edge_model->save_ztp_dev_lan($id, $data);

        $this->session->set_flashdata('success_msg', 'Edge ZTP - LAN Settings has updated successfully.');

        // if ($data['lan_ipaddr'] != $lan_ipaddr) {
        //     $job = "uci set network.lan.ipaddr=^" . $data['lan_ipaddr'] . "^";
        //     $this->Edge_model->sm_ztp_add_job($sno, $job);
        // }

        // if ($data['lan_netmask'] != $lan_netmask) {
        //     $job = "uci set network.lan.netmask=^" . $data['lan_netmask'] . "^";
        //     $this->Edge_model->sm_ztp_add_job($sno, $job);
        // }

        // $this->Edge_model->sm_ztp_add_job($sno, 'uci commit network');
        // $this->Edge_model->sm_ztp_add_job($sno, 'ifup lan');

        $os_info = $this->Edge_model->getOsInfo($sno);
        $os      = '';
        foreach ($os_info as $info) {
            $os = $info->os;
        }
        if ($data['lan_ipaddr'] != $lan_ipaddr) {
            if ($os == "openwrt") {
                $job = "uci set network.lan.ipaddr=^" . $data['lan_ipaddr'] . "^";
            } elseif ($os == "ubuntu") {
                $job = "network.lan.ipaddr=^" . $data['lan_ipaddr'] . "^";
            }
            if ($job != '') {
                $this->Edge_model->smZtpAddJob($sno, $job);
            }
            $_config_update = true;
        }

        if ($data['lan_netmask'] != $lan_netmask) {
            if ($os == "openwrt") {
                $job = "uci set network.lan.netmask=^" . $data['lan_netmask'] . "^";
            } elseif ($os == "ubuntu") {
                $job = "network.lan.netmask=^" . $data['lan_netmask'] . "^";
            }
            if ($job != '') {
                $this->Edge_model->smZtpAddJob($sno, $job);
            }
            $_config_update = true;
        }

        if ($_config_update) {
            if ($os == "openwrt") {
                $this->Edge_model->sm_ztp_add_job($sno, 'uci commit network');
                $this->Edge_model->sm_ztp_add_job($sno, 'ifup lan');
            } elseif ($os == "ubuntu") {
                $status = $this->Edge_model->smZtpAddJob($sno, "");
                $this->Edge_model->sm_ztp_add_job($sno, 'sudo netplan apply');
            }
        }

        redirect('Edge/ztp_dev_lan/' . $id . '/' . $sno);
    }

    public function ztp_dev_wan()
    {
        $data['wanport']     = 'wan';
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('Edge/ztp_dev_wan', $data);
    }

    public function ztp_dev_wireless()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['network_cfg'] = $this->Edge_model->get_network_cfg_info($data['sno']);
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('edge/ztp_dev_wireless', $data);
    }

    public function save_ztp_dev_wireless()
    {

        $id  = $this->uri->segment('3');
        $sno = $this->uri->segment('4');

        $this->form_validation->set_rules('ssid', 'ssid', 'required');

        if ($this->input->post('encryption_before') == "wpa" || $this->input->post('encryption_before') == "wpa2") {
            $this->form_validation->set_rules('wireless_auth_server', 'wireless auth server', 'required');
            $this->form_validation->set_rules('wireless_auth_secret', 'wireless auth secret', 'required');
        } else {
            $this->form_validation->set_rules('key', 'key', 'required');
        }
        $this->form_validation->set_rules('encryption', 'encryption', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/ztp_dev_wireless/' . $id . '/' . $sno);
        }

        $data['wireless_ssid']        = $this->input->post('ssid');
        $data['wireless_key']         = $this->input->post('key');
        $data['wireless_auth_server'] = $this->input->post('wireless_auth_server');
        $data['wireless_auth_secret'] = $this->input->post('wireless_auth_secret');
        $data['wireless_encryption']  = $this->input->post('encryption');

        $id = $this->input->post('id');

        $status = $this->Edge_model->save_ztp_dev_wireless($id, $data);

        if ($status == true) {
            $this->session->set_flashdata('success_msg', 'The ztp details has been updated successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in updating the details. Please try again later.');
        }
        $config = false;
        if ($data['wireless_ssid'] != $this->input->post('ssid_before')) {
            $job = "uci set wireless.default_radio0.ssid=^" . $data['wireless_ssid'] . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $config = true;
        }

        if ($data['wireless_key'] != $this->input->post('key_before')) {
            $job = "uci set wireless.default_radio0.key=^" . $data['wireless_key'] . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $config = true;
        }

        if ($data['wireless_auth_server'] != $this->input->post('wireless_auth_server_before')) {
            $job = "uci set wireless.default_radio0.auth_server=^" . $data['wireless_auth_server'] . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $config = true;
        }

        if ($data['wireless_auth_secret'] != $this->input->post('wireless_auth_secret_before')) {
            $job = "uci set wireless.default_radio0.auth_secret=^" . $data['wireless_auth_secret'] . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $config = true;
        }

        if ($data['wireless_encryption'] != $this->input->post('encryption_before')) {
            $job = "uci set wireless.default_radio0.encryption=^" . $data['wireless_encryption'] . "^";
            $this->Edge_model->sm_ztp_add_job($sno, $job);
            $config = true;
        }

        if ($config == true) {
            $this->Edge_model->sm_ztp_add_job($sno, 'uci commit');
            $this->Edge_model->sm_ztp_add_job($sno, 'uci commit network');
            $this->Edge_model->sm_ztp_add_job($sno, 'uci commit wireless');
            $this->Edge_model->sm_ztp_add_job($sno, 'ifup lan');
        }

        redirect('Edge/ztp_dev_wireless/' . $id . '/' . $sno);
    }

    public function ztp_dev_sdwan()
    {

        $data['id']             = $this->uri->segment('3');
        $data['sno']            = $this->uri->segment('4');
        $data['device_details'] = $this->Edge_model->get_device_details($data['sno']);
        $data['device_info']    = $this->Edge_model->get_device_info($data['sno']);
        $data['alerts_info']    = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']     = $this->Edge_model->getAlertsCount();
        //echo '<pre>'; print_r($data);exit;
        $this->load->view('edge/ztp_dev_sdwan', $data);
    }

    public function save_ztp_dev_agg()
    {
        $device_id              = $this->uri->segment('3');
        $device_sno             = $this->uri->segment('4');
        $agg_id                 = $this->input->post('id');
        $data['aggpolicy']      = $this->input->post('aggpolicy');
        $data['aggpolicy_mode'] = $this->input->post('aggpolicy_mode');
        $status                 = $this->Edge_model->save_device_info($agg_id, $data, 'smoad_device_network_cfg');
        $_config_update         = false;

        if ($data['aggpolicy'] != $this->input->post('aggpolicy_before')) {
            $job            = "uci set smoad.device.aggpolicy=^" . $data['aggpolicy'] . "^";
            $status         = $this->Edge_model->sm_ztp_add_job($device_sno, $job);
            $_config_update = true;
        }

        if ($data['aggpolicy_mode'] != $this->input->post('aggpolicy_mode_before')) {
            $job            = "uci set smoad.device.aggpolicy_mode=^" . $data['aggpolicy_mode'] . "^";
            $status         = $this->Edge_model->sm_ztp_add_job($device_sno, $job);
            $_config_update = true;
        }

        if ($_config_update) {
            $status = $this->Edge_model->sm_ztp_add_job($device_sno, "uci commit");
            $status = $this->Edge_model->sm_ztp_add_job($device_sno, "uci commit smoad");
            $status = $this->Edge_model->sm_ztp_add_job($device_sno, "uci commit mwan3");
            $status = $this->Edge_model->sm_ztp_add_job($device_sno, "uci commit network");
        }

        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'The details has been updated successfully!');
        } else {
            $this->session->set_flashdata('error_msgs', 'There are some errors is updating the details. Please try again!');
        }
        redirect('Edge/ztp_dev_agg/' . $device_id . '/' . $device_sno);
    }

    public function ztp_dev_firmware()
    {
        $data['id']            = $this->uri->segment('3');
        $data['sno']           = $this->uri->segment('4');
        $data['device_info']   = $this->Edge_model->get_device_details($data['sno']);
        $data['firmware_info'] = $this->Edge_model->ztp_dev_firmware($data['id']);
        $data['alerts_info']   = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']    = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/ztp_dev_firmware', $data);
    }

    
    public function save_ztp_dev_sdwan()
    {

        $data['id']  = $this->uri->segment('3');
        $data['sno'] = $this->uri->segment('4');

        $this->form_validation->set_rules('sdwan_link_high_usage_threshold', 'sdwan link high usage threshold', 'required|decimal');
        $this->form_validation->set_rules('sdwan_link_high_latency_threshold', 'sdwan link high latency threshold', 'required|decimal');
        $this->form_validation->set_rules('sdwan_link_high_jitter_threshold', 'sdwan link high jitter threshold', 'required|decimal');
        $this->form_validation->set_rules('qos_sdwan', 'qos sdwan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Edge/ztp_dev_sdwan/' . $data['id'] . '/' . $data['sno']);
        }
        $_config_update       = false;
        $smoad_device_changes = false;

        if ($this->input->post('sdwan_enable') == 'on') {
            $enable = "TRUE";
        } else {
            $enable = "FALSE";
        }

        if ($enable != $this->input->post('sdwan_enable_before')) {

            $device['sdwan_enable'] = $enable;
            if ($device['sdwan_enable'] == "TRUE") {
                $_sdwan_enable_dev = 1;
            } else {
                $_sdwan_enable_dev = 0;
            }
            $job = "uci set smoad.device.sdwan_enable=^" . $_sdwan_enable_dev . "^";
            $this->Edge_model->sm_ztp_add_job($data['sno'], $job);
            $job = "uci set smoad.device.wg=^" . $_sdwan_enable_dev . "^";
            $this->Edge_model->sm_ztp_add_job($data['sno'], $job);
            $_config_update       = true;
            $smoad_device_changes = true;
        }

        if ($this->input->post('qos_sdwan') != $this->input->post('qos_sdwan_before')) {
            $device['qos_sdwan'] = $this->input->post('qos_sdwan');
            $job                 = "uci set smoad.qos.sdwan=^" . $device['qos_sdwan'] . "^";
            $this->Edge_model->sm_ztp_add_job($data['sno'], $job);
            $_config_update       = true;
            $smoad_device_changes = true;
        }

        if ($smoad_device_changes == true) {
            $status = $this->Edge_model->save_device_info($data['id'], $device, 'smoad_devices');
        }

        if ($_config_update) {
            $this->Edge_model->sm_ztp_add_job($data['sno'], 'uci commit smoad');
            $this->Edge_model->sm_ztp_add_job($data['sno'], 'uci commit network"');
            $this->Edge_model->sm_ztp_add_job($data['sno'], 'ifup wg0');
        }

        $smoad_device_network_cfg_changes = false;

        if ($this->input->post('sdwan_link_high_usage_threshold') != $this->input->post('sdwan_link_high_usage_threshold_before')) {
            $network_cfg['sdwan_link_high_usage_threshold'] = $this->input->post('sdwan_link_high_usage_threshold');
            $network_cfg['sdwan_link_high_usage']           = 'notset';
            $smoad_device_network_cfg_changes               = true;
        }

        if ($this->input->post('sdwan_link_high_latency_threshold') != $this->input->post('sdwan_link_high_latency_threshold_before')) {
            $network_cfg['sdwan_link_high_latency_threshold'] = $this->input->post('sdwan_link_high_latency_threshold');
            $network_cfg['sdwan_link_high_latency']           = 'notset';
            $smoad_device_network_cfg_changes                 = true;
        }

        if ($this->input->post('sdwan_link_high_jitter_threshold') != $this->input->post('sdwan_link_high_jitter_threshold_before')) {
            $network_cfg['sdwan_link_high_jitter_threshold'] = $this->input->post('sdwan_link_high_jitter_threshold');
            $network_cfg['sdwan_link_high_jitter']           = 'notset';
            $smoad_device_network_cfg_changes                = true;
        }

        $id_smoad_device_network_cfg = $this->input->post('id_smoad_device_network_cfg');

        if ($smoad_device_network_cfg_changes == true) {
            $status = $this->Edge_model->save_device_info($id_smoad_device_network_cfg, $network_cfg, 'smoad_device_network_cfg');
        }

        if ($status == true) {
            $this->session->set_flashdata('success_msg', 'The ztp details has been updated successfully');
        } elseif ($status == false) {
            $this->session->set_flashdata('error_msgs', 'There is a problem in updating the details. Please try again later.');
        } else {
            $this->session->set_flashdata('error_msgs', 'No new changes found');
        }

        redirect('Edge/ztp_dev_sdwan/' . $data['id'] . '/' . $data['sno']);
    }

    public function ztp_dev_consolidated_log()
    {
        $data['id']                = $this->uri->segment('3');
        $data['sno']               = $this->uri->segment('4');
        $data['device_info']       = $this->Edge_model->get_device_details($data['sno']);
        $data['consolidated_logs'] = $this->Edge_model->get_consolidated_logs($data['sno']);
        $data['alerts_info']       = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']        = $this->Edge_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('edge/ztp_dev_consolidated_log', $data);
    }

    public function get_logs_info()
    {
        $sno     = $this->input->post('sno');
        $edge_id = $this->input->post('id');
        $page    = $this->input->post('page');

        if ($page == 'consolidated_log') {
            $page_info = $this->Edge_model->get_consolidated_logs($sno);
        } else {
            $page_info = $this->Edge_model->get_logs_info($page, $sno);
        }

        $table_content = '';

        if ($page == 'link_status') {
            $table_content .= '<table id="link_status" class="table table-bordered table-hover log_table"><thead>
            <tr>
                <th>ID</th>
                <th>WAN</th>
                <th>WAN2</th>
                <th>LTE1</th>
                <th>LTE2</th>
                <th>LTE3</th>
                <th>Switch-Over</th>
                <th>Ticket Generated</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody class="contest_lst">';
            foreach ($page_info as $info) {

                if ($info->signal_strength_lte1 == 'excellent') {
                    $signal_strength_lte1 = '<div style="display: inline-block;background-color:#00baad;width:26px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte1 == 'good') {
                    $signal_strength_lte1 = '<div style="display: inline-block;background-color:#add45c;width:22px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte1 == 'fair') {
                    $signal_strength_lte1 = '<div style="display: inline-block;background-color:#FF5733;width:18px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte1 == 'bad') {
                    $signal_strength_lte1 = '<div style="display: inline-block;background-color:#C70039;width:14px;height:8px;border-radius:2px;"></div>';
                } else {
                    $signal_strength_lte1 = 'error';
                }

                if ($info->signal_strength_lte2 == 'excellent') {
                    $signal_strength_lte2 = '<div style="display: inline-block;background-color:#00baad;width:26px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte2 == 'good') {
                    $signal_strength_lte2 = '<div style="display: inline-block;background-color:#add45c;width:22px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte2 == 'fair') {
                    $signal_strength_lte2 = '<div style="display: inline-block;background-color:#FF5733;width:18px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte2 == 'bad') {
                    $signal_strength_lte2 = '<div style="display: inline-block;background-color:#C70039;width:14px;height:8px;border-radius:2px;"></div>';
                } else {
                    $signal_strength_lte2 = 'error';
                }

                if ($info->signal_strength_lte3 == 'excellent') {
                    $signal_strength_lte3 = '<div style="display: inline-block;background-color:#00baad;width:26px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte3 == 'good') {
                    $signal_strength_lte3 = '<div style="display: inline-block;background-color:#add45c;width:22px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte3 == 'fair') {
                    $signal_strength_lte3 = '<div style="display: inline-block;background-color:#FF5733;width:18px;height:8px;border-radius:2px;"></div>';
                } elseif ($info->signal_strength_lte3 == 'bad') {
                    $signal_strength_lte3 = '<div style="display: inline-block;background-color:#C70039;width:14px;height:8px;border-radius:2px;"></div>';
                } else {
                    $signal_strength_lte3 = 'error';
                }

                $table_content .= '<tr><td>' . $info->id . '</td><td>Link: ' . $info->link_status_wan . '<br>Duplex: ' . $info->wan1_duplex . '<br>Speed: ' . $info->wan1_speed . '<br>Bw %: ' . $info->wan1_bw_dist_pct . '</td><td>Link: ' . $info->link_status_wan2 . '<br>Duplex: ' . $info->wan2_duplex . '<br>Speed: ' . $info->wan2_speed . '<br>Bw %: ' . $info->wan2_bw_dist_pct . '</td><td>Link: ' . $info->link_status_lte1 . '<br>Signal: ' . $signal_strength_lte1 . '
                 <br>Bw %: ' . $info->lte1_bw_dist_pct . '<br>Bw %: ' . $info->lte1_bw_dist_pct . '</td><td>Link: ' . $info->link_status_lte2 . '<br>Signal: ' . $signal_strength_lte2 . '<br>Bw %: ' . $info->lte2_bw_dist_pct . '</td> <td>Link: ' . $info->link_status_lte3 . '<br>Signal: ' . $signal_strength_lte3 . '<br>Bw %: ' . $info->lte3_bw_dist_pct . '</td><td>' . $info->link_switch_over . '</td><td>' . $info->ticket_generated . '</td><td>' . $info->log_timestamp . '</td></tr>';
            }
        } elseif ($page == 'network_status') {
            $table_content .= '<table id="network_status" class="table table-bordered table-hover log_table"><thead>
            <tr>
                <th>ID</th>
                <th>LAN</th>
                <th>WAN1</th>
                <th>WAN2</th>
                <th>LTE1</th>
                <th>LTE2</th>
                <th>LTE3</th>
                <th>SD-WAN</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody class="contest_lst">';

            foreach ($page_info as $info) {
                $table_content .= '<tr><td>' . $info['id'] . '</td><td>RxB' . $info['lan_rx_bytes'] . '<br>RxP ' . $info['lan_rx_pkts'] . '<br>RxD ' . $info['lan_rx_drop'] . '<br>Rate' . $info['lan_rx_bytes_rate'] . '<br><br> TxB ' . $info['lan_tx_bytes'] . '<br>TxP ' . $info['lan_tx_pkts'] . '<br>TxD' . $info['lan_tx_drop'] . '<br>Rate ' . $info['lan_tx_bytes_rate'] . '<br></td><td>RxB ' . $info['wan1_rx_bytes'] . '<br>RxP ' . $info['wan1_rx_pkts'] . '<br>RxD ' . $info['wan1_rx_drop'] . '<br>Rate ' . $info['wan1_rx_bytes_rate'] . '<br><br>
                TxB ' . $info['wan1_tx_bytes'] . '<br>TxP ' . $info['wan1_tx_pkts'] . '<br>TxD ' . $info['wan1_tx_drop'] . '<br>Rate ' . $info['wan1_tx_bytes_rate'] . '<br></td><td>RxB ' . $info['wan2_rx_bytes'] . '<br>RxP ' . $info['wan2_rx_pkts'] . '<br>RxD ' . $info['wan2_rx_drop'] . '<br>Rate' . $info['wan2_rx_bytes_rate'] . '<br><br> TxB ' . $info['wan2_tx_bytes'] . '<br>TxP ' . $info['wan2_tx_pkts'] . '<br>TxD ' . $info['wan2_tx_drop'] . '<br>Rate' . $info['wan2_tx_bytes_rate'] . '<br></td>' . '<td>RxB ' . $info['lte1_rx_bytes'] . '<br>RxP ' . $info['lte1_rx_pkts'] . '<br>RxD ' . $info['lte1_rx_drop'] . '<br>Rate ' . $info['lte1_rx_bytes_rate'] . '<br><br>TxB ' . $info['lte1_tx_bytes'] . '<br>TxP ' . $info['lte1_tx_pkts'] . '<br>TxD ' . $info['lte1_tx_drop'] . '<br>Rate ' . $info['lte1_tx_bytes_rate'] . '<br></td>' . '<td>RxB ' . $info['lte2_rx_bytes'] . '<br>RxP' . $info['lte2_rx_pkts'] . '<br>RxD ' . $info['lte2_rx_drop'] . '<br>Rate ' . $info['lte2_rx_bytes_rate'] . '<br><br>
                TxB ' . $info['lte2_tx_bytes'] . '<br>TxP ' . $info['lte2_tx_pkts'] . '<br>TxD ' . $info['lte2_tx_drop'] . '<br>Rate ' . $info['lte2_tx_bytes_rate'] . '<br><td>RxB ' . $info['lte3_rx_bytes'] . '<br>RxP ' . $info['lte3_rx_pkts'] . '<br>RxD ' . $info['lte3_rx_drop'] . '<br>Rate' . $info['lte3_rx_bytes_rate'] . '<br><br>TxB ' . $info['lte3_tx_bytes'] . '<br>TxP ' . $info['lte3_tx_pkts'] . '<br>TxD ' . $info['lte3_tx_drop'] . '<br>Rate' . $info['lte3_tx_bytes_rate'] . '<br></td>' . '</td><td>RxB' . $info['sdwan_rx_bytes'] . '<br>RxP ' . $info['sdwan_rx_pkts'] . '<br>RxD ' . $info['sdwan_rx_drop'] . '<br>Rate ' . $info['sdwan_rx_bytes_rate'] . '<br><br>
                TxB ' . $info['sdwan_tx_bytes'] . '<br>TxP ' . $info['sdwan_tx_pkts'] . '<br>TxD ' . $info['sdwan_tx_drop'] . '<br>Rate ' . $info['sdwan_tx_bytes_rate'] . '<br></td><td>' . $info['log_timestamp'] . '</td></tr>';
            }
        } elseif ($page == 'user_access') {
            $table_content .= '<table id="user_access" class="table table-bordered table-hover log_table"><thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Auth Status</th>
                <th>Access Type</th>
                <th>Timestamp</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="contest_lst">';

            foreach ($page_info as $info) {

                if ($this->session->userdata('accesslevel') == 'root') {
                    $baseurl = base_url('Edge/delete_log/' . $edge_id . '/' . $sno . '/' . $info->id);
                    $delete  = "<a href='$baseurl'><i class='fa fa-trash' aria-hidden='true' style='color:#000;cursor:pointer;'></i></a>";
                } else {
                    $delete = '';
                }
                $table_content .= '<tr>' . '<td>' . $info->id . '</td>' . '<td>' . $info->username . '</td>' . '<td>' . $info->auth_status . '</td>' . '<td>' . $info->access_type . '</td>' . '<td>' . $info->access_timestamp . '</td><td>' . $delete . '</td></tr>';
            }
        } elseif ($page == 'consolidated_log') {
            $table_content .= '<table id="consolidated_log" class="table table-bordered table-hover log_table"><thead>
            <tr>
                <th>ID</th>
                <th>BYTES</th>
                <th>RATE</th>
                <th>LINK STATUS UP-COUNT</th>
                <th>LATENCY</th>
                <th>JITTER</th>
                <th>TIMESTAMP</th>
            </tr>
        </thead>
        <tbody class="contest_lst">';

            foreach ($page_info as $log) {

                $table_content .= '<tr>
                <td>' . $log['id'] . ' </td>

                <td><strong>WAN1: </strong><br>Rx' . $log['sum_wan1_rx_bytes'] . ' <br>Tx' . $log['sum_wan1_tx_bytes'] . ' <br> <strong>WAN2: </strong> <br>Rx' . $log['sum_wan2_rx_bytes'] . ' <br>Tx' . $log['sum_wan2_tx_bytes'] . ' <br> <strong>LTE1: </strong> <br>Rx' . $log['sum_lte1_rx_bytes'] . ' <br>Tx' . $log['sum_lte1_tx_bytes'] . ' <br> <strong>LTE2: </strong> <br>Rx' . $log['sum_lte2_rx_bytes'] . ' <br>Tx' . $log['sum_lte1_tx_bytes'] . ' <br> <strong>LTE3: </strong><br>Rx' . $log['sum_lte3_rx_bytes'] . ' <br>Tx' . $log['sum_lte3_tx_bytes'] . ' <br> <strong>SD-WAN: </strong><br>Rx' . $log['sum_lte3_rx_bytes'] . ' <br>Tx' . $log['sum_sdwan_tx_bytes'] . ' <br></td>


                <td><strong>WAN1: </strong><br>Rx' . $log['avg_wan1_rx_bytes_rate'] . ' <br>Tx' . $log['avg_wan1_tx_bytes_rate'] . '<br><strong>WAN2: </strong><br>Rx' . $log['avg_wan2_rx_bytes_rate'] . ' <br>Tx' . $log['avg_wan2_tx_bytes_rate'] . '<br><strong>LTE1: </strong><br>Rx' . $log['avg_lte1_rx_bytes_rate'] . '<br>Tx' . $log['avg_lte1_tx_bytes_rate'] . '<br><strong>LTE2: </strong><br>Rx' . $log['avg_lte2_rx_bytes_rate'] . ' <br>Tx' . $log['avg_lte2_tx_bytes_rate'] . '<br> <strong>LTE3: </strong><br>Rx' . $log['avg_lte3_rx_bytes_rate'] . ' <br>Tx' . $log['avg_lte3_tx_bytes_rate'] . '<br> <strong>SD-WAN: </strong><br>Rx' . $log['avg_sdwan_rx_bytes_rate'] . '<br>Tx' . $log['avg_sdwan_tx_bytes_rate'] . '<br></td>


                <td><strong>WAN1: </strong>' . $log['sum_link_status_wan_up_count'] . '<br><br><br><strong>WAN2: </strong>' . $log['sum_link_status_wan2_up_count'] . '<br><br><br><strong>LTE1: </strong>' . $log['sum_link_status_lte1_up_count'] . '<br><br><br><strong>LTE2: </strong>' . $log['sum_link_status_lte2_up_count'] . '<br><br><br><strong>LTE3: </strong>' . $log['sum_link_status_lte3_up_count'] . '<br><br><br>
                <strong>SD-WAN: </strong>' . $log['sum_link_status_sdwan_up_count'] . '<br><br><br></td>

                <td><strong>WAN1: </strong>' . $log['avg_wan1_latency'] . ' ms<br><br><br><strong>WAN2: </strong>' . $log['avg_wan2_latency'] . ' ms<br><br><br><strong>LTE1: </strong>' . $log['avg_lte1_latency'] . ' ms<br><br><br><strong>LTE2: </strong>' . $log['avg_lte2_latency'] . 'ms<br><br><br><strong>LTE3: </strong>' . $log['avg_lte3_latency'] . ' ms<br><br><br><strong>SD-WAN: </strong>' . $log['avg_sdwan_latency'] . ' ms<br><br><br></td>

                <td><strong>WAN1: </strong>' . $log['avg_wan1_jitter'] . '  ms<br><br><br><strong>WAN2: </strong>' . $log['avg_wan2_jitter'] . ' ms<br><br><br><strong>LTE1: </strong>' . $log['avg_lte1_jitter'] . ' ms<br><br><br><strong>LTE2: </strong>' . $log['avg_lte2_jitter'] . ' ms<br><br><br><strong>LTE3: </strong>' . $log['avg_lte3_jitter'] . ' ms<br><br><br><strong>SD-WAN: </strong>' . $log['avg_sdwan_jitter'] . ' ms<br><br><br></td>

                <td>' . $log['timestamp'] . '</td>

            </tr>';
            }
        }

        $table_content .= '</tbody></table>';
        echo $table_content;
    }

    public function delete_log()
    {
        $id     = $this->uri->segment('5');
        $status = $this->Edge_model->delete_log($id);

        if ($status == true) {
            $this->session->set_flashdata('success_msg', 'The user access log has been deleted successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in deleting a user access log. Please try again later.');
        }

        redirect('Edge/ztp_dev_consolidated_log/' . $this->uri->segment('3') . '/' . $this->uri->segment('4'));
    }

    public function ztp_dev_lte()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['lteport']     = $this->uri->segment('5');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['port_info']   = $this->Edge_model->get_port_info($data['lteport'], $data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/ztp_dev_lte', $data);
    }

    public function ztp_dev_agg()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['agg_data']    = $this->Edge_model->ztp_dev_agg($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/ztp_dev_agg', $data);
    }

    public function update_firmware()
    {
        $id     = $this->uri->segment('3');
        $sno    = $this->uri->segment('4');
        $status = $this->Edge_model->update_firmware($id, $sno);
        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'NOTE: the Edge will initiate firmware update task shortly (if any) !');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem with updating the firmware. Please try again later.');
        }

        redirect('Edge/ztp_dev_firmware/' . $id . '/' . $sno);
    }

    public function ztp_dev_debug_jobs()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['jobs_info']   = $this->Edge_model->get_ztp_dev_debug_jobs($data['sno']);
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/ztp_dev_debug_jobs', $data);
    }

    public function joblist()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['job_name']    = $this->uri->segment('5');
        $data['job_list']    = $this->Edge_model->get_job_list($data['job_name']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/ztp_dev_debug_smoad_device_jobs', $data);
    }

    public function ztp_dev_consolidated_report_index()
    {
        $data['id']              = $this->uri->segment('3');
        $data['sno']             = $this->uri->segment('4');
        $data['year_month_info'] = $this->Edge_model->get_date_month_info($data['sno']);
        $data['device_info']     = $this->Edge_model->get_device_details($data['sno']);
        $data['alerts_info']     = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']      = $this->Edge_model->getAlertsCount();
        // echo "<pre>";
        // print_r($data);
        // exit;
        $this->load->view('edge/ztp_dev_consolidated_report_index', $data);
    }

    public function ztp_dev_config()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['config_info'] = $this->Edge_model->get_config_info($data['id']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo '<pre>'; print_r($data);exit;
        $this->load->view('edge/ztp_dev_config', $data);
    }

    public function ztp_dev_firewall_log()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['device_info'] = $this->Edge_model->get_device_details($data['sno']);
        $data['log_info'] = $this->Edge_model->get_firewall_log_info($data['id']);
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        //echo '<pre>'; print_r($data);exit;
        $this->load->view('edge/ztp_dev_firewall_log', $data);
    }

    public function delete_firewall_log(){
        $log_id = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $sno = $this->uri->segment('5');
        $status = $this->Edge_model->delete_firewall_log($log_id);
        if ($status == 'true') {
            $this->session->set_flashdata('delete_msg_success', 'The log has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a log. Please try again later.');
        }
        redirect('Edge/ztp_dev_firewall_log/' . $id . '/' . $sno);
    }


    

    public function download_config()
    {
        $sno            = $this->uri->segment('3');
        $configFilePath = 'edge.config';
        $fileContent    = file_get_contents($configFilePath);

        // Remove style tags using string replacement
        $cleanedContent = preg_replace('/<style(.*?)<\/style>/is', '', $fileContent);

        $newFileName = 'SMOAD_edge_' . $sno . '.conf';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $newFileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($cleanedContent));
        echo $cleanedContent;
        exit;
    }

    public function install_dev_config_template()
    {
        $id          = $this->uri->segment('3');
        $sno         = $this->uri->segment('4');
        $template_id = $this->uri->segment('5');
        $status      = $this->Edge_model->install_dev_config_template($id, $sno, $template_id);
        //echo "<pre>"; print_r($status);exit;
        if ($status == 'true') {
            $this->session->set_flashdata('success_msg', 'SUCCESS: Device template successfully installed as the Edge config. Edge will reprovision shortly !');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem with installing edge config. Please try again later.');
        }
        system("php -f /usr/local/smoad/scripts/save_edge_config.php $sno > /dev/null");
        redirect('Edge/ztp_dev_config/' . $id . '/' . $sno);
    }

    public function add_ztp_dev_config()
    {
        $data['id']          = $this->uri->segment('3');
        $data['sno']         = $this->uri->segment('4');
        $data['alerts_info'] = $this->Edge_model->getAlertsInfo();
        $data['alerts_cnt']  = $this->Edge_model->getAlertsCount();
        $this->load->view('edge/add_ztp_dev_config', $data);
    }

    public function content_ztp_dev_fpdf_generation()
    {
        // Your PDF generation code
        // $this->pdf->AddPage();
        // $this->pdf->SetFont('Arial', 'B', 16);
        // $this->pdf->Cell(40, 10, 'Hello World!');

        // // Output the PDF content to a variable
        // $pdfContent = $this->pdf->Output('', 'S');

        // // Load the force_download helper
        // $this->load->helper('download');

        // // Set the desired file name
        // $filename = 'example.pdf';

        // // Send the PDF to the browser with the force_download helper
        // force_download($filename, $pdfContent);

        // require('fpdf.php');
        $sno         = $this->uri->segment('3');
        $date        = $this->uri->segment('4');
        $device_info = $this->Edge_model->get_device_details($sno);
        //echo '<pre>'; print_r($device_info);exit;

        foreach ($device_info as $info) {
            $G_device_serialnumber  = $info->serialnumber;
            $G_device_id            = $info->id;
            $G_device_details       = $info->details;
            $G_device_model         = $info->model;
            $G_device_model_variant = $info->model_variant;
        }

        $model         = $G_device_model;
        $model_variant = $G_device_model_variant;

        //if($G_device_serialnumber==null) { print "<b>Please login again !</b><br><br>Your session has timed out."; }
        $_model = $_model_variant = '';
        if ($model == "spider") {
            $_model = "SMOAD Spider";
        } elseif ($model == "spider2") {
            $_model = "SMOAD Spider2";
        } elseif ($model == "beetle") {
            $_model = "SMOAD Beetle";
        } elseif ($model == "bumblebee") {
            $_model = "SMOAD BumbleBee";
        } elseif ($model == "vm") {
            $_model = "SMOAD VM";
        }

        if ($model_variant == "l2") {
            $_model_variant = "L2 SD-WAN";
        } elseif ($model_variant == "l2w1l2") {
            $_model_variant = "L2 SD-WAN (L2W1L2)";
        } elseif ($model_variant == "l3") {
            $_model_variant = "L3 SD-WAN";
        } elseif ($model_variant == "mptcp") {
            $_model_variant = "MPTCP";
        }

        if ($this->sm_get_device_port_branching_by_serialnumber('LAN', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'lan';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('WAN', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'wan1';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('WAN2', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'wan2';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('WAN3', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'wan3';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('LTE1', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'lte1';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('LTE2', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'lte2';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('LTE3', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'lte3';
        }
        if ($this->sm_get_device_port_branching_by_serialnumber('SD-WAN', $G_device_model, $G_device_model_variant)) {
            $ports_array[] = 'sdwan';
        }
//        echo '<pre>';
        //   print_r($ports_array);exit;
        /*A4 width : 219mm*/
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetTitle('Monthly Consolidated Report');
        $pdf->SetY(0);
        $pdf->SetFont("Arial", "B", "13");
        $pdf->SetXY(5, $pdf->GetY() + 15);
        $x          = 15;
        $y          = 10;
        $CI         =& get_instance();
        $image_name = $CI->config->base_url() . 'assets/dist/img/smoad_rect_logo_5g.png';
        $pdf->Cell($x, $y, $pdf->Image($image_name, 10, 7, 33.78), 0, 0, 'L', false);

        $pageWidth  = 210;
        $pageHeight = 297;
        $pdf->SetFont("Arial", "B", "11");
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->Cell(10, 10, "Date: " . date("F j, Y"));

        $pdf->SetFont("Arial", "", "10");
        $pdf->SetXY(10, $pdf->GetY() + 7);
        $pdf->Cell($x, $y, "Serial Number: " . $G_device_serialnumber);

        $pdf->SetFont("Arial", "", "10");
        $pdf->SetXY(10, $pdf->GetY() + 7);
        $pdf->Cell($x, $y, "Details: " . $G_device_details);

        $pdf->SetFont("Arial", "", "10");
        $pdf->SetXY(10, $pdf->GetY() + 7);
        $pdf->Cell($x, $y, "Model: " . $_model);

        $pdf->SetFont("Arial", "", "10");
        $pdf->SetXY(10, $pdf->GetY() + 7);
        $pdf->Cell($x, $y, "Model Variant: " . $_model_variant);

        $pdf->SetFont("Arial", "B", "13");
        $pdf->SetXY(10, $pdf->GetY() + 18);
        //$pdf->SetFillColor(211,211,211);
        $pdf->Cell($x + 100, $y, "Consolidated Report For the Month: " . date('F, Y', strtotime($date)));

        $pdf->SetFont("Arial", "B", "12");
        $pdf->SetXY(10, $pdf->GetY() + 10);
        $pdf->Cell($x, $y + 2, "Total Data Transferred:");

        $border = 0;
        $pdf->SetFont("Arial", "", "10");
        $pdf->SetXY(12, $pdf->GetY() + 12);
        $pdf->SetFillColor(68, 68, 68);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(30, 10, 'Port', $border, 0, 'C', true);
        $pdf->Cell(30, 10, 'RX', $border, 0, 'C', true);
        $pdf->Cell(30, 10, 'TX', $border, 0, 'C', true);
        //$pdf->Cell(15 ,10,'Up',$border,0,'C', true);
        $pdf->Cell(15, 10, 'Down', $border, 0, 'C', true);

        $pdf->Cell(30, 10, 'Up Time', $border, 0, 'C', true);

        $pdf->Cell(20, 10, 'Latency', $border, 0, 'C', true);
        $pdf->Cell(25, 10, 'Jitter', $border, 1, 'C', true); /*end of line*/
        /*Heading Of the table end*/
        $pdf->SetFont('Arial', '', '10');
        //$pdf->Cell(10 ,10,"----------------------------",$border,0);
        $date = explode('-', $date);

        $pdf_info = $this->Edge_model->get_logs_by_sno($G_device_serialnumber, $date);
        //echo '<pre>'; print_r($pdf_info);exit;
        if (count($pdf_info) > 0) {
            foreach ($pdf_info as $info) {

                $rx_bytes_total  = 0;
                $tx_bytes_total  = 0;
                $upCount_total   = 0;
                $downCount_total = 0;
                $latencyAvg      = 0;
                $jitterAvg       = 0;

                for ($i = 0; $i < count($ports_array); ++$i) {
                    /*if (!$row['sum_'.$ports_array[$i].'_rx_bytes']) {
                    $row['sum_'.$ports_array[$i].'_rx_bytes'] = '-';
                    }*/

                    if ($i % 2 == 0) {
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                    $pdf->SetXY(12, $pdf->GetY());
                    //$pdf->SetFillColor(216,68,48); // do not remove
                    $pdf->SetFillColor(233, 239, 245);
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->Cell(30, 10, strtoupper($ports_array[$i]), $border, 0, 'C', $flag);
                    $rx_bytes_clm   = 'sum_' . $ports_array[$i] . '_rx_bytes';
                    $tx_bytes_clm   = 'sum_' . $ports_array[$i] . '_tx_bytes';
                    $up_count_clm   = 'sum_link_status_' . $ports_array[$i] . '_up_count';
                    $down_count_clm = 'sum_link_status_' . $ports_array[$i] . '_down_count';
                    // echo '<pre>';
                    // print_r($info);
                    // echo $up_count_clm . ' test';
                    if ($ports_array[$i] == 'lan') {
                        $rx_bytes      = '-';
                        $rx_bytes_unit = '';
                        $tx_bytes      = '-';
                        $tx_bytes_unit = '';
                        $downCount     = '-';
                        $latency_unit  = '-';
                        $jitter_unit   = '-';
                        $total_hrs     = '-';
                    } else {
                        $rx_bytes = $info->$rx_bytes_clm;
                        $tx_bytes = $info->$tx_bytes_clm;
                        $rx_bytes_total += $rx_bytes;
                        $tx_bytes_total += $tx_bytes;

                        $upCount   = $info->$up_count_clm;
                        $downCount = $info->$down_count_clm;

                        $upCount_total += $upCount;
                        $downCount_total += $downCount;

                        if ($downCount == null) {
                            $downCount = 0;
                        }
                        if ($upCount == null) {
                            $upCount = 0;
                        }

                        //GETTING NUMBER OF DAYS TO MINUTES IN MONTH USING COUNT OF ROW ENTRIES
                        $days_in_month    = $info->count_log_timestamp;
                        $minutes_in_month = $days_in_month * 1440; //MULTIPLYING BY 1440 GIVES US THE TOTAL MINUTES IN THE GIVEN DAYS
                                                                   //OLD CODE $minutes_in_month_for_percentage = bcdiv($minutes_in_month,100,3);
                        $minutes_in_month_for_percentage = round($minutes_in_month / 100, 3);

                        //LOGIC TO GET PERCENTAGE OF UP TIME IN A MONTH, AND TOTAL UP TIME FOR INDIVIDUAL PORTS
                        $repeat_up_count_clm     = 'sum_link_status_' . $ports_array[$i] . '_repeat_up_count';
                        $port_repeat_count       = $info->$repeat_up_count_clm;
                        $total_up_time_port_mins = $port_repeat_count * 2;

                        //OLD CODE $percentage_up_port = bcdiv($total_up_time_port_mins,$minutes_in_month_for_percentage,1);
                        $percentage_up_port = round($total_up_time_port_mins / $minutes_in_month_for_percentage, 1);
                        //OLD CODE $total_up_time_port_hours = intdiv($total_up_time_port_mins, 60).'H '.($total_up_time_port_mins % 60). 'M';
                        $total_up_time_port_hours = floor($total_up_time_port_mins / 60) . 'H ' . ($total_up_time_port_mins % 60) . 'M';

                        $latency_clm = 'avg_' . $ports_array[$i] . '_latency';

                        $latency = $info->$latency_clm;
                        $latencyAvg += $latency;
                        $jitter_clm = 'avg_' . $ports_array[$i] . '_jitter';
                        $jitter     = $info->$jitter_clm;
                        $jitterAvg += $jitter;
                        $rx_bytes_unit = $this->unit_conversion($rx_bytes);
                        $latency_unit  = round($latency, 2) . ' ms';
                        $jitter_unit   = round($jitter, 2) . ' ms';
                        $total_hrs     = $total_up_time_port_hours . " (" . $percentage_up_port . "%)";
                        $tx_bytes_unit = $this->unit_conversion($tx_bytes);
                    }
                    $pdf->Cell(30, 10, $rx_bytes . " " . $rx_bytes_unit, $border, 0, 'C', $flag);

                    $pdf->Cell(30, 10, $tx_bytes . " " . $tx_bytes_unit, $border, 0, 'C', $flag);
                    $pdf->Cell(15, 10, $downCount, $border, 0, 'C', $flag);
                    $pdf->Cell(30, 10, $total_hrs, $border, 0, 'C', $flag);
                    $pdf->Cell(20, 10, $latency_unit, $border, 0, 'C', $flag);
                    $pdf->Cell(25, 10, $jitter_unit, $border, 1, 'C', $flag);
                }
            }
        }

        $pdf->SetFont("Arial", "B", "12");
        $pdf->SetXY(10, $pdf->GetY() + 2 + count($ports_array) * 2);
        $pdf->Cell($x, $y + 2, "Day-wise breakup:");

        $pdf->SetFont("Arial", "", "9");
        $pdf->SetXY(12, $pdf->GetY() + 12);
        $pdf->SetFillColor(68, 68, 68);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(20, 10, 'Day', $border, 0, 'C', true);

        $pdf->Cell(32, 10, 'Port', $border, 0, 'C', true);
        $pdf->Cell(20, 10, 'RX', $border, 0, 'C', true);
        $pdf->Cell(20, 10, 'TX', $border, 0, 'C', true);
        //$pdf->Cell(15 ,10,'Up',$border,0,'C', true);
        $pdf->Cell(10, 10, 'Down', $border, 0, 'C', true);

        $pdf->Cell(22, 10, 'Up Time', $border, 0, 'C', true);

        $pdf->Cell(30, 10, 'Latency', $border, 0, 'C', true);
        $pdf->Cell(20, 10, 'Jitter', $border, 1, 'C', true); /*end of line*/

        $pdf->SetXY(12, $pdf->GetY());

        $log_ingo = $this->Edge_model->get_log_info($G_device_serialnumber, $date);
        // echo '<pre>';
        // print_r($log_ingo);exit;
        $count = 0;
        if (count($log_ingo) > 0) {
            foreach ($log_ingo as $info) {

                if ($count % 2 == 0) {
                    $flag = true;
                } else {
                    $flag = false;
                }
                ++$count;

                $rx_bytes_total  = 0;
                $tx_bytes_total  = 0;
                $upCount_total   = 0;
                $downCount_total = 0;
                $latencyAvg      = 0;
                $jitterAvg       = 0;

                for ($i = 0; $i < count($ports_array); ++$i) {
                    /*if (!$row['sum_'.$ports_array[$i].'_rx_bytes']) {
                    $row['sum_'.$ports_array[$i].'_rx_bytes'] = '-';
                    }*/
                    if ($i == 0) {
                        $log_timestamp = $info->log_timestamp;
                    } else {
                        $log_timestamp = '';
                    }

                    $pdf->SetXY(12, $pdf->GetY());
                    //$pdf->SetFillColor(216,68,48); // do not remove
                    $pdf->SetFillColor(233, 239, 245);
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->Cell(25, 10, $log_timestamp, $border, 0, 'C', $flag);
                    $pdf->Cell(25, 10, strtoupper($ports_array[$i]), $border, 0, 'C', $flag);
                    $rx_bytes_clm = 'sum_' . $ports_array[$i] . '_rx_bytes';
                    $tx_bytes_clm = 'sum_' . $ports_array[$i] . '_tx_bytes';
                    if ($ports_array[$i] == 'lan') {
                        $total_port_hrs = '-';
                        $rx_bytes       = '-';
                        $rx_bytes_unit  = '';
                        $tx_bytes       = '-';
                        $tx_bytes_unit  = '';
                        $downCount      = '-';
                        $total_port_hrs = '-';
                        $latence_val    = '-';
                        $jitter_val     = '-';
                    } else {
                        $rx_bytes = $info->$rx_bytes_clm;
                        $tx_bytes = $info->$tx_bytes_clm;
                        $rx_bytes_total += $rx_bytes;
                        $tx_bytes_total += $tx_bytes;
                        $up_count_clm  = 'sum_link_status_' . $ports_array[$i] . '_up_count';
                        $upCount       = $info->$up_count_clm;
                        $downCount_clm = 'sum_link_status_' . $ports_array[$i] . '_down_count';
                        $downCount     = $info->$downCount_clm;
                        $upCount_total += $upCount;
                        $downCount_total += $downCount;

                        if ($downCount == null) {
                            $downCount = 0;
                        }
                        if ($upCount == null) {
                            $upCount = 0;
                        }
                        //LOGIC TO GET PERCENTAGE OF UP TIME IN A DAY, AND TOTAL UP TIME FOR INDIVIDUAL PORTS
                        $port_repeat_count_clm   = 'sum_link_status_' . $ports_array[$i] . '_repeat_up_count';
                        $port_repeat_count       = $info->$port_repeat_count_clm;
                        $total_up_time_port_mins = $port_repeat_count * 2;

                        //OLD CODE $percentage_up_port = bcdiv($total_up_time_port_mins,14.4,1);
                        $percentage_up_port = round($total_up_time_port_mins / 14.4, 1);

                        //OLD CODE $total_up_time_port_hours = intdiv($total_up_time_port_mins, 60).'H '.($total_up_time_port_mins % 60). 'M';
                        $total_up_time_port_hours = floor($total_up_time_port_mins / 60) . 'H ' . ($total_up_time_port_mins % 60) . 'M';

                        $latency_clm = 'avg_' . $ports_array[$i] . '_latency';
                        $latency     = $info->$latency_clm;
                        $latencyAvg += $latency;
                        $jitter_clm = 'avg_' . $ports_array[$i] . '_jitter';
                        $jitter     = $info->$jitter_clm;
                        $jitterAvg += $jitter;
                        $rx_bytes_unit  = $this->unit_conversion($rx_bytes);
                        $tx_bytes_unit  = $this->unit_conversion($tx_bytes);
                        $total_port_hrs = $total_up_time_port_hours . " (" . $percentage_up_port . "%)";
                        $latence_val    = round($latency, 2) . ' ms';
                        $jitter_val     = round($jitter, 2) . ' ms';
                    }
                    $pdf->Cell(20, 10, $rx_bytes . " " . $rx_bytes_unit, $border, 0, 'C', $flag);

                    $pdf->Cell(20, 10, $tx_bytes . " " . $tx_bytes_unit, $border, 0, 'C', $flag);
                    //$pdf->Cell(15 ,10,$upCount,$border,0,'C', $flag);
                    $pdf->Cell(10, 10, $downCount, $border, 0, 'C', $flag);

                    $pdf->Cell(30, 10, $total_port_hrs, $border, 0, 'C', $flag);

                    $pdf->Cell(20, 10, $latence_val, $border, 0, 'C', $flag);
                    $pdf->Cell(25, 10, $jitter_val, $border, 1, 'C', $flag);
                }
            }
        }

        $pdf->Output();
    }

    public function sm_get_device_port_branching_by_serialnumber($port, $model, $model_variant)
    {
        if ($port == "WAN") { //wan1 port is there for all variants
            return true;
        } elseif ($port == "WAN2") {
            if (
                ($model == 'vm' && $model_variant == "l2") || ($model == 'vm' && $model_variant == "l3") ||
                ($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") ||
                ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3") ||
                ($model == 'beetle' && $model_variant == "l2") || ($model == 'beetle' && $model_variant == "l3") ||
                ($model == 'bumblebee' && $model_variant == "l2") || ($model == 'bumblebee' && $model_variant == "l3")
            ) {
                return true;
            }

        } elseif ($port == "WAN3") {
            if (($model == 'spider2' && $model_variant == "l3")) {
                return true;
            }

        } elseif ($port == "LTE1") {
            if (
                ($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") || ($model == 'spider' && $model_variant == "l2w1l2") ||
                ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3") ||
                ($model == 'beetle' && $model_variant == "l2") || ($model == 'beetle' && $model_variant == "l3") ||
                ($model == 'bumblebee' && $model_variant == "l2") || ($model == 'bumblebee' && $model_variant == "l3")
            ) {
                return true;
            }

        } elseif ($port == "LTE2") {
            if (
                ($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") || ($model == 'spider' && $model_variant == "l2w1l2") ||
                ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3")
            ) {
                return true;
            }

        } elseif ($port == "LTE3") {
            if (($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3")) {
                return true;
            }

        } elseif ($port == "LAN") { //lan port is there for all variants
            return true;
        } elseif ($port == "WIRELESS") { //wifi port is there for all variants
            return true;
        } elseif ($port == "SD-WAN") { //sdwan port is there for all variants
            return true;
        }

        return false;
    }

    public function unit_conversion(&$unit_value)
    {$unit = 1;
        $unit_name                       = "Kb";
        $unit_details                    = [];
        $unit_details['unit']            = $unit;
        $unit_name                       = "Kb";
        $unit_details['unit_name']       = $unit_name;
        if ($unit_value <= 0) {$unit_value = 1;}
        $unit_value = $unit_value * 8; //convert to bits
        if ($unit_value > 1100) {$unit = 1000;
            $unit_details['unit']            = $unit;
            $unit_name                       = "Mb";
            $unit_details['unit_name']       = $unit_name;
            $unit_value /= 1000;} //Mb
        if ($unit_value > 1100) {$unit = 1000;
            $unit_details['unit']            = $unit;
            $unit_name                       = "Gb";
            $unit_details['unit_name']       = $unit_name;
            $unit_value /= 1000;} //Gb

        $unit_value = number_format($unit_value, 1);
        return $unit_details['unit_name'];}

    public function byte_area_chart()
    {
        $port_nw_stats     = $this->input->post('port_nw_stats');
        $port_device_stats = $this->input->post('port_device_stats');
        $serialnumber      = $this->input->post('serialnumber');

        $myChart  = json_encode($this->get_graph_data_per_port_from_db($port_nw_stats, 'latency', $serialnumber));
        $myChart1 = json_encode($this->get_graph_data_per_port_from_db($port_nw_stats, 'jitter', $serialnumber));
        $myChart3 = json_encode($this->get_graph_data_per_port_from_db($port_nw_stats, 'rx_bytes_rate', $serialnumber));
        $myChart2 = json_encode($this->get_graph_data_per_port_from_db($port_nw_stats, 'tx_bytes_rate', $serialnumber));
        $myChart4 = json_encode($this->get_link_status_updown_count($port_device_stats, $serialnumber));

        $myChart6  = json_encode($this->get_graph_data_per_port_from_db_week($port_nw_stats, 'latency', $serialnumber));
        $myChart7  = json_encode($this->get_graph_data_per_port_from_db_week($port_nw_stats, 'jitter', $serialnumber));
        $myChart8  = json_encode($this->get_graph_data_per_port_from_db_week($port_nw_stats, 'rx_bytes_rate', $serialnumber));
        $myChart9  = json_encode($this->get_graph_data_per_port_from_db_week($port_nw_stats, 'tx_bytes_rate', $serialnumber));
        $myChart10 = json_encode($this->get_link_status_updown_count_week($port_device_stats, $serialnumber));

        echo $myChart . '::' . $myChart1 . '::' . $myChart3 . '::' . $myChart2 . '::' . $myChart4 . '::' . $myChart6 . '::' . $myChart7 . '::' . $myChart8 . '::' . $myChart9 . '::' . $myChart10;
        //echo 'test';
    }

    public function get_graph_data_per_port_from_db_week($port, $option, $serialnumber)
    {
        $metric       = $port . "_" . $option;
        $unit_details = [];
        if ($option == 'rx_bytes_rate' || $option == 'tx_bytes_rate') {
            $unit_details = $this->unit_conversion_for_graph($metric, $serialnumber);
        }
        $result_data = $this->Edge_model->get_chart_data_by_sno($serialnumber, $metric, 'pw');
        $_graph_data = array();
        // if ($res2 = $db->query($query2)) {
        foreach ($result_data as $data) {
            $_graph_data[0][] = $data->log_timestamp;
            if ($option == 'rx_bytes_rate' || $option == 'tx_bytes_rate') {
                $_graph_data[1][] = $data->metric * 8 / $unit_details['unit'];
                                                              //$_graph_data[1][] = $data->metric']*8/1000;
                $_graph_data[2] = $unit_details['unit_name']; //"kb"; //
            } else {
                $_graph_data[1][] = $data->metric;
            }
            $temp = $data->log_timestamp;
        }
        // }
        return $_graph_data;
    }

    public function get_graph_data_per_port_from_db($port, $option, $serialnumber)
    {
        $metric       = $port . "_" . $option;
        $unit_details = [];
        if ($option == 'rx_bytes_rate' || $option == 'tx_bytes_rate') {
            $unit_details = $this->unit_conversion_for_graph($metric, $serialnumber);
        }
        $result_data = $this->Edge_model->get_chart_data_by_sno($serialnumber, $metric, 'pd');
        //return $result_data;
        //if ($res2 = $db->query($query2)) {
        if (count($result_data) > 0) {
            //while ($row2 = $res2->fetch_assoc()) {
            foreach ($result_data as $data) {
                $_graph_data[0][] = $data->log_timestamp;
                if ($option == 'rx_bytes_rate' || $option == 'tx_bytes_rate') {
                    $_graph_data[1][] = $data->metric * 8 / $unit_details['unit'];
                                                                  //$_graph_data[1][] = $row2['metric']*8/1000;
                    $_graph_data[2] = $unit_details['unit_name']; //"kb"; //
                } else {
                    $_graph_data[1][] = $data->metric;
                }
                $temp = $data->log_timestamp;
            }
        } else {
            $_graph_data[0][] = "No Data";
            $_graph_data[1][] = 0;
            $_graph_data[2]   = "No Data";
        }
        //}
        return $_graph_data;
    }

    public function get_link_status_updown_count($port, $serialnumber)
    {
        $upCountMetric   = 'link_status_' . "$port" . '_up_count';
        $downCountMetric = 'link_status_' . "$port" . '_down_count';

        $resulted_data = $this->Edge_model->get_count_info($upCountMetric, $downCountMetric, $serialnumber, 'pd');

        // if ($res2 = $db->query($query2)) {
        if (count($resulted_data) > 0) {
            foreach ($resulted_data as $data) {
                $_graph_data[0][] = $data->log_timestamp;
                $_graph_data[1][] = $data->upCountMetric;
                $_graph_data[2][] = $data->downCountMetric;
            }
        } else {
            $_graph_data[0][] = "No Data";
            $_graph_data[1][] = 0;
            $_graph_data[2]   = "No Data";
        }
        // }
        return $_graph_data;
    }

    public function get_link_status_updown_count_week($port, $serialnumber)
    {
        $upCountMetric   = 'link_status_' . "$port" . '_up_count';
        $downCountMetric = 'link_status_' . "$port" . '_down_count';
        $resulted_data   = $this->Edge_model->get_count_info($upCountMetric, $downCountMetric, $serialnumber, 'pw');
        $_graph_data     = array();
        foreach ($resulted_data as $data) {
            $_graph_data[0][] = $data->log_timestamp;
            $_graph_data[1][] = $data->upCountMetric;
            $_graph_data[2][] = $data->downCountMetric;
        }

        return $_graph_data;
    }

    public function unit_conversion_for_graph($metric, $serialnumber)
    {
        $unit                      = 1;
        $unit_name                 = "Kb/s";
        $unit_details              = [];
        $unit_details['unit']      = $unit;
        $unit_name                 = "Kb/s";
        $unit_details['unit_name'] = $unit_name;
        $max_data                  = $this->Edge_model->get_max_metrix($metric, $serialnumber);
        if (count($max_data) > 0) {
            foreach ($max_data as $data) {
                $max_bits = $data->max_bits;
                if ($max_bits <= 0) {
                    $max_bits = 1;
                }
                $max_bits = $max_bits * 8; //convert to bits
                if ($max_bits > 1100) {
                    $unit                      = 1000;
                    $unit_details['unit']      = $unit;
                    $unit_name                 = "Mb/s";
                    $unit_details['unit_name'] = $unit_name;
                    $max_bits /= 1000;
                } //Mb
                if ($max_bits > 1100) {
                    $unit                      = 1000000;
                    $unit_details['unit']      = $unit;
                    $unit_name                 = "Gb/s";
                    $unit_details['unit_name'] = $unit_name;
                    $max_bits /= 1000000;
                } //Gb
            }
        }
        return $unit_details;
    }

    public function edge_qos_stats()
    {
        $sno             = $this->input->post('sno');
        $gw_serialnumber = $sdwan_server_id = null;
        $vxlan_id        = 0;
        $query           = $this->Edge_model->get_device_details($sno);
        foreach ($query as $info) {
            $sdwan_server_id = $info->sdwan_server_id;
        }
        if ($sdwan_server_id != null) {
            $query = $this->Edge_model->get_gateway_sn($sdwan_server_id);
            foreach ($query as $info) {
                $gw_serialnumber = $info->serialnumber;
            }
            $query = $this->Edge_model->getGatewayNetwork($gw_serialnumber);
            foreach ($query as $info) {
                $vxlan_id = $info->vxlan_id;
            }
        }
        if ($gw_serialnumber == null) {
            $gateway_circuit_msg = "ERROR: not found any matching GW circuits matching these logs !";
        } else {
            $gateway_circuit_msg = '';
        }
        $where_clause_gw_serial_vxlan_id = " device_serialnumber=\"$gw_serialnumber\" and vxlan_id=$vxlan_id ";
        $where_clause_interval_24h       = " log_timestamp > now() - interval 24 hour ";
        $where_clause_interval_1w        = " log_timestamp > now() - interval 1 week ";

        $rx_bytes_qry = $this->Edge_model->get_chart_data('select sum(http_rx_bytes) as http_rx_bytes, sum(https_rx_bytes) as https_rx_bytes, sum(iperf_rx_bytes) as iperf_rx_bytes, sum(zoom_rx_bytes) as zoom_rx_bytes, sum(microsoft_teams_rx_bytes) as microsoft_teams_rx_bytes,sum(skype_rx_bytes) as skype_rx_bytes, sum(voip_rx_bytes) as voip_rx_bytes, sum(other_rx_bytes) as other_rx_bytes,sum(icmp_rx_bytes) as icmp_rx_bytes,sum(tcp_rx_bytes) as tcp_rx_bytes,sum(udp_rx_bytes) as udp_rx_bytes', $where_clause_gw_serial_vxlan_id, $where_clause_interval_24h);

        $qos_array     = array();
        $pro_qos_array = array();
        foreach ($rx_bytes_qry as $info) {
            array_push($qos_array, $info->http_rx_bytes ? $info->http_rx_bytes : 0);
            array_push($qos_array, $info->https_rx_bytes ? $info->https_rx_bytes : 0);
            array_push($qos_array, $info->iperf_rx_bytes ? $info->iperf_rx_bytes : 0);
            array_push($qos_array, $info->zoom_rx_bytes ? $info->zoom_rx_bytes : 0);
            array_push($qos_array, $info->microsoft_teams_rx_bytes ? $info->microsoft_teams_rx_bytes : 0);
            array_push($qos_array, $info->skype_rx_bytes ? $info->skype_rx_bytes : 0);
            array_push($qos_array, $info->voip_rx_bytes ? $info->voip_rx_bytes : 0);
            array_push($qos_array, $info->other_rx_bytes ? $info->other_rx_bytes : 0);
            array_push($pro_qos_array, $info->tcp_rx_bytes ? $info->tcp_rx_bytes : 0);
            array_push($pro_qos_array, $info->udp_rx_bytes ? $info->udp_rx_bytes : 0);
            array_push($pro_qos_array, $info->icmp_rx_bytes ? $info->icmp_rx_bytes : 0);
        }
        $max_rx_bytes_pro_unit_number = max($pro_qos_array);
        $max_rx_bytes_app_unit_number = max($qos_array);

        $rx_bytes_qry     = $this->Edge_model->get_chart_data('select sum(http_rx_bytes) as http_rx_bytes, sum(https_rx_bytes) as https_rx_bytes, sum(iperf_rx_bytes) as iperf_rx_bytes, sum(zoom_rx_bytes) as zoom_rx_bytes, sum(microsoft_teams_rx_bytes) as microsoft_teams_rx_bytes,sum(skype_rx_bytes) as skype_rx_bytes, sum(voip_rx_bytes) as voip_rx_bytes, sum(other_rx_bytes) as other_rx_bytes,sum(icmp_rx_bytes) as icmp_rx_bytes,sum(tcp_rx_bytes) as tcp_rx_bytes,sum(udp_rx_bytes) as udp_rx_bytes', $where_clause_gw_serial_vxlan_id, $where_clause_interval_1w);
        $wk_qos_array     = array();
        $pro_wk_qos_array = array();
        foreach ($rx_bytes_qry as $info) {
            array_push($wk_qos_array, $info->http_rx_bytes);
            array_push($wk_qos_array, $info->https_rx_bytes);
            array_push($wk_qos_array, $info->iperf_rx_bytes);
            array_push($wk_qos_array, $info->zoom_rx_bytes);
            array_push($wk_qos_array, $info->microsoft_teams_rx_bytes);
            array_push($wk_qos_array, $info->skype_rx_bytes);
            array_push($wk_qos_array, $info->voip_rx_bytes);
            array_push($wk_qos_array, $info->other_rx_bytes);
            array_push($pro_wk_qos_array, $info->tcp_rx_bytes);
            array_push($pro_wk_qos_array, $info->udp_rx_bytes);
            array_push($pro_wk_qos_array, $info->icmp_rx_bytes);
        }
        $wk_max_rx_bytes_pro_unit_number = max($pro_wk_qos_array);
        $wk_max_rx_bytes_app_unit_number = max($wk_qos_array);

        $rx_pkt_query     = $this->Edge_model->get_chart_data('select sum(http_rx_pkts) as http_rx_pkts,sum(https_rx_pkts) as https_rx_pkts,sum(iperf_rx_pkts) as iperf_rx_pkts,sum(zoom_rx_pkts) as zoom_rx_pkts,sum(microsoft_teams_rx_pkts) as microsoft_teams_rx_pkts,sum(skype_rx_pkts) as skype_rx_pkts,sum(voip_rx_pkts) as voip_rx_pkts,sum(other_rx_pkts) as other_rx_pkts,sum(icmp_rx_pkts) as icmp_rx_pkts,sum(tcp_rx_pkts) as tcp_rx_pkts,sum(udp_rx_pkts) as udp_rx_pkts', $where_clause_gw_serial_vxlan_id, $where_clause_interval_24h);
        $rx_pkt_array     = array();
        $pro_rx_pkt_array = array();
        foreach ($rx_pkt_query as $info) {
            array_push($rx_pkt_array, $info->http_rx_pkts);
            array_push($rx_pkt_array, $info->https_rx_pkts);
            array_push($rx_pkt_array, $info->iperf_rx_pkts);
            array_push($rx_pkt_array, $info->zoom_rx_pkts);
            array_push($rx_pkt_array, $info->microsoft_teams_rx_pkts);
            array_push($rx_pkt_array, $info->skype_rx_pkts);
            array_push($rx_pkt_array, $info->voip_rx_pkts);
            array_push($rx_pkt_array, $info->other_rx_pkts);
            array_push($pro_rx_pkt_array, $info->tcp_rx_pkts);
            array_push($pro_rx_pkt_array, $info->udp_rx_pkts);
            array_push($pro_rx_pkt_array, $info->icmp_rx_pkts);
        }

        $wk_rx_pkt_query     = $this->Edge_model->get_chart_data('select sum(http_rx_pkts) as http_rx_pkts,sum(https_rx_pkts) as https_rx_pkts,sum(iperf_rx_pkts) as iperf_rx_pkts,sum(zoom_rx_pkts) as zoom_rx_pkts,sum(microsoft_teams_rx_pkts) as microsoft_teams_rx_pkts,sum(skype_rx_pkts) as skype_rx_pkts,sum(voip_rx_pkts) as voip_rx_pkts,sum(other_rx_pkts) as other_rx_pkts,sum(icmp_rx_pkts) as icmp_rx_pkts,sum(tcp_rx_pkts) as tcp_rx_pkts,sum(udp_rx_pkts) as udp_rx_pkts', $where_clause_gw_serial_vxlan_id, $where_clause_interval_1w);
        $wk_rx_pkt_array     = array();
        $pro_wk_rx_pkt_array = array();
        foreach ($wk_rx_pkt_query as $info) {
            array_push($wk_rx_pkt_array, $info->http_rx_pkts);
            array_push($wk_rx_pkt_array, $info->https_rx_pkts);
            array_push($wk_rx_pkt_array, $info->iperf_rx_pkts);
            array_push($wk_rx_pkt_array, $info->zoom_rx_pkts);
            array_push($wk_rx_pkt_array, $info->microsoft_teams_rx_pkts);
            array_push($wk_rx_pkt_array, $info->skype_rx_pkts);
            array_push($wk_rx_pkt_array, $info->voip_rx_pkts);
            array_push($wk_rx_pkt_array, $info->other_rx_pkts);
            array_push($pro_wk_rx_pkt_array, $info->tcp_rx_pkts);
            array_push($pro_wk_rx_pkt_array, $info->udp_rx_pkts);
            array_push($pro_wk_rx_pkt_array, $info->icmp_rx_pkts);
        }

        $tx_bytes_query     = $this->Edge_model->get_chart_data('select sum(http_tx_bytes) as http_tx_bytes,sum(https_tx_bytes) as https_tx_bytes,sum(iperf_tx_bytes) as iperf_tx_bytes,sum(zoom_tx_bytes) as zoom_tx_bytes,sum(microsoft_teams_tx_bytes) as microsoft_teams_tx_bytes,sum(skype_tx_bytes) as skype_tx_bytes,sum(voip_tx_bytes) as voip_tx_bytes,sum(other_tx_bytes) as other_tx_bytes,sum(icmp_tx_bytes) as icmp_tx_bytes,sum(tcp_tx_bytes) as tcp_tx_bytes,sum(udp_tx_bytes) as udp_tx_bytes', $where_clause_gw_serial_vxlan_id, $where_clause_interval_24h);
        $tx_bytes_array     = array();
        $pro_tx_bytes_array = array();
        foreach ($tx_bytes_query as $info) {
            array_push($tx_bytes_array, $info->http_tx_bytes);
            array_push($tx_bytes_array, $info->https_tx_bytes);
            array_push($tx_bytes_array, $info->iperf_tx_bytes);
            array_push($tx_bytes_array, $info->zoom_tx_bytes);
            array_push($tx_bytes_array, $info->microsoft_teams_tx_bytes);
            array_push($tx_bytes_array, $info->skype_tx_bytes);
            array_push($tx_bytes_array, $info->voip_tx_bytes);
            array_push($tx_bytes_array, $info->other_tx_bytes);
            array_push($pro_tx_bytes_array, $info->tcp_tx_bytes);
            array_push($pro_tx_bytes_array, $info->udp_tx_bytes);
            array_push($pro_tx_bytes_array, $info->icmp_tx_bytes);
        }
        $max_tx_bytes_pro_unit_number = max($pro_tx_bytes_array);
        $max_tx_bytes_app_unit_number = max($tx_bytes_array);

        $wk_tx_bytes_query     = $this->Edge_model->get_chart_data('select sum(http_tx_bytes) as http_tx_bytes,sum(https_tx_bytes) as https_tx_bytes,sum(iperf_tx_bytes) as iperf_tx_bytes,sum(zoom_tx_bytes) as zoom_tx_bytes,sum(microsoft_teams_tx_bytes) as microsoft_teams_tx_bytes,sum(skype_tx_bytes) as skype_tx_bytes,sum(voip_tx_bytes) as voip_tx_bytes,sum(other_tx_bytes) as other_tx_bytes,sum(icmp_tx_bytes) as icmp_tx_bytes,sum(tcp_tx_bytes) as tcp_tx_bytes,sum(udp_tx_bytes) as udp_tx_bytes', $where_clause_gw_serial_vxlan_id, $where_clause_interval_1w);
        $wk_tx_bytes_array     = array();
        $pro_wk_tx_bytes_array = array();
        foreach ($wk_tx_bytes_query as $info) {
            array_push($wk_tx_bytes_array, $info->http_tx_bytes);
            array_push($wk_tx_bytes_array, $info->https_tx_bytes);
            array_push($wk_tx_bytes_array, $info->iperf_tx_bytes);
            array_push($wk_tx_bytes_array, $info->zoom_tx_bytes);
            array_push($wk_tx_bytes_array, $info->microsoft_teams_tx_bytes);
            array_push($wk_tx_bytes_array, $info->skype_tx_bytes);
            array_push($wk_tx_bytes_array, $info->voip_tx_bytes);
            array_push($wk_tx_bytes_array, $info->other_tx_bytes);
            array_push($pro_wk_tx_bytes_array, $info->tcp_tx_bytes);
            array_push($pro_wk_tx_bytes_array, $info->udp_tx_bytes);
            array_push($pro_wk_tx_bytes_array, $info->icmp_tx_bytes);
        }
        $wk_max_tx_bytes_pro_unit_number = max($pro_wk_tx_bytes_array);
        $wk_max_tx_bytes_app_unit_number = max($wk_tx_bytes_array);

        $tx_pkt_query     = $this->Edge_model->get_chart_data('select sum(http_tx_pkts) as http_tx_pkts,sum(https_tx_pkts) as https_tx_pkts,sum(iperf_tx_pkts) as iperf_tx_pkts,sum(zoom_tx_pkts) as zoom_tx_pkts,sum(microsoft_teams_tx_pkts) as microsoft_teams_tx_pkts,sum(skype_tx_pkts) as skype_tx_pkts,sum(voip_tx_pkts) as voip_tx_pkts,sum(other_tx_pkts) as other_tx_pkts,sum(icmp_tx_pkts) as icmp_tx_pkts,sum(tcp_tx_pkts) as tcp_tx_pkts,sum(udp_tx_pkts) as udp_tx_pkts ', $where_clause_gw_serial_vxlan_id, $where_clause_interval_24h);
        $tx_pkt_array     = array();
        $pro_tx_pkt_array = array();
        foreach ($tx_pkt_query as $info) {
            array_push($tx_pkt_array, $info->http_tx_pkts);
            array_push($tx_pkt_array, $info->https_tx_pkts);
            array_push($tx_pkt_array, $info->iperf_tx_pkts);
            array_push($tx_pkt_array, $info->zoom_tx_pkts);
            array_push($tx_pkt_array, $info->microsoft_teams_tx_pkts);
            array_push($tx_pkt_array, $info->skype_tx_pkts);
            array_push($tx_pkt_array, $info->voip_tx_pkts);
            array_push($tx_pkt_array, $info->other_tx_pkts);
            array_push($pro_tx_pkt_array, $info->tcp_tx_pkts);
            array_push($pro_tx_pkt_array, $info->udp_tx_pkts);
            array_push($pro_tx_pkt_array, $info->icmp_tx_pkts);
        }

        $wk_tx_pkt_query     = $this->Edge_model->get_chart_data('select sum(http_tx_pkts) as http_tx_pkts,sum(https_tx_pkts) as https_tx_pkts,sum(iperf_tx_pkts) as iperf_tx_pkts,sum(zoom_tx_pkts) as zoom_tx_pkts,sum(microsoft_teams_tx_pkts) as microsoft_teams_tx_pkts,sum(skype_tx_pkts) as skype_tx_pkts,sum(voip_tx_pkts) as voip_tx_pkts,sum(other_tx_pkts) as other_tx_pkts,sum(icmp_tx_pkts) as icmp_tx_pkts,sum(tcp_tx_pkts) as tcp_tx_pkts,sum(udp_tx_pkts) as udp_tx_pkts ', $where_clause_gw_serial_vxlan_id, $where_clause_interval_1w);
        $wk_tx_pkt_array     = array();
        $pro_wk_tx_pkt_array = array();
        foreach ($wk_tx_pkt_query as $info) {
            array_push($wk_tx_pkt_array, $info->http_tx_pkts);
            array_push($wk_tx_pkt_array, $info->https_tx_pkts);
            array_push($wk_tx_pkt_array, $info->iperf_tx_pkts);
            array_push($wk_tx_pkt_array, $info->zoom_tx_pkts);
            array_push($wk_tx_pkt_array, $info->microsoft_teams_tx_pkts);
            array_push($wk_tx_pkt_array, $info->skype_tx_pkts);
            array_push($wk_tx_pkt_array, $info->voip_tx_pkts);
            array_push($wk_tx_pkt_array, $info->other_tx_pkts);
            array_push($pro_wk_tx_pkt_array, $info->tcp_tx_pkts);
            array_push($pro_wk_tx_pkt_array, $info->udp_tx_pkts);
            array_push($pro_wk_tx_pkt_array, $info->icmp_tx_pkts);
        }

        $max_pro    = max($max_rx_bytes_pro_unit_number, $max_tx_bytes_pro_unit_number);
        $wk_max_pro = max($wk_max_rx_bytes_pro_unit_number, $wk_max_tx_bytes_pro_unit_number);
        $max_app    = max($max_rx_bytes_app_unit_number, $max_tx_bytes_app_unit_number);
        $wk_max_app = max($wk_max_rx_bytes_app_unit_number, $wk_max_tx_bytes_app_unit_number);

        $max_pro_unit_name    = array();
        $wk_max_pro_unit_name = array();
        $max_app_unit_name    = array();
        $wk_max_app_unit_name = array();
        if ($max_pro > 1100) {
            // $max_rx_bytes_pro_unit_number /= 1000;
            for ($i = 0; $i < count($pro_qos_array); ++$i) {
                $pro_qos_array[$i]     = round($pro_qos_array[$i] / 1000, 2);
                $max_pro_unit_name[$i] = "Kb";
            }

            for ($j = 0; $j < count($pro_tx_bytes_array); ++$j) {
                $pro_tx_bytes_array[$j] = round($pro_tx_bytes_array[$j] / 1000, 2);
            }
            $max_pro /= 1000;
        }
        if ($max_pro > 1100) {
            // $max_rx_bytes_pro_unit_number /= 1000;
            for ($i = 0; $i < count($pro_qos_array); ++$i) {
                $pro_qos_array[$i]     = round($pro_qos_array[$i] / 1000, 2);
                $max_pro_unit_name[$i] = "Mb";
            }

            for ($j = 0; $j < count($pro_tx_bytes_array); ++$j) {
                $pro_tx_bytes_array[$j] = round($pro_tx_bytes_array[$j] / 1000, 2);
            }
        }

        if ($wk_max_pro > 1100) {
            // $max_rx_bytes_pro_unit_number /= 1000;
            for ($i = 0; $i < count($pro_wk_qos_array); ++$i) {
                $pro_wk_qos_array[$i]     = round($pro_wk_qos_array[$i] / 1000, 2);
                $wk_max_pro_unit_name[$i] = "Kb";
            }

            for ($j = 0; $j < count($pro_wk_tx_bytes_array); ++$j) {
                $pro_wk_tx_bytes_array[$j] = round($pro_wk_tx_bytes_array[$j] / 1000, 2);
            }

            $wk_max_pro /= 1000;
        }
        if ($wk_max_pro > 1100) {
            for ($i = 0; $i < count($pro_wk_qos_array); ++$i) {
                $pro_wk_qos_array[$i]     = round($pro_wk_qos_array[$i] / 1000, 2);
                $wk_max_pro_unit_name[$i] = "Mb";
            }

            for ($j = 0; $j < count($pro_wk_tx_bytes_array); ++$j) {
                $pro_wk_tx_bytes_array[$j] = round($pro_wk_tx_bytes_array[$j] / 1000, 2);
            }
        }

        if ($max_app > 1100) {

            for ($i = 0; $i < count($qos_array); ++$i) {
                $qos_array[$i]         = round($qos_array[$i] / 1000, 2);
                $max_app_unit_name[$i] = 'Kb';
            }

            for ($j = 0; $j < count($tx_bytes_array); ++$j) {
                $tx_bytes_array[$j] = round($tx_bytes_array[$j] / 1000, 2);
            }

            $max_app /= 1000;
        }
        if ($max_app > 1100) {
            // $max_rx_bytes_pro_unit_number /= 1000;
            for ($i = 0; $i < count($qos_array); ++$i) {
                $qos_array[$i]         = round($qos_array[$i] / 1000, 2);
                $max_app_unit_name[$i] = 'Mb';
            }

            for ($j = 0; $j < count($tx_bytes_array); ++$j) {
                $tx_bytes_array[$j] = round($tx_bytes_array[$j] / 1000, 2);
            }
        }

        if ($wk_max_app > 1100) {
            // $max_rx_bytes_pro_unit_number /= 1000;
            for ($i = 0; $i < count($wk_qos_array); ++$i) {
                $wk_qos_array[$i]         = round($wk_qos_array[$i] / 1000, 2);
                $wk_max_app_unit_name[$i] = "Kb";
            }

            for ($j = 0; $j < count($wk_tx_bytes_array); ++$j) {
                $wk_tx_bytes_array[$j] = round($wk_tx_bytes_array[$j] / 1000, 2);
            }
            $wk_max_app /= 1000;
        }
        if ($wk_max_app > 1100) {
            for ($i = 0; $i < count($wk_qos_array); ++$i) {
                $wk_qos_array[$i]         = round($wk_qos_array[$i] / 1000, 2);
                $wk_max_app_unit_name[$i] = "Mb";
            }

            for ($j = 0; $j < count($wk_tx_bytes_array); ++$j) {
                $wk_tx_bytes_array[$j] = round($wk_tx_bytes_array[$j] / 1000, 2);
            }
        }

        // echo '<pre>';
        // print_r($qos_array);
        $_graph_data                              = array();
        $_graph_data[0]['qos_array']              = $qos_array;
        $_graph_data[1]['max_app_unit_name']      = $max_app_unit_name;
        $_graph_data[2]['rx_pkt_array']           = $rx_pkt_array;
        $_graph_data[3]['pro_rx_pkt_array']       = $pro_rx_pkt_array;
        $_graph_data[4]['tx_bytes_array']         = $tx_bytes_array;
        $_graph_data[5]['pro_tx_bytes_array']     = $pro_tx_bytes_array;
        $_graph_data[6]['max_pro_unit_name']      = $max_pro_unit_name;
        $_graph_data[7]['tx_pkt_array']           = $tx_pkt_array;
        $_graph_data[8]['pro_tx_pkt_array']       = $pro_tx_pkt_array;
        $_graph_data[9]['wk_qos_array']           = $wk_qos_array;
        $_graph_data[10]['wk_rx_pkt_array']       = $wk_rx_pkt_array;
        $_graph_data[11]['pro_wk_qos_array']      = $pro_wk_qos_array;
        $_graph_data[12]['wk_tx_bytes_array']     = $wk_tx_bytes_array;
        $_graph_data[13]['wk_tx_pkt_array']       = $wk_tx_pkt_array;
        $_graph_data[14]['pro_wk_tx_pkt_array']   = $pro_wk_tx_pkt_array;
        $_graph_data[15]['pro_wk_tx_bytes_array'] = $pro_wk_tx_bytes_array;
        $_graph_data[16]['pro_wk_rx_pkt_array']   = $pro_wk_rx_pkt_array;
        $_graph_data[17]['pro_qos_array']         = $pro_qos_array;
        $_graph_data[18]['wk_max_app_unit_name']  = $wk_max_app_unit_name;
        $_graph_data[19]['wk_max_pro_unit_name']  = $wk_max_pro_unit_name;

        echo json_encode($_graph_data);
        //     echo '<pre>'; print_r($rx_bytes_data);

    }

    public function edge_qos_stats_live()
    {

        $sno             = $this->input->post('sno');
        $gw_serialnumber = $sdwan_server_id = null;
        $vxlan_id        = 0;
        $query           = $this->Edge_model->get_device_details($sno);
        foreach ($query as $info) {
            $sdwan_server_id = $info->sdwan_server_id;
        }
        if ($sdwan_server_id != null) {
            $query = $this->Edge_model->get_gateway_sn($sdwan_server_id);
            foreach ($query as $info) {
                $gw_serialnumber = $info->serialnumber;
            }
            $query = $this->Edge_model->getGatewayNetwork($gw_serialnumber);
            foreach ($query as $info) {
                $vxlan_id = $info->vxlan_id;
            }
        }
        if ($gw_serialnumber == null) {
            $gateway_circuit_msg = "ERROR: not found any matching GW circuits matching these logs !";
        } else {
            $gateway_circuit_msg = '';
        }
        $where_clause_gw_serial_vxlan_id = " device_serialnumber=\"$gw_serialnumber\" and vxlan_id=$vxlan_id ";
        $where_clause_interval_24h       = " log_timestamp > now() - interval 24 hour ";
        $where_clause_interval_1w        = " log_timestamp > now() - interval 1 week ";

        $rx_bytes_labl            = array();
        $rx_bytes_http            = array();
        $rx_bytes_https           = array();
        $rx_bytes_iperf           = array();
        $rx_bytes_zoom            = array();
        $rx_bytes_microsoft_teams = array();
        $rx_bytes_skype           = array();
        $rx_bytes_voip            = array();
        $rx_bytes_other           = array();
        $rx_bytes_tcp             = array();
        $rx_bytes_udp             = array();
        $rx_bytes_icmp            = array();

        $current_time_data = $this->Edge_model->get_query_result("log_timestamp,sum(http_rx_bytes) as http_rx_bytes, sum(https_rx_bytes) as https_rx_bytes, sum(iperf_rx_bytes) as iperf_rx_bytes, sum(zoom_rx_bytes) as zoom_rx_bytes, sum(microsoft_teams_rx_bytes) as microsoft_teams_rx_bytes,sum(skype_rx_bytes) as skype_rx_bytes, sum(voip_rx_bytes) as voip_rx_bytes, sum(other_rx_bytes) as other_rx_bytes,sum(icmp_rx_bytes) as icmp_rx_bytes,sum(tcp_rx_bytes) as tcp_rx_bytes,sum(udp_rx_bytes) as udp_rx_bytes", "INTERVAL 24 HOUR", $where_clause_gw_serial_vxlan_id);
        //echo '<pre>'; print_r($current_time_data);
        foreach ($current_time_data as $info) {
            array_push($rx_bytes_labl, $info->log_timestamp_10_mins);
            array_push($rx_bytes_http, $info->http_rx_bytes);
            array_push($rx_bytes_https, $info->https_rx_bytes);
            array_push($rx_bytes_iperf, $info->iperf_rx_bytes);
            array_push($rx_bytes_zoom, $info->zoom_rx_bytes);
            array_push($rx_bytes_microsoft_teams, $info->microsoft_teams_rx_bytes);
            array_push($rx_bytes_skype, $info->skype_rx_bytes);
            array_push($rx_bytes_voip, $info->voip_rx_bytes);
            array_push($rx_bytes_other, $info->other_rx_bytes);
            array_push($rx_bytes_tcp, $info->tcp_rx_bytes);
            array_push($rx_bytes_udp, $info->udp_rx_bytes);
            array_push($rx_bytes_icmp, $info->icmp_rx_bytes);
        }

        $max_rx_types_app = max(max($rx_bytes_http ? $rx_bytes_http : [0]), max($rx_bytes_https ? $rx_bytes_https : [0]), max($rx_bytes_iperf ? $rx_bytes_iperf : [0]), max($rx_bytes_zoom ? $rx_bytes_zoom : [0]), max($rx_bytes_microsoft_teams ? $rx_bytes_microsoft_teams : [0]), max($rx_bytes_skype ? $rx_bytes_skype : [0]), max($rx_bytes_voip ? $rx_bytes_voip : [0]), max($rx_bytes_other ? $rx_bytes_other : [0]));

        $max_rx_bytes_pro = max(max($rx_bytes_tcp ? $rx_bytes_tcp : [0]), max($rx_bytes_udp ? $rx_bytes_udp : [0]), max($rx_bytes_icmp ? $rx_bytes_icmp : [0]));

        $wk_rx_bytes_labl            = array();
        $wk_rx_bytes_http            = array();
        $wk_rx_bytes_https           = array();
        $wk_rx_bytes_iperf           = array();
        $wk_rx_bytes_zoom            = array();
        $wk_rx_bytes_microsoft_teams = array();
        $wk_rx_bytes_skype           = array();
        $wk_rx_bytes_voip            = array();
        $wk_rx_bytes_other           = array();
        $wk_rx_bytes_tcp             = array();
        $wk_rx_bytes_udp             = array();
        $wk_rx_bytes_icmp            = array();

        $current_time_data = $this->Edge_model->get_query_result("log_timestamp,sum(http_rx_bytes) as http_rx_bytes, sum(https_rx_bytes) as https_rx_bytes, sum(iperf_rx_bytes) as iperf_rx_bytes, sum(zoom_rx_bytes) as zoom_rx_bytes, sum(microsoft_teams_rx_bytes) as microsoft_teams_rx_bytes,sum(skype_rx_bytes) as skype_rx_bytes, sum(voip_rx_bytes) as voip_rx_bytes, sum(other_rx_bytes) as other_rx_bytes,sum(icmp_rx_bytes) as icmp_rx_bytes,sum(tcp_rx_bytes) as tcp_rx_bytes,sum(udp_rx_bytes) as udp_rx_bytes", "INTERVAL 1 WEEK", $where_clause_gw_serial_vxlan_id);

        foreach ($current_time_data as $info) {
            array_push($wk_rx_bytes_labl, $info->log_timestamp_10_mins);
            array_push($wk_rx_bytes_http, $info->http_rx_bytes);
            array_push($wk_rx_bytes_https, $info->https_rx_bytes);
            array_push($wk_rx_bytes_iperf, $info->iperf_rx_bytes);
            array_push($wk_rx_bytes_zoom, $info->zoom_rx_bytes);
            array_push($wk_rx_bytes_microsoft_teams, $info->microsoft_teams_rx_bytes);
            array_push($wk_rx_bytes_skype, $info->skype_rx_bytes);
            array_push($wk_rx_bytes_voip, $info->voip_rx_bytes);
            array_push($wk_rx_bytes_other, $info->other_rx_bytes);
            array_push($wk_rx_bytes_tcp, $info->tcp_rx_bytes);
            array_push($wk_rx_bytes_udp, $info->udp_rx_bytes);
            array_push($wk_rx_bytes_icmp, $info->icmp_rx_bytes);
        }

        $wk_max_rx_types_app = max(max($wk_rx_bytes_http ? $wk_rx_bytes_http : [0]), max($wk_rx_bytes_https ? $wk_rx_bytes_https : [0]), max($wk_rx_bytes_iperf ? $wk_rx_bytes_iperf : [0]), max($wk_rx_bytes_zoom ? $wk_rx_bytes_zoom : [0]), max($wk_rx_bytes_microsoft_teams ? $wk_rx_bytes_microsoft_teams : [0]), max($wk_rx_bytes_skype ? $wk_rx_bytes_skype : [0]), max($wk_rx_bytes_voip ? $wk_rx_bytes_voip : [0]), max($wk_rx_bytes_other ? $wk_rx_bytes_other : [0]));

        $wk_max_rx_types_pro = max(max($wk_rx_bytes_tcp ? $wk_rx_bytes_tcp : [0]), max($wk_rx_bytes_udp ? $wk_rx_bytes_udp : [0]), max($wk_rx_bytes_icmp ? $wk_rx_bytes_icmp : [0]));

        $rx_pkt_labl            = array();
        $rx_pkt_http            = array();
        $rx_pkt_https           = array();
        $rx_pkt_iperf           = array();
        $rx_pkt_zoom            = array();
        $rx_pkt_microsoft_teams = array();
        $rx_pkt_skype           = array();
        $rx_pkt_voip            = array();
        $rx_pkt_other           = array();
        $rx_pkt_tcp             = array();
        $rx_pkt_udp             = array();
        $rx_pkt_icmp            = array();

        // start of rx pkt chart data's with 10 minutes back

        $current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_rx_pkts) as http_rx_pkts,sum(https_rx_pkts) as https_rx_pkts,sum(iperf_rx_pkts) as iperf_rx_pkts,sum(zoom_rx_pkts) as zoom_rx_pkts,sum(microsoft_teams_rx_pkts) as microsoft_teams_rx_pkts,sum(skype_rx_pkts) as skype_rx_pkts,sum(voip_rx_pkts) as voip_rx_pkts,sum(other_rx_pkts) as other_rx_pkts,sum(icmp_rx_pkts) as icmp_rx_pkts,sum(tcp_rx_pkts) as tcp_rx_pkts,sum(udp_rx_pkts) as udp_rx_pkts", "INTERVAL 24 HOUR", $where_clause_gw_serial_vxlan_id);

        if (count($current_time_qry) > 0) {
            foreach ($current_time_qry as $info) {
                array_push($rx_pkt_labl, $info->log_timestamp_10_mins);
                array_push($rx_pkt_http, $info->http_rx_pkts);
                array_push($rx_pkt_https, $info->https_rx_pkts);
                array_push($rx_pkt_iperf, $info->iperf_rx_pkts);
                array_push($rx_pkt_zoom, $info->zoom_rx_pkts);
                array_push($rx_pkt_microsoft_teams, $info->microsoft_teams_rx_pkts);
                array_push($rx_pkt_skype, $info->skype_rx_pkts);
                array_push($rx_pkt_voip, $info->voip_rx_pkts);
                array_push($rx_pkt_other, $info->other_rx_pkts);
                array_push($rx_pkt_tcp, $info->tcp_rx_pkts);
                array_push($rx_pkt_udp, $info->udp_rx_pkts);
                array_push($rx_pkt_icmp, $info->icmp_rx_pkts);
            }
        }

        $wk_rx_pkt_labl            = array();
        $wk_rx_pkt_http            = array();
        $wk_rx_pkt_https           = array();
        $wk_rx_pkt_iperf           = array();
        $wk_rx_pkt_zoom            = array();
        $wk_rx_pkt_microsoft_teams = array();
        $wk_rx_pkt_skype           = array();
        $wk_rx_pkt_voip            = array();
        $wk_rx_pkt_other           = array();
        $wk_rx_pkt_tcp             = array();
        $wk_rx_pkt_udp             = array();
        $wk_rx_pkt_icmp            = array();

        $wk_current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_rx_pkts) as http_rx_pkts,sum(https_rx_pkts) as https_rx_pkts,sum(iperf_rx_pkts) as iperf_rx_pkts,sum(zoom_rx_pkts) as zoom_rx_pkts,sum(microsoft_teams_rx_pkts) as microsoft_teams_rx_pkts,sum(skype_rx_pkts) as skype_rx_pkts,sum(voip_rx_pkts) as voip_rx_pkts,sum(other_rx_pkts) as other_rx_pkts,sum(icmp_rx_pkts) as icmp_rx_pkts,sum(tcp_rx_pkts) as tcp_rx_pkts,sum(udp_rx_pkts) as udp_rx_pkts", "INTERVAL 1 WEEK", $where_clause_gw_serial_vxlan_id);

        if (count($wk_current_time_qry) > 0) {
            foreach ($wk_current_time_qry as $info) {
                array_push($wk_rx_pkt_labl, $info->log_timestamp_10_mins);
                array_push($wk_rx_pkt_http, $info->http_rx_pkts);
                array_push($wk_rx_pkt_https, $info->https_rx_pkts);
                array_push($wk_rx_pkt_iperf, $info->iperf_rx_pkts);
                array_push($wk_rx_pkt_zoom, $info->zoom_rx_pkts);
                array_push($wk_rx_pkt_microsoft_teams, $info->microsoft_teams_rx_pkts);
                array_push($wk_rx_pkt_skype, $info->skype_rx_pkts);
                array_push($wk_rx_pkt_voip, $info->voip_rx_pkts);
                array_push($wk_rx_pkt_other, $info->other_rx_pkts);
                array_push($wk_rx_pkt_tcp, $info->tcp_rx_pkts);
                array_push($wk_rx_pkt_udp, $info->udp_rx_pkts);
                array_push($wk_rx_pkt_icmp, $info->icmp_rx_pkts);
            }
        }

        $tx_byte_labl            = array();
        $tx_byte_http            = array();
        $tx_byte_https           = array();
        $tx_byte_iperf           = array();
        $tx_byte_zoom            = array();
        $tx_byte_microsoft_teams = array();
        $tx_byte_skype           = array();
        $tx_byte_voip            = array();
        $tx_byte_other           = array();
        $tx_byte_tcp             = array();
        $tx_byte_udp             = array();
        $tx_byte_icmp            = array();

        // start of tx chart data's with 10 minutes back

        $current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_tx_bytes) as http_tx_bytes,sum(https_tx_bytes) as https_tx_bytes,sum(iperf_tx_bytes) as iperf_tx_bytes,sum(zoom_tx_bytes) as zoom_tx_bytes,sum(microsoft_teams_tx_bytes) as microsoft_teams_tx_bytes,sum(skype_tx_bytes) as skype_tx_bytes,sum(voip_tx_bytes) as voip_tx_bytes,sum(other_tx_bytes) as other_tx_bytes,sum(icmp_tx_bytes) as icmp_tx_bytes,sum(tcp_tx_bytes) as tcp_tx_bytes,sum(udp_tx_bytes) as udp_tx_bytes", "INTERVAL 24 HOUR", $where_clause_gw_serial_vxlan_id);

        if (count($current_time_qry) > 0) {
            foreach ($current_time_qry as $info) {
                array_push($tx_byte_labl, $info->log_timestamp_10_mins);
                array_push($tx_byte_http, $info->http_tx_bytes);
                array_push($tx_byte_https, $info->https_tx_bytes);
                array_push($tx_byte_iperf, $info->iperf_tx_bytes);
                array_push($tx_byte_zoom, $info->zoom_tx_bytes);
                array_push($tx_byte_microsoft_teams, $info->microsoft_teams_tx_bytes);
                array_push($tx_byte_skype, $info->skype_tx_bytes);
                array_push($tx_byte_voip, $info->voip_tx_bytes);
                array_push($tx_byte_other, $info->other_tx_bytes);
                array_push($tx_byte_tcp, $info->tcp_tx_bytes);
                array_push($tx_byte_udp, $info->udp_tx_bytes);
                array_push($tx_byte_icmp, $info->icmp_tx_bytes);
            }
        }

        $max_tx_types_app = max(max($tx_byte_http ? $tx_byte_http : [0]), max($tx_byte_https ? $tx_byte_https : [0]), max($tx_byte_iperf ? $tx_byte_iperf : [0]), max($tx_byte_zoom ? $tx_byte_zoom : [0]), max($tx_byte_microsoft_teams ? $tx_byte_microsoft_teams : [0]), max($tx_byte_skype ? $tx_byte_skype : [0]), max($tx_byte_voip ? $tx_byte_voip : [0]), max($tx_byte_other ? $tx_byte_other : [0]));

        $max_tx_types_pro = max(max($tx_byte_tcp ? $tx_byte_tcp : [0]), max($tx_byte_udp ? $tx_byte_udp : [0]), max($tx_byte_icmp ? $tx_byte_icmp : [0]));

        $wk_tx_byte_labl            = array();
        $wk_tx_byte_http            = array();
        $wk_tx_byte_https           = array();
        $wk_tx_byte_iperf           = array();
        $wk_tx_byte_zoom            = array();
        $wk_tx_byte_microsoft_teams = array();
        $wk_tx_byte_skype           = array();
        $wk_tx_byte_voip            = array();
        $wk_tx_byte_other           = array();
        $wk_tx_byte_tcp             = array();
        $wk_tx_byte_udp             = array();
        $wk_tx_byte_icmp            = array();

        $current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_tx_bytes) as http_tx_bytes,sum(https_tx_bytes) as https_tx_bytes,sum(iperf_tx_bytes) as iperf_tx_bytes,sum(zoom_tx_bytes) as zoom_tx_bytes,sum(microsoft_teams_tx_bytes) as microsoft_teams_tx_bytes,sum(skype_tx_bytes) as skype_tx_bytes,sum(voip_tx_bytes) as voip_tx_bytes,sum(other_tx_bytes) as other_tx_bytes,sum(icmp_tx_bytes) as icmp_tx_bytes,sum(tcp_tx_bytes) as tcp_tx_bytes,sum(udp_tx_bytes) as udp_tx_bytes", "INTERVAL 1 WEEK", $where_clause_gw_serial_vxlan_id);

        if (count($current_time_qry) > 0) {
            foreach ($current_time_qry as $info) {
                array_push($wk_tx_byte_labl, $info->log_timestamp_10_mins);
                array_push($wk_tx_byte_http, $info->http_tx_bytes);
                array_push($wk_tx_byte_https, $info->https_tx_bytes);
                array_push($wk_tx_byte_iperf, $info->iperf_tx_bytes);
                array_push($wk_tx_byte_zoom, $info->zoom_tx_bytes);
                array_push($wk_tx_byte_microsoft_teams, $info->microsoft_teams_tx_bytes);
                array_push($wk_tx_byte_skype, $info->skype_tx_bytes);
                array_push($wk_tx_byte_voip, $info->voip_tx_bytes);
                array_push($wk_tx_byte_other, $info->other_tx_bytes);
                array_push($wk_tx_byte_tcp, $info->tcp_tx_bytes);
                array_push($wk_tx_byte_udp, $info->udp_tx_bytes);
                array_push($wk_tx_byte_icmp, $info->icmp_tx_bytes);
            }
        }

        $wk_max_tx_types_app = max(max($wk_tx_byte_http ? $wk_tx_byte_http : [0]), max($wk_tx_byte_https ? $wk_tx_byte_https : [0]), max($wk_tx_byte_iperf ? $wk_tx_byte_iperf : [0]), max($wk_tx_byte_zoom ? $wk_tx_byte_zoom : [0]), max($wk_tx_byte_microsoft_teams ? $wk_tx_byte_microsoft_teams : [0]), max($wk_tx_byte_skype ? $wk_tx_byte_skype : [0]), max($wk_tx_byte_voip ? $wk_tx_byte_voip : [0]), max($wk_tx_byte_other ? $wk_tx_byte_other : [0]));

        $wk_max_tx_types_pro = max(max($wk_tx_byte_tcp ? $wk_tx_byte_tcp : [0]), max($wk_tx_byte_udp ? $wk_tx_byte_udp : [0]), max($wk_tx_byte_icmp ? $wk_tx_byte_icmp : [0]));

        $tx_pkt_labl            = array();
        $tx_pkt_http            = array();
        $tx_pkt_https           = array();
        $tx_pkt_iperf           = array();
        $tx_pkt_zoom            = array();
        $tx_pkt_microsoft_teams = array();
        $tx_pkt_skype           = array();
        $tx_pkt_voip            = array();
        $tx_pkt_other           = array();
        $tx_pkt_tcp             = array();
        $tx_pkt_udp             = array();
        $tx_pkt_icmp            = array();

        $current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_tx_pkts) as http_tx_pkts,sum(https_tx_pkts) as https_tx_pkts,sum(iperf_tx_pkts) as iperf_tx_pkts,sum(zoom_tx_pkts) as zoom_tx_pkts,sum(microsoft_teams_tx_pkts) as microsoft_teams_tx_pkts,sum(skype_tx_pkts) as skype_tx_pkts,sum(voip_tx_pkts) as voip_tx_pkts,sum(other_tx_pkts) as other_tx_pkts,sum(icmp_tx_pkts) as icmp_tx_pkts,sum(tcp_tx_pkts) as tcp_tx_pkts,sum(udp_tx_pkts) as udp_tx_pkts", "INTERVAL 24 HOUR", $where_clause_gw_serial_vxlan_id);

        if (count($current_time_qry) > 0) {
            foreach ($current_time_qry as $info) {
                array_push($tx_pkt_labl, $info->log_timestamp_10_mins);
                array_push($tx_pkt_http, $info->http_tx_pkts);
                array_push($tx_pkt_https, $info->https_tx_pkts);
                array_push($tx_pkt_iperf, $info->iperf_tx_pkts);
                array_push($tx_pkt_zoom, $info->zoom_tx_pkts);
                array_push($tx_pkt_microsoft_teams, $info->microsoft_teams_tx_pkts);
                array_push($tx_pkt_skype, $info->skype_tx_pkts);
                array_push($tx_pkt_voip, $info->voip_tx_pkts);
                array_push($tx_pkt_other, $info->other_tx_pkts);
                array_push($tx_pkt_tcp, $info->tcp_tx_pkts);
                array_push($tx_pkt_udp, $info->udp_tx_pkts);
                array_push($tx_pkt_icmp, $info->icmp_tx_pkts);
            }
        }

        $wk_tx_pkt_labl            = array();
        $wk_tx_pkt_http            = array();
        $wk_tx_pkt_https           = array();
        $wk_tx_pkt_iperf           = array();
        $wk_tx_pkt_zoom            = array();
        $wk_tx_pkt_microsoft_teams = array();
        $wk_tx_pkt_skype           = array();
        $wk_tx_pkt_voip            = array();
        $wk_tx_pkt_other           = array();
        $wk_tx_pkt_tcp             = array();
        $wk_tx_pkt_udp             = array();
        $wk_tx_pkt_icmp            = array();

        $wk_current_time_qry = $this->Edge_model->get_query_result("log_timestamp,sum(http_tx_pkts) as http_tx_pkts,sum(https_tx_pkts) as https_tx_pkts,sum(iperf_tx_pkts) as iperf_tx_pkts,sum(zoom_tx_pkts) as zoom_tx_pkts,sum(microsoft_teams_tx_pkts) as microsoft_teams_tx_pkts,sum(skype_tx_pkts) as skype_tx_pkts,sum(voip_tx_pkts) as voip_tx_pkts,sum(other_tx_pkts) as other_tx_pkts,sum(icmp_tx_pkts) as icmp_tx_pkts,sum(tcp_tx_pkts) as tcp_tx_pkts,sum(udp_tx_pkts) as udp_tx_pkts", "INTERVAL 1 WEEK", $where_clause_gw_serial_vxlan_id);

        if (count($wk_current_time_qry) > 0) {
            foreach ($wk_current_time_qry as $info) {
                array_push($wk_tx_pkt_labl, $info->log_timestamp_10_mins);
                array_push($wk_tx_pkt_http, $info->http_tx_pkts);
                array_push($wk_tx_pkt_https, $info->https_tx_pkts);
                array_push($wk_tx_pkt_iperf, $info->iperf_tx_pkts);
                array_push($wk_tx_pkt_zoom, $info->zoom_tx_pkts);
                array_push($wk_tx_pkt_microsoft_teams, $info->microsoft_teams_tx_pkts);
                array_push($wk_tx_pkt_skype, $info->skype_tx_pkts);
                array_push($wk_tx_pkt_voip, $info->voip_tx_pkts);
                array_push($wk_tx_pkt_other, $info->other_tx_pkts);
                array_push($wk_tx_pkt_tcp, $info->tcp_tx_pkts);
                array_push($wk_tx_pkt_udp, $info->udp_tx_pkts);
                array_push($wk_tx_pkt_icmp, $info->icmp_tx_pkts);
            }
        }

        $max_pro_unit_name    = array();
        $wk_max_pro_unit_name = array();
        $max_app_unit_name    = array();
        $wk_max_app_unit_name = array();

        if (isset($max_rx_types_app) || isset($max_tx_types_app)) {
            $app_max = max($max_rx_types_app, $max_tx_types_app);
            if ($app_max > 1100) {

                for ($c = 0; $c <= 10; ++$c) {
                    $max_app_unit_name[$c] = 'Kb';
                }

                for ($i = 0; $i < count($rx_bytes_http); ++$i) {
                    if (!empty($rx_bytes_http[$i])) {
                        $rx_bytes_http[$i] = round($rx_bytes_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($rx_bytes_https); ++$j) {
                    if (!empty($rx_bytes_https[$j])) {
                        $rx_bytes_https[$j] = round($rx_bytes_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($rx_bytes_iperf); ++$k) {
                    if (!empty($rx_bytes_iperf[$k])) {
                        $rx_bytes_iperf[$k] = round($rx_bytes_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($rx_bytes_zoom); ++$l) {
                    if (!empty($rx_bytes_zoom[$l])) {
                        $rx_bytes_zoom[$l] = round($rx_bytes_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($rx_bytes_microsoft_teams); ++$m) {
                    if (!empty($rx_bytes_microsoft_teams[$m])) {
                        $rx_bytes_microsoft_teams[$m] = round($rx_bytes_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($rx_bytes_skype); ++$n) {
                    if (!empty($rx_bytes_skype[$n])) {
                        $rx_bytes_skype[$n] = round($rx_bytes_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($rx_bytes_voip); ++$o) {
                    if (!empty($rx_bytes_voip[$o])) {
                        $rx_bytes_voip[$o] = round($rx_bytes_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($rx_bytes_other); ++$p) {
                    if (!empty($rx_bytes_other[$p])) {
                        $rx_bytes_other[$p] = round($rx_bytes_other[$p] / 1000, 2);
                    }
                }
                for ($i = 0; $i < count($tx_byte_http); ++$i) {
                    if (!empty($tx_byte_http[$i])) {
                        $tx_byte_http[$i] = round($tx_byte_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($tx_byte_https); ++$j) {
                    if (!empty($tx_byte_https[$j])) {
                        $tx_byte_https[$j] = round($tx_byte_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($tx_byte_iperf); ++$k) {
                    if (!empty($tx_byte_iperf[$k])) {
                        $tx_byte_iperf[$k] = round($tx_byte_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($tx_byte_zoom); ++$l) {
                    if (!empty($tx_byte_zoom[$l])) {
                        $tx_byte_zoom[$l] = round($tx_byte_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($tx_byte_microsoft_teams); ++$m) {
                    if (!empty($tx_byte_microsoft_teams[$m])) {
                        $tx_byte_microsoft_teams[$m] = round($tx_byte_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($tx_byte_skype); ++$n) {
                    if (!empty($tx_byte_skype[$n])) {
                        $tx_byte_skype[$n] = round($tx_byte_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($tx_byte_voip); ++$o) {
                    if (!empty($tx_byte_voip[$o])) {
                        $tx_byte_voip[$o] = round($tx_byte_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($tx_byte_other); ++$p) {
                    if (!empty($tx_byte_other[$p])) {
                        $tx_byte_other[$p] = round($tx_byte_other[$p] / 1000, 2);
                    }
                }
                $app_max /= 1000;
            }
            if ($app_max > 1100) {
                for ($c = 0; $c <= 10; ++$c) {
                    $max_app_unit_name[$c] = 'Mb';
                }
                // $max_rx_bytes_pro_unit_number /= 1000;
                for ($i = 0; $i < count($rx_bytes_http); ++$i) {
                    if (!empty($rx_bytes_http[$i])) {
                        $rx_bytes_http[$i] = round($rx_bytes_http[$i] / 1000, 2);
                    }
                }

                for ($q = 0; $q < count($rx_bytes_https); ++$q) {
                    if (!empty($rx_bytes_https[$i])) {
                        $rx_bytes_https[$q] = round($rx_bytes_https[$q] / 1000, 2);
                    }
                }

                for ($r = 0; $r < count($rx_bytes_iperf); ++$r) {
                    if (!empty($rx_bytes_iperf[$r])) {
                        $rx_bytes_iperf[$r] = round($rx_bytes_iperf[$r] / 1000, 2);
                    }
                }

                for ($s = 0; $s < count($rx_bytes_zoom); ++$s) {
                    if (!empty($rx_bytes_zoom[$s])) {
                        $rx_bytes_zoom[$s] = round($rx_bytes_zoom[$s] / 1000, 2);
                    }
                }

                for ($t = 0; $t < count($rx_bytes_microsoft_teams); ++$t) {
                    if (!empty($rx_bytes_microsoft_teams[$t])) {
                        $rx_bytes_microsoft_teams[$t] = round($rx_bytes_microsoft_teams[$t] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($rx_bytes_skype); ++$u) {
                    if (!empty($rx_bytes_skype[$u])) {
                        $rx_bytes_skype[$u] = round($rx_bytes_skype[$u] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($rx_bytes_voip); ++$u) {
                    if (!empty($rx_bytes_voip[$u])) {
                        $rx_bytes_voip[$u] = round($rx_bytes_voip[$u] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($rx_bytes_other); ++$u) {
                    if (!empty($rx_bytes_other[$u])) {
                        $rx_bytes_other[$u] = round($rx_bytes_other[$u] / 1000, 2);
                    }
                }

                for ($i = 0; $i < count($tx_byte_http); ++$i) {
                    if (!empty($tx_byte_http[$i])) {
                        $tx_byte_http[$i] = round($tx_byte_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($tx_byte_https); ++$j) {
                    if (!empty($tx_byte_https[$j])) {
                        $tx_byte_https[$j] = round($tx_byte_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($tx_byte_iperf); ++$k) {
                    if (!empty($tx_byte_iperf[$k])) {
                        $tx_byte_iperf[$k] = round($tx_byte_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($tx_byte_zoom); ++$l) {
                    if (!empty($tx_byte_zoom[$l])) {
                        $tx_byte_zoom[$l] = round($tx_byte_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($tx_byte_microsoft_teams); ++$m) {
                    if (!empty($tx_byte_microsoft_teams[$m])) {
                        $tx_byte_microsoft_teams[$m] = round($tx_byte_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($tx_byte_skype); ++$n) {
                    if (!empty($tx_byte_skype[$n])) {
                        $tx_byte_skype[$n] = round($tx_byte_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($tx_byte_voip); ++$o) {
                    if (!empty($tx_byte_voip[$o])) {
                        $tx_byte_voip[$o] = round($tx_byte_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($tx_byte_other); ++$p) {
                    if (!empty($tx_byte_other[$p])) {
                        $tx_byte_other[$p] = round($tx_byte_other[$p] / 1000, 2);
                    }
                }
            }
        }
        if (isset($max_rx_bytes_pro) || isset($max_tx_types_pro)) {
            $pro_max = max($max_rx_bytes_pro, $max_tx_types_pro);
            if ($pro_max > 1100) {

                for ($c = 0; $c <= 10; ++$c) {
                    $max_pro_unit_name[$c] = 'Kb';
                }

                for ($v = 0; $v < count($rx_bytes_tcp); ++$v) {
                    if (!empty($rx_bytes_tcp[$v])) {
                        $rx_bytes_tcp[$v] = round($rx_bytes_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($rx_bytes_udp); ++$w) {
                    if (!empty($rx_bytes_udp[$w])) {
                        $rx_bytes_udp[$w] = round($rx_bytes_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($rx_bytes_icmp); ++$x) {
                    if (!empty($rx_bytes_icmp[$x])) {
                        $rx_bytes_icmp[$x] = round($rx_bytes_icmp[$x] / 1000, 2);
                    }
                }

                for ($v = 0; $v < count($tx_byte_tcp); ++$v) {
                    if (!empty($tx_byte_tcp[$v])) {
                        $tx_byte_tcp[$v] = round($tx_byte_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($tx_byte_udp); ++$w) {
                    if (!empty($tx_byte_udp[$w])) {
                        $tx_byte_udp[$w] = round($tx_byte_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($tx_byte_icmp); ++$x) {
                    if (!empty($tx_byte_icmp[$x])) {
                        $tx_byte_icmp[$x] = round($tx_byte_icmp[$x] / 1000, 2);
                    }
                }

                $pro_max /= 1000;
            }
            if ($pro_max > 1100) {
                for ($c = 0; $c <= 10; ++$c) {
                    $max_pro_unit_name[$c] = 'Mb';
                }
                // $max_rx_bytes_pro_unit_number /= 1000;
                for ($y = 0; $y < count($rx_bytes_tcp); ++$y) {
                    if (!empty($rx_bytes_tcp[$y])) {
                        $rx_bytes_tcp[$y] = round($rx_bytes_tcp[$y] / 1000, 2);
                    }
                }

                for ($z = 0; $z < count($rx_bytes_udp); ++$z) {
                    if (!empty($rx_bytes_udp[$z])) {
                        $rx_bytes_udp[$z] = round($rx_bytes_udp[$z] / 1000, 2);
                    }
                }

                for ($a = 0; $a < count($rx_bytes_icmp); ++$a) {
                    if (!empty($rx_bytes_icmp[$a])) {
                        $rx_bytes_icmp[$a] = round($rx_bytes_icmp[$a] / 1000, 2);
                    }
                }

                for ($v = 0; $v < count($tx_byte_tcp); ++$v) {
                    if (!empty($tx_byte_tcp[$v])) {
                        $tx_byte_tcp[$v] = round($tx_byte_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($tx_byte_udp); ++$w) {
                    if (!empty($tx_byte_udp[$w])) {
                        $tx_byte_udp[$w] = round($tx_byte_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($tx_byte_icmp); ++$x) {
                    if (!empty($tx_byte_icmp[$x])) {
                        $tx_byte_icmp[$x] = round($tx_byte_icmp[$x] / 1000, 2);
                    }
                }
            }
        }

        if (isset($wk_max_rx_types_app) || isset($wk_max_tx_types_app)) {
            $wk_app_max = max($wk_max_rx_types_app, $wk_max_tx_types_app);
            if ($wk_app_max > 1100) {
                for ($c = 0; $c <= 10; ++$c) {
                    $wk_max_app_unit_name[$c] = 'Kb';
                }

                for ($i = 0; $i < count($wk_rx_bytes_http); ++$i) {
                    if (!empty($wk_rx_bytes_http[$i])) {
                        $wk_rx_bytes_http[$i] = round($wk_rx_bytes_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($wk_rx_bytes_https); ++$j) {
                    if (!empty($wk_rx_bytes_https[$j])) {
                        $wk_rx_bytes_https[$j] = round($wk_rx_bytes_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($wk_rx_bytes_iperf); ++$k) {
                    if (!empty($wk_rx_bytes_iperf[$k])) {
                        $wk_rx_bytes_iperf[$k] = round($wk_rx_bytes_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($wk_rx_bytes_zoom); ++$l) {
                    if (!empty($wk_rx_bytes_zoom[$l])) {
                        $wk_rx_bytes_zoom[$l] = round($wk_rx_bytes_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($wk_rx_bytes_microsoft_teams); ++$m) {
                    if (!empty($wk_rx_bytes_microsoft_teams[$m])) {
                        $wk_rx_bytes_microsoft_teams[$m] = round($wk_rx_bytes_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($wk_rx_bytes_skype); ++$n) {
                    if (!empty($wk_rx_bytes_skype[$n])) {
                        $wk_rx_bytes_skype[$n] = round($wk_rx_bytes_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($wk_rx_bytes_voip); ++$o) {
                    if (!empty($wk_rx_bytes_voip[$o])) {
                        $wk_rx_bytes_voip[$o] = round($wk_rx_bytes_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($wk_rx_bytes_other); ++$p) {
                    if (!empty($wk_rx_bytes_other[$p])) {
                        $wk_rx_bytes_other[$p] = round($wk_rx_bytes_other[$p] / 1000, 2);
                    }
                }
                for ($i = 0; $i < count($wk_tx_byte_http); ++$i) {
                    if (!empty($wk_tx_byte_http[$i])) {
                        $wk_tx_byte_http[$i] = round($wk_tx_byte_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($wk_tx_byte_https); ++$j) {
                    if (!empty($wk_tx_byte_https[$j])) {
                        $wk_tx_byte_https[$j] = round($wk_tx_byte_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($wk_tx_byte_iperf); ++$k) {
                    if (!empty($wk_tx_byte_iperf[$k])) {
                        $wk_tx_byte_iperf[$k] = round($wk_tx_byte_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($wk_tx_byte_zoom); ++$l) {
                    if (!empty($wk_tx_byte_zoom[$l])) {
                        $wk_tx_byte_zoom[$l] = round($wk_tx_byte_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($wk_tx_byte_microsoft_teams); ++$m) {
                    if (!empty($wk_tx_byte_microsoft_teams[$m])) {
                        $wk_tx_byte_microsoft_teams[$m] = round($wk_tx_byte_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($wk_tx_byte_skype); ++$n) {
                    if (!empty($wk_tx_byte_skype[$n])) {
                        $wk_tx_byte_skype[$n] = round($wk_tx_byte_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($wk_tx_byte_voip); ++$o) {
                    if (!empty($wk_tx_byte_voip[$o])) {
                        $wk_tx_byte_voip[$o] = round($wk_tx_byte_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($wk_tx_byte_other); ++$p) {
                    if (!empty($wk_tx_byte_other[$p])) {
                        $wk_tx_byte_other[$p] = round($wk_tx_byte_other[$p] / 1000, 2);
                    }
                }
                $wk_app_max /= 1000;
            }
            if ($wk_app_max > 1100) {

                for ($c = 0; $c <= 10; ++$c) {
                    $wk_max_app_unit_name[$c] = 'Mb';
                }

                for ($i = 0; $i < count($wk_rx_bytes_http); ++$i) {
                    if (!empty($wk_rx_bytes_http[$i])) {
                        $wk_rx_bytes_http[$i] = round($wk_rx_bytes_http[$i] / 1000, 2);
                    }
                }

                for ($q = 0; $q < count($wk_rx_bytes_https); ++$q) {
                    if (!empty($wk_rx_bytes_https[$i])) {
                        $wk_rx_bytes_https[$q] = round($wk_rx_bytes_https[$q] / 1000, 2);
                    }
                }

                for ($r = 0; $r < count($wk_rx_bytes_iperf); ++$r) {
                    if (!empty($wk_rx_bytes_iperf[$r])) {
                        $wk_rx_bytes_iperf[$r] = round($wk_rx_bytes_iperf[$r] / 1000, 2);
                    }
                }

                for ($s = 0; $s < count($wk_rx_bytes_zoom); ++$s) {
                    if (!empty($wk_rx_bytes_zoom[$s])) {
                        $wk_rx_bytes_zoom[$s] = round($wk_rx_bytes_zoom[$s] / 1000, 2);
                    }
                }

                for ($t = 0; $t < count($wk_rx_bytes_microsoft_teams); ++$t) {
                    if (!empty($wk_rx_bytes_microsoft_teams[$t])) {
                        $wk_rx_bytes_microsoft_teams[$t] = round($wk_rx_bytes_microsoft_teams[$t] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($wk_rx_bytes_skype); ++$u) {
                    if (!empty($wk_rx_bytes_skype[$u])) {
                        $wk_rx_bytes_skype[$u] = round($wk_rx_bytes_skype[$u] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($wk_rx_bytes_voip); ++$u) {
                    if (!empty($wk_rx_bytes_voip[$u])) {
                        $wk_rx_bytes_voip[$u] = round($wk_rx_bytes_voip[$u] / 1000, 2);
                    }
                }

                for ($u = 0; $u < count($wk_rx_bytes_other); ++$u) {
                    if (!empty($wk_rx_bytes_other[$u])) {
                        $wk_rx_bytes_other[$u] = round($wk_rx_bytes_other[$u] / 1000, 2);
                    }
                }

                for ($i = 0; $i < count($wk_tx_byte_http); ++$i) {
                    if (!empty($wk_tx_byte_http[$i])) {
                        $wk_tx_byte_http[$i] = round($wk_tx_byte_http[$i] / 1000, 2);
                    }
                }

                for ($j = 0; $j < count($wk_tx_byte_https); ++$j) {
                    if (!empty($wk_tx_byte_https[$j])) {
                        $wk_tx_byte_https[$j] = round($wk_tx_byte_https[$j] / 1000, 2);
                    }
                }

                for ($k = 0; $k < count($wk_tx_byte_iperf); ++$k) {
                    if (!empty($wk_tx_byte_iperf[$k])) {
                        $wk_tx_byte_iperf[$k] = round($wk_tx_byte_iperf[$k] / 1000, 2);
                    }
                }

                for ($l = 0; $l < count($wk_tx_byte_zoom); ++$l) {
                    if (!empty($wk_tx_byte_zoom[$l])) {
                        $wk_tx_byte_zoom[$l] = round($wk_tx_byte_zoom[$l] / 1000, 2);
                    }
                }

                for ($m = 0; $m < count($wk_tx_byte_microsoft_teams); ++$m) {
                    if (!empty($wk_tx_byte_microsoft_teams[$m])) {
                        $wk_tx_byte_microsoft_teams[$m] = round($wk_tx_byte_microsoft_teams[$m] / 1000, 2);
                    }
                }

                for ($n = 0; $n < count($wk_tx_byte_skype); ++$n) {
                    if (!empty($wk_tx_byte_skype[$n])) {
                        $wk_tx_byte_skype[$n] = round($wk_tx_byte_skype[$n] / 1000, 2);
                    }
                }

                for ($o = 0; $o < count($wk_tx_byte_voip); ++$o) {
                    if (!empty($wk_tx_byte_voip[$o])) {
                        $wk_tx_byte_voip[$o] = round($wk_tx_byte_voip[$o] / 1000, 2);
                    }
                }

                for ($p = 0; $p < count($wk_tx_byte_other); ++$p) {
                    if (!empty($wk_tx_byte_other[$p])) {
                        $wk_tx_byte_other[$p] = round($wk_tx_byte_other[$p] / 1000, 2);
                    }
                }
            }
        }
        if (isset($wk_max_rx_types_pro) || isset($wk_max_tx_types_pro)) {
            $wk_pro_max = max($wk_max_rx_types_pro, $wk_max_tx_types_pro);
            if ($wk_pro_max > 1100) {

                for ($c = 0; $c <= 10; ++$c) {
                    $wk_max_pro_unit_name[$c] = 'Kb';
                }

                for ($v = 0; $v < count($wk_rx_bytes_tcp); ++$v) {
                    if (!empty($wk_rx_bytes_tcp[$v])) {
                        $wk_rx_bytes_tcp[$v] = round($wk_rx_bytes_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($wk_rx_bytes_udp); ++$w) {
                    if (!empty($wk_rx_bytes_udp[$w])) {
                        $wk_rx_bytes_udp[$w] = round($wk_rx_bytes_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($wk_rx_bytes_icmp); ++$x) {
                    if (!empty($wk_rx_bytes_icmp[$x])) {
                        $wk_rx_bytes_icmp[$x] = round($wk_rx_bytes_icmp[$x] / 1000, 2);
                    }
                }

                for ($v = 0; $v < count($wk_tx_byte_tcp); ++$v) {
                    if (!empty($wk_tx_byte_tcp[$v])) {
                        $wk_tx_byte_tcp[$v] = round($wk_tx_byte_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($wk_tx_byte_udp); ++$w) {
                    if (!empty($wk_tx_byte_udp[$w])) {
                        $wk_tx_byte_udp[$w] = round($wk_tx_byte_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($wk_tx_byte_icmp); ++$x) {
                    if (!empty($wk_tx_byte_icmp[$x])) {
                        $wk_tx_byte_icmp[$x] = round($wk_tx_byte_icmp[$x] / 1000, 2);
                    }
                }

                $wk_pro_max /= 1000;
            }
            if ($wk_pro_max > 1100) {

                for ($c = 0; $c <= 10; ++$c) {
                    $wk_max_pro_unit_name[$c] = 'Mb';
                }

                for ($y = 0; $y < count($wk_rx_bytes_tcp); ++$y) {
                    if (!empty($wk_rx_bytes_tcp[$y])) {
                        $wk_rx_bytes_tcp[$y] = round($wk_rx_bytes_tcp[$y] / 1000, 2);
                    }
                }

                for ($z = 0; $z < count($wk_rx_bytes_udp); ++$z) {
                    if (!empty($wk_rx_bytes_udp[$z])) {
                        $wk_rx_bytes_udp[$z] = round($wk_rx_bytes_udp[$z] / 1000, 2);
                    }
                }

                for ($a = 0; $a < count($wk_rx_bytes_icmp); ++$a) {
                    if (!empty($wk_rx_bytes_icmp[$a])) {
                        $wk_rx_bytes_icmp[$a] = round($wk_rx_bytes_icmp[$a] / 1000, 2);
                    }
                }

                for ($v = 0; $v < count($wk_tx_byte_tcp); ++$v) {
                    if (!empty($wk_tx_byte_tcp[$v])) {
                        $wk_tx_byte_tcp[$v] = round($wk_tx_byte_tcp[$v] / 1000, 2);
                    }
                }

                for ($w = 0; $w < count($wk_tx_byte_udp); ++$w) {
                    if (!empty($wk_tx_byte_udp[$w])) {
                        $wk_tx_byte_udp[$w] = round($wk_tx_byte_udp[$w] / 1000, 2);
                    }
                }

                for ($x = 0; $x < count($wk_tx_byte_icmp); ++$x) {
                    if (!empty($wk_tx_byte_icmp[$x])) {
                        $wk_tx_byte_icmp[$x] = round($wk_tx_byte_icmp[$x] / 1000, 2);
                    }
                }
            }
        }

        $graph_data['myChart'] = array(
            'label'     => ($rx_bytes_labl),
            'http'      => ($rx_bytes_http),
            'https'     => ($rx_bytes_https),
            'iperf'     => ($rx_bytes_iperf),
            'zoom'      => ($rx_bytes_zoom),
            'teams'     => ($rx_bytes_microsoft_teams),
            'voip'      => ($rx_bytes_voip),
            'other'     => ($rx_bytes_other),
            'skype'     => ($rx_bytes_skype),
            'unit_name' => ($max_app_unit_name),
        );

        $graph_data['myChart-wk'] = array(
            'label'     => ($wk_rx_bytes_labl),
            'http'      => ($wk_rx_bytes_http),
            'https'     => ($wk_rx_bytes_https),
            'iperf'     => ($wk_rx_bytes_iperf),
            'zoom'      => ($wk_rx_bytes_zoom),
            'teams'     => ($wk_rx_bytes_microsoft_teams),
            'voip'      => ($wk_rx_bytes_voip),
            'other'     => ($wk_rx_bytes_other),
            'skype'     => ($wk_rx_bytes_skype),
            'unit_name' => ($wk_max_app_unit_name),
        );

        $graph_data['rx-byte-pro-chart'] = array(
            'label'     => ($rx_bytes_labl),
            'tcp'       => ($rx_bytes_tcp),
            'udp'       => ($rx_bytes_udp),
            'icmp'      => ($rx_bytes_icmp),
            'unit_name' => ($max_pro_unit_name),
        );

        $graph_data['rx-byte-pro-chart-wk'] = array(
            'label'     => ($wk_rx_bytes_labl),
            'tcp'       => ($wk_rx_bytes_tcp),
            'udp'       => ($wk_rx_bytes_udp),
            'icmp'      => ($wk_rx_bytes_icmp),
            'unit_name' => ($wk_max_pro_unit_name),
        );

        $graph_data['rx-pkt-pie-chart'] = array(
            'label'           => ($rx_pkt_labl),
            'http'            => ($rx_pkt_http),
            'https'           => ($rx_pkt_https),
            'iperf'           => ($rx_pkt_iperf),
            'zoom'            => ($rx_pkt_zoom),
            'microsoft_teams' => ($rx_pkt_microsoft_teams),
            'skype'           => ($rx_pkt_skype),
            'voip'            => ($rx_pkt_voip),
            'other'           => ($rx_pkt_other),
        );

        $graph_data['rx-pkt-pie-chart-wk'] = array(
            'label'           => ($wk_rx_pkt_labl),
            'http'            => ($wk_rx_pkt_http),
            'https'           => ($wk_rx_pkt_https),
            'iperf'           => ($wk_rx_pkt_iperf),
            'zoom'            => ($wk_rx_pkt_zoom),
            'microsoft_teams' => ($wk_rx_pkt_microsoft_teams),
            'skype'           => ($wk_rx_pkt_skype),
            'voip'            => ($wk_rx_pkt_voip),
            'other'           => ($wk_rx_pkt_other),
        );

        $graph_data['rx-pkt-pro-pie-chart'] = array(
            'label' => ($rx_pkt_labl),
            'tcp'   => ($rx_pkt_tcp),
            'udp'   => ($rx_pkt_udp),
            'icmp'  => ($rx_pkt_icmp),
        );

        $graph_data['rx-pkt-pro-pie-chart-wk'] = array(
            'label' => ($wk_rx_pkt_labl),
            'tcp'   => ($wk_rx_pkt_tcp),
            'udp'   => ($wk_rx_pkt_udp),
            'icmp'  => ($wk_rx_pkt_icmp),
        );

        $graph_data['tx-bytes-pie-chart'] = array(
            'label'           => ($tx_byte_labl),
            'http'            => ($tx_byte_http),
            'https'           => ($tx_byte_https),
            'iperf'           => ($tx_byte_iperf),
            'zoom'            => ($tx_byte_zoom),
            'microsoft_teams' => ($tx_byte_microsoft_teams),
            'skype'           => ($tx_byte_skype),
            'voip'            => ($tx_byte_voip),
            'other'           => ($tx_byte_other),
            'unit_name'       => ($max_app_unit_name),
        );

        $graph_data['tx-bytes-pie-chart-wk'] = array(
            'label'           => ($wk_tx_byte_labl),
            'http'            => ($wk_tx_byte_http),
            'https'           => ($wk_tx_byte_https),
            'iperf'           => ($wk_tx_byte_iperf),
            'zoom'            => ($wk_tx_byte_zoom),
            'microsoft_teams' => ($wk_tx_byte_microsoft_teams),
            'skype'           => ($wk_tx_byte_skype),
            'voip'            => ($wk_tx_byte_voip),
            'other'           => ($wk_tx_byte_other),
            'unit_name'       => ($wk_max_app_unit_name),
        );

        $graph_data['tx-bytes-pro-pie-chart'] = array(
            'label'     => ($tx_byte_labl),
            'tcp'       => ($tx_byte_tcp),
            'udp'       => ($tx_byte_udp),
            'icmp'      => ($tx_byte_icmp),
            'unit_name' => ($max_pro_unit_name),
        );

        $graph_data['tx-bytes-pro-pie-chart-wk'] = array(
            'label'     => ($wk_tx_byte_labl),
            'tcp'       => ($wk_tx_byte_tcp),
            'udp'       => ($wk_tx_byte_udp),
            'icmp'      => ($wk_tx_byte_icmp),
            'unit_name' => ($wk_max_pro_unit_name),
        );

        $graph_data['tx-pkt-pie-chart'] = array(
            'label'           => ($tx_pkt_labl),
            'http'            => ($tx_pkt_http),
            'https'           => ($tx_pkt_https),
            'iperf'           => ($tx_pkt_iperf),
            'zoom'            => ($tx_pkt_zoom),
            'microsoft_teams' => ($tx_pkt_microsoft_teams),
            'skype'           => ($tx_pkt_skype),
            'voip'            => ($tx_pkt_voip),
            'other'           => ($tx_pkt_other),
        );

        $graph_data['tx-pkt-pie-chart-wk'] = array(
            'label'           => ($wk_tx_pkt_labl),
            'http'            => ($wk_tx_pkt_http),
            'https'           => ($wk_tx_pkt_https),
            'iperf'           => ($wk_tx_pkt_iperf),
            'zoom'            => ($wk_tx_pkt_zoom),
            'microsoft_teams' => ($wk_tx_pkt_microsoft_teams),
            'skype'           => ($wk_tx_pkt_skype),
            'voip'            => ($wk_tx_pkt_voip),
            'other'           => ($wk_tx_pkt_other),
        );

        $graph_data['tx-pkt-pro-pie-chart'] = array(
            'label' => ($tx_pkt_labl),
            'tcp'   => ($tx_pkt_tcp),
            'udp'   => ($tx_pkt_udp),
            'icmp'  => ($tx_pkt_icmp),
        );

        $graph_data['tx-pkt-pro-pie-chart-wk'] = array(
            'label' => ($wk_tx_pkt_labl),
            'tcp'   => ($wk_tx_pkt_tcp),
            'udp'   => ($wk_tx_pkt_udp),
            'icmp'  => ($wk_tx_pkt_icmp),
        );

        echo json_encode($graph_data);
    }
}

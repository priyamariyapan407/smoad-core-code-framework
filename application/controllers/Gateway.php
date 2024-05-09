<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gateway extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gateway_model');
        $this->load->helper('file');
    }

    public function sdwan_server()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['servers'] = $this->Gateway_model->get_smoad_servers();
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('gateway/index', $data);
    }

    public function circuit_sumary()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['circuit_summary']    = $this->Gateway_model->circuitSummary();
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('gateway/circuit_summary', $data);
    }

    public function save_server()
    {

        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('license', 'License Name', 'required');
        $this->form_validation->set_rules('ipaddr', 'Ipaddress', 'required|valid_ip');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Gateway/add_server');
        }

        $data['type'] = $this->input->post('type');
        if ($data['type'] == "mptcp") {
            $_sdwan_proto = "mptcp";
        } else {
            $_sdwan_proto = "wg";
        }
        $data['details'] = strip_tags($this->input->post('details'));
        $data['license'] = strip_tags($this->input->post('license'));
        $data['ipaddr'] = strip_tags($this->input->post('ipaddr'));
        $data['area'] = strip_tags($this->input->post('area'));
        $data['mtu'] = strip_tags($this->input->post('mtu'));
        $data['sdwan_proto'] = $_sdwan_proto;
        $hash = "0";
        while ($hash[0] == "0") {
            $hash = substr(md5(openssl_random_pseudo_bytes(20)), -16);
        }

        $data['serialnumber'] = strip_tags($hash);


        $status = $this->Gateway_model->save_server($data);

        if ($status == "true") {
            $this->session->set_flashdata('success_msg', 'The server has been added successfully');
        } else if ($status == "exists") {
            $this->session->set_flashdata('error_msgs', 'Found already matching server name. So cannot creating this new server!');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in adding a server. Please try again later.');
        }

        redirect('Gateway/index');
    }

    public function save_vlan()
    {
        $id = $this->uri->segment('3');
        $serialnumber = $this->uri->segment('4');
        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('vlan_id', 'vlan_id', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Gateway/add_server');
        }
        $data['details'] = strip_tags($this->input->post('details'));
        $data['vlan_id'] = strip_tags($this->input->post('vlan_id'));
        $data['id_smoad_sdwan_servers'] = $id;
        $status = $this->Gateway_model->save_vlan($data);
        if ($status == "true") {
            $this->session->set_flashdata('success_msg', 'The vlan has been added successfully');
        } else if ($status == "exists") {
            $this->session->set_flashdata('error_msgs', 'Found already matching vlan name. So cannot creating this new server!');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in adding a vlan. Please try again later.');
        }
        redirect('Gateway/gateway_network/' . $id . '/' . $serialnumber);
    }

    public function delete_server()
    {
        $id = $this->input->post('server_id');
        $status = $this->Gateway_model->delete_server($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The gateway has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a gateway. Please try again later.');
        }
    }

    public function delete_vlan()
    {
        $id = $this->input->post('vlan_id');
        $status = $this->Gateway_model->delete_vlan($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The gateway has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a gateway. Please try again later.');
        }
    }

    public function delete_job()
    {
        $id = $this->input->post('job_id');
        $status = $this->Gateway_model->delete_job($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The job has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a job. Please try again later.');
        }
    }

    public function delete_bulk_servers()
    {
        $delete_list_id = $this->input->post('alert_ids');
        for ($i = 0; $i < count($delete_list_id); $i++) {
            $this->Gateway_model->delete_server($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success', 'The selected Servers has been deleted successfully');
    }

    public function view_server()
    {
        $id = $this->uri->segment('3');
        $data['server_info'] = $this->Gateway_model->get_server_info($id);
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/view_server', $data);
    }

    public function view_vlan()
    {
        $vlan_id = $this->uri->segment('3');
        $sdwan_id = $this->uri->segment('4');
        $sdwan_serial_number = $this->uri->segment('5');
        $data['vlan_info'] = $this->Gateway_model->getVlanIdInfo($vlan_id);
        $data['sdwan_id'] = $sdwan_id;
        $data['sdwan_serial_number'] = $sdwan_serial_number;
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/view_vlan', $data);
    }

    public function add_server()
    {
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/add_server', $data);
    }

    public function add_vlan()
    {
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/add_vlan', $data);
    }

    public function update_server()
    {
        $id = $this->uri->segment('3');
        $data['server_info'] = $this->Gateway_model->get_server_info($id);
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/update_server', $data);
    }

    public function update_vlan()
    {
        $vlan_id = $this->uri->segment('3');
        $sdwan_id = $this->uri->segment('4');
        $sdwan_serial_number = $this->uri->segment('5');
        $data['vlan_info'] = $this->Gateway_model->getVlanIdInfo($vlan_id);
        $data['sdwan_id'] = $sdwan_id;
        $data['sdwan_serial_number'] = $sdwan_serial_number;
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/update_vlan', $data);
    }

    public function save_edited_info()
    {
        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('license', 'License Name', 'required');
        $this->form_validation->set_rules('ipaddr', 'Ipaddress', 'required');
        $this->form_validation->set_rules('area', 'Area', 'required');
        $id = $this->input->post('id');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Gateway/update_server/' . $id);
        }
        $data['details'] = strip_tags($this->input->post('details'));
        $data['license'] = strip_tags($this->input->post('license'));
        $data['ipaddr'] = strip_tags($this->input->post('ipaddr'));
        $data['area'] = strip_tags($this->input->post('area'));
        $data['mtu'] = strip_tags($this->input->post('mtu'));
        $data['users'] = $this->Gateway_model->update_server($data, $id);
        $this->session->set_flashdata('update_msgs', 'The Server details has been updated successfully');
        // $this->load->view('gateway/index',$data);
        redirect('Gateway/index');
    }

    public function save_edited_vlan_info()
    {
        $sever_id = $this->uri->segment('3');
        $sever_serialnumber = $this->uri->segment('4');
        $this->form_validation->set_rules('details', 'Details', 'required');
        $this->form_validation->set_rules('vlan_id', 'vlan_id', 'required');

        $id = $this->input->post('id');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Gateway/update_server/' . $id);
        }
        $data['details'] = strip_tags($this->input->post('details'));
        $data['vlan_id'] = strip_tags($this->input->post('vlan_id'));
        $data['id_smoad_sdwan_servers'] = $sever_id;
        $data['users'] = $this->Gateway_model->update_vlan($data, $id);
        $this->session->set_flashdata('update_msgs', 'The Server details has been updated successfully');
        // $this->load->view('gateway/index',$data);
        redirect('Gateway/gateway_network/' . $sever_id . '/' . $sever_serialnumber);
    }

    public function gateway_devices()
    {
        $data['id'] = $this->uri->segment('3');
        $data['gateway_sno'] = $this->uri->segment('4');
        $data['back_button'] = $this->uri->segment('5');
        $data['all_info'] = $this->Gateway_model->getGatewayDevices($data['id']);
        //echo "<pre>"; print_r($data);exit;
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/gateway_devices', $data);
    }

    public function set_device()
    {
        $device_id = $this->uri->segment('3');
        $server_id = $this->uri->segment('4');
        $status = $this->uri->segment('5');
        $sdwan_proto = $this->uri->segment('6');
        $_edge_serialnumber = $this->uri->segment('7');
        $_gateway_serialnumber = $this->uri->segment('8');
        $device_status = $this->Gateway_model->set_device($device_id, $server_id, $status, $sdwan_proto);

        if ($device_status == 'assigned') {
            $message = 'assigned';
            $job = "device_add=^" . $_edge_serialnumber . "^";
        } else if ($device_status == 'unassigned') {
            $message = 'unassigned';
            $job = "device_del=^" . $_edge_serialnumber . "^";
        }

        $status = $this->Gateway_model->sm_ztp_sds_add_job($_gateway_serialnumber, $job);
        $this->session->set_flashdata('message', $message);
        redirect('Gateway/gateway_devices/' . $server_id . '/' . $_gateway_serialnumber);
    }

    public function gateway_network()
    {
        $id = $this->uri->segment('3');
        $serialnumber = $this->uri->segment('4');
        $data['server_info'] = $this->Gateway_model->get_server_info($id);
        $data['orchestrators'] = $this->Gateway_model->getGatewayNetwork($serialnumber);
        $data['vlan_info'] = $this->Gateway_model->getVlanInfo($id);
        $data['server_id'] = $this->uri->segment('3');
        $data['serialnumber'] = $this->uri->segment('4');
        $data['circuit_summary'] = $this->Gateway_model->getCircuitInfo($serialnumber);
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        $this->load->view('gateway/gateway_network', $data);
    }

    public function engineering_debug()
    {
        $serialnumber = $this->uri->segment('4');
        $data['job_count'] = $this->Gateway_model->get_job_info($serialnumber);
        $data['id'] = $this->uri->segment('3');
        $data['serialnumber'] = $serialnumber;
        $data['server_jobs'] = $this->Gateway_model->get_server_job_info($serialnumber);
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('gateway/engineering_debug', $data);
    }

    public function softclient_config()
    {
        $serialnumber = $this->uri->segment('4');
        $server_id = $this->uri->segment('3');
        $id = $this->uri->segment('5');
        $data['server_info'] = $this->Gateway_model->get_server_info_by_serial_number($serialnumber);
        $data['peer_info'] = $this->Gateway_model->get_peer_info($id);
        $data['server_id'] = $server_id;
        $data['serialnumber'] = $serialnumber;
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('gateway/softclient_config', $data);
    }


    public function ztp_sds_dev_cfg()
    {
        $data['conf_id'] = $this->uri->segment('3');
        $data['edge_sno'] = $this->uri->segment('4');
        $data['gateway_sno'] = $this->uri->segment('5');
        $data['vlan_info'] = $this->Gateway_model->ztp_sds_dev_cfg($data['edge_sno'], $data['gateway_sno']);
        $data['alerts_info'] = $this->Gateway_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Gateway_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('gateway/ztp_sds_dev_cfg', $data);
    }

    public function save_ztp_sds_dev_cfg()
    {
        $segment_id = $this->uri->segment('3');
        $_id = $this->input->post('id');
        $_vlan_id = $this->input->post('vlan_id');
        $_vlan_id_before = $this->input->post('vlan_id_before');
        $device_serialnumber = $this->input->post('device_serialnumber');
        $gateway_sno = $this->input->post('gateway_sno');

        $device_change = "false";

        if ($_vlan_id_before != $_vlan_id && $_vlan_id != null && $_id != null) {
            $device['vlan_id'] = $_vlan_id;
            $device_change = "true";
            $job = "device_vlan=^" . $device_serialnumber . "," . $_vlan_id . "^";

            $status = $this->Gateway_model->sm_ztp_sds_add_job($gateway_sno, $job);
        }

        $_sdwan_enable = $this->input->post('sdwan_enable') == 'on' ? "TRUE" : "FALSE";

        $_sdwan_enable_before = $this->input->post('sdwan_enable_before');

        if ($_sdwan_enable == null) {
            $_sdwan_enable = 'FALSE';
        }

        if ($_sdwan_enable_before != $_sdwan_enable && $_sdwan_enable != null && $_id != null) {
            $device['sdwan_enable'] = $_sdwan_enable;
            $device_change = "true";
            $job = "device_enable=^" . $device_serialnumber . "," . $_sdwan_enable . "^";
            $status = $this->Gateway_model->sm_ztp_sds_add_job($gateway_sno, $job);
        }

        if ($device_change == "true") {
            $status = $this->Gateway_model->save_ztp_sds_dev_cfg($_id, $device);
        }

        if ($status == "true") {
            $this->session->set_flashdata('success_msg', 'The device settings   has been added successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in changing the device settings. Please try again later.');
        }

        redirect('Gateway/ztp_sds_dev_cfg/' . $segment_id . '/' . $device_serialnumber . '/' . $gateway_sno);
    }
}

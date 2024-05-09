<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Network extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Network_model');
    }

    public function uplink()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }

        $data['port_config'] = 'uplink';
        $data['port_config_info'] = $this->Network_model->getPortData($data['port_config']);
        $data['active'] = 'uplink';
        $data['alerts_info'] = $this->Network_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Network_model->getAlertsCount();
        $this->load->view('network/port_config', $data);
    }

    public function console()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['port_config'] = 'console';
        $data['port_config_info'] = $this->Network_model->getPortData($data['port_config']);
        $data['active'] = 'console';
        $data['alerts_info'] = $this->Network_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Network_model->getAlertsCount();
        $this->load->view('network/port_config', $data);
    }

    public function update_info()
    {
        $port_config = $this->input->post('port_config');

        if ($this->input->post('proto') == 'static') {

            $this->form_validation->set_rules('ipaddr', 'Ip Address', 'required|valid_ip');
            $this->form_validation->set_rules('netmask', 'Netmask', 'required|valid_ip');
            $this->form_validation->set_rules('gateway', 'Gateway', 'required|valid_ip');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error_msgs', validation_errors());
                redirect('network/'.$port_config);
            }

        }

        
        $data['id'] = $this->input->post('id');
        $data['port'] = $this->input->post('port');
        $data['ipaddr'] = $this->input->post('ipaddr');
        $data['netmask'] = $this->input->post('netmask');
        $data['gateway'] = $this->input->post('gateway');
        $data['proto'] = $this->input->post('proto');

        $port_status = $this->Network_model->getPortInfo($data['id']);

        foreach ($port_status as $status) {
            if ($status->proto == $data['proto']) {
                $port_equalancy = 'yes';
            } else {
                $port_equalancy = 'no';
            }
        }

        if ($port_equalancy == 'no') {
            $this->Network_model->api_ubuntu_server_set_port_ip_mask_gw($data);
        }

        $status = $this->Network_model->save_proto($data['id'], $data);

        // if($status == true){
        $this->session->set_flashdata('success_msg', 'The info has been updated successfully');
        // } else {
        //     $this->session->set_flashdata('error_msgs','There is a problem in updating a info. Please try again later.');
        // }

        redirect('Network/'.$port_config);

    }




}

?>
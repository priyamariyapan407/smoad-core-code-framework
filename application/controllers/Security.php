<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Security extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Security_model');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }

        $data['users'] = $this->Security_model->get_rules();
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        $this->load->view('security/index', $data);

    }

    public function firewall()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }

        $data['rules'] = $this->Security_model->get_rules();
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        $this->load->view('security/firewall_rules', $data);
    }

    public function iplist()
    {
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }

        $data['ip_lists'] = $this->Security_model->get_ip_list();
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        $this->load->view('security/ip_list', $data);
    }

    public function save_rule()
    {

        $this->form_validation->set_rules('port', 'Port', 'required|integer');
        $this->form_validation->set_rules('src_mac', 'Source MAC', 'required|callback_validate_mac');
        $this->form_validation->set_rules('dst_mac', 'Destination MAC', 'required|callback_validate_mac');
        $this->form_validation->set_rules('src_ip', 'Source IP-Address', 'required|valid_ip');
        $this->form_validation->set_rules('dst_ip', 'Destination IP-Address', 'required|valid_ip');
        $this->form_validation->set_rules('proto', 'Protocol', 'required');
        $this->form_validation->set_rules('src_port', 'Source Port', 'required|integer');
        $this->form_validation->set_rules('dst_port', 'Destination Port', 'required|integer');
        $this->form_validation->set_rules('action', 'Action', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Security/add_rule');
        }

        $data['port'] = $this->input->post('port');
        $data['src_mac'] = $this->input->post('src_mac');
        $data['dst_mac'] = $this->input->post('dst_mac');
        $data['src_ip'] = $this->input->post('src_ip');
        $data['dst_ip'] = $this->input->post('dst_ip');
        $data['proto'] = $this->input->post('proto');
        $data['src_port'] = $this->input->post('src_port');
        $data['dst_port'] = $this->input->post('dst_port');
        $data['action'] = $this->input->post('action');
        $data['description'] = $this->input->post('description');

        $status = $this->Security_model->save_rule($data);
        //echo "<pre>"; print_r($status);exit;
        if ($status == true) {
            $this->session->set_flashdata('success_msg', 'The rule has been added successfully');
        } else {
            $this->session->set_flashdata('error_msgs', 'There is a problem in adding a rule. Please try again later.');
        }

        redirect('Security/firewall');

    }

    public function validate_mac($mac_address)
    {
        if (preg_match('/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/', $mac_address)) {
            return true; // MAC address is valid
        } else {
            $this->form_validation->set_message('validate_mac', 'The {field} field is not a valid MAC address.');
            return false; // MAC address is not valid
        }
    }


    public function delete_rule()
    {
        $id = $this->uri->segment('3');
        //echo $id;exit;
        // $kernel_cmd = $this->input->post('kernel_cmd');
        $status = $this->Security_model->delete_rule($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The rule has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a problem in deleting a rule. Please try again later.');
        }
        redirect('Security/firewall');
    }


    public function delete_bulk_users()
    {
        $delete_list_id = $this->input->post('alert_ids');
        for ($i = 0; $i < count($delete_list_id); $i++) {
            $this->Security_model->delete_user($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success', 'The selected Users has been deleted successfully');
    }

    public function add_rule()
    {
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        $this->load->view('security/add_rule',$data);
    }

    public function delete_ip()
    {
        $id = $this->uri->segment('3');
        $status = $this->Security_model->delete_ip($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The Ip has deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a error in deleting ip. Please try again.');
        }
        redirect('Security/iplist');
    }

    public function log_index()
    {
        $data['log_index_info'] = $this->Security_model->get_log_index();
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        // $data['log_index'] =
        $this->load->view('security/log_index', $data);
    }

    public function month_info()
    {
        $date = $this->uri->segment('3');
        $data['date'] = $date;
        $data['month_info'] = $this->Security_model->get_month_info($date);
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('security/month_info', $data);
    }


    public function delete_month_lst()
    {
        $id = $this->uri->segment('3');
        $date = $this->uri->segment('4');
        $status = $this->Security_model->delete_month($id);
        if ($status == true) {
            $this->session->set_flashdata('delete_msg_success', 'The log has deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure', 'There is a error in deleting log. Please try again.');
        }
        redirect('Security/month_info/' . $date);
    }

    public function packets()
    {
        $data['packets_drops_24_hrs'] = $this->Security_model->get_packet_drops();
        $data['content_firewall'] = $this->Security_model->get_content_firewall_data();
        $data['ip_track'] = $this->Security_model->get_ip_track();
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        //echo "<pre>"; print_r($data);
        $this->load->view('security/packets', $data);
    }

    public function add_ip()
    {
        $data['alerts_info'] = $this->Security_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Security_model->getAlertsCount();
        $this->load->view('security/add_ip',$data);
    }


    public function add_new_ip()
    {

        $this->form_validation->set_rules('src_ip', 'Source IP-Address', 'required|valid_ip');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_msgs', validation_errors());
            redirect('Security/add_ip');
        }

        $description = str_replace(',', ';', $this->input->post('description'));
        $id_rand_key = bin2hex(random_bytes(6));


        $data['src_ip'] = $this->input->post('src_ip');
        $data['type'] = $this->input->post('type');
        $data['description'] = $description;
        $data['id_rand_key'] = $id_rand_key;

        $status = $this->Security_model->save_ip($data);

        if ($status == true) {
            $this->session->set_userdata('success_msg', 'The new ip has been added successfully');
        } else {
            $this->session->set_userdata('error_msgs', 'There is a error in adding new ip. Please try again later.');
        }

        redirect('Security/iplist');

    }


}

?>
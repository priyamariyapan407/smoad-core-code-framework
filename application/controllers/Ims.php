<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ims extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Ims_model');
    }

    public function index(){
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['smoad_ticketing_servers'] = $this->Ims_model->get_smoad_ticketing_servers();
        $data['alerts_info'] = $this->Ims_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Ims_model->getAlertsCount();
        $this->load->view('ims/index',$data);
    }

    public function add_smoad_ticketing_server(){

        $this->form_validation->set_rules('details','Details','required');
        $this->form_validation->set_rules('license','License','required');
        $this->form_validation->set_rules('serialnumber','Serial Number','required');
        $this->form_validation->set_rules('ipaddr','IP Addr or DNS	','required');
        $this->form_validation->set_rules('api_key','API Key','required');
        $this->form_validation->set_rules('area','Area','required');

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('ims/add_server');
        } 

        $data['details'] = $this->input->post('details');
        $data['license'] = $this->input->post('license');
        $data['serialnumber'] = $this->input->post('serialnumber');
        $data['ipaddr'] = $this->input->post('ipaddr');
        $data['api_key'] = $this->input->post('api_key');
        $data['area'] = $this->input->post('area');
        
        $status = $this->Ims_model->add_smoad_ticketing_server($data);
        if($status == true){
            $this->session->set_flashdata('success_msg','The Server has been added successfully');
        } else {
            $this->session->set_flashdata('error_msgs','There is a problem in adding a Server. Please try again later.');
        }
        
        redirect('ims/index');
        
    }

    public function delete_server() {
        $id = $this->input->post('server_id');
        $status = $this->Ims_model->delete_server($id);
        if($status == true) {
            $this->session->set_flashdata('delete_msg_success','The Server has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure','There is a problem in deleting a Server. Please try again later.');
        }
    }
    public function delete_bulk_servers() {

        $delete_list_id = $this->input->post('alert_ids');
        for($i=0;$i<count($delete_list_id);$i++){
        $this->Ims_model->delete_server($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success','The Server has been deleted successfully');
       
    }

    public function viewIms(){

       $id = $this->uri->segment('3');
       $data['ims_info'] =  $this->Ims_model->get_ims_info($id);
       $data['alerts_info'] = $this->Ims_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Ims_model->getAlertsCount();
       $this->load->view('ims/viewIms',$data);
       
    }

    public function add_server(){
        $data['alerts_info'] = $this->Ims_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Ims_model->getAlertsCount();
        $this->load->view('ims/add_server',$data);
    }

    public function updateIms(){

        $id = $this->uri->segment('3');
        $data['ims_info'] =  $this->Ims_model->get_ims_info($id);
        $data['alerts_info'] = $this->Ims_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Ims_model->getAlertsCount();
        $this->load->view('ims/update_ims',$data);

    }

    public function update_server(){

        $this->form_validation->set_rules('details','Details','required');
        $this->form_validation->set_rules('license','License','required');
        $this->form_validation->set_rules('serialnumber','Serial Number','required');
        $this->form_validation->set_rules('ipaddr','IP Addr or DNS	','required');
        $this->form_validation->set_rules('api_key','API Key','required');
        $this->form_validation->set_rules('area','Area','required');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('ims/update_ims');
        } 
        $data['details'] = $this->input->post('details');
        $data['license'] = $this->input->post('license');
        $data['serialnumber'] = $this->input->post('serialnumber');
        $data['ipaddr'] = $this->input->post('ipaddr');
        $data['api_key'] = $this->input->post('api_key');
        $data['area'] = $this->input->post('area');
      
        $id = $this->uri->segment('3');
        $updated_data['smoad_ticketing_servers'] = $this->Ims_model->updateIms($data,$this->input->post('id'));
        $updated_data['alerts_info'] = $this->Ims_model->getAlertsInfo();
		$updated_data['alerts_cnt'] = $this->Ims_model->getAlertsCount();
        $this->session->set_flashdata('update_msgs','The Server details has been updated successfully');
        $this->load->view('ims/index',$updated_data);

    }

   

}

?>
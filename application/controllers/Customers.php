<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Customers_model');
    }

    public function index(){
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        $data['customers_info'] = $this->Customers_model->get_customers();
        $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
        //echo "<pre>";print_r($data);exit;
        $this->load->view('customer/index',$data);
    }

    public function save_customer(){

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('username','customer Name','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('addr1','Address-1','required');
        $this->form_validation->set_rules('addr2','Address-2','required');
        $this->form_validation->set_rules('area','Area','required');
        
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('Customers/add_customer');
        } 

        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $data['addr1'] = $this->input->post('addr1');
        $data['addr2'] = $this->input->post('addr2');
        $data['area'] = $this->input->post('area');
        $data['access_level'] = 'customer';
        
        $status = $this->Customers_model->save_customer($data);

        if($status == "true"){
            $this->session->set_flashdata('success_msg','The customer has been added successfully');
        } else if($status == "exists"){
            $this->session->set_flashdata('error_msgs','Found already matching customer name. So cannot creating this new customer!');
        } else {
            $this->session->set_flashdata('error_msgs','There is a problem in adding a customer. Please try again later.');
        }
        
        redirect('Customers/index');
        
    }

    public function delete_customer() {
        $id = $this->input->post('customer_id');
        $status = $this->Customers_model->delete_customer($id);
        if($status == true) {
            $this->session->set_flashdata('delete_msg_success','The customer has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure','There is a problem in deleting a customer. Please try again later.');
        }
    }
    public function delete_bulk_customers() {

        $delete_list_id = $this->input->post('alert_ids');
        for($i=0;$i<count($delete_list_id);$i++){
        $this->Customers_model->delete_customer($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success','The selected Users has been deleted successfully');
       
    }

    public function view_customer(){

       $id = $this->uri->segment('3');
       $data['customer_info'] =  $this->Customers_model->get_customer_info($id);
       $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
       $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
       $this->load->view('customer/view_customer',$data);
       
    }

    public function add_customer(){
        $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
        $this->load->view('customer/add_customer',$data);
    }

    public function update_customer(){

        $id = $this->uri->segment('3');
        $data['customer_info'] =  $this->Customers_model->get_customer_info($id);
        $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
        $this->load->view('customer/update_customer',$data);

    }

    public function save_edited_info(){

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('username','customer Name','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('addr1','Address-1','required');
        $this->form_validation->set_rules('addr2','Address-2','required');
        $this->form_validation->set_rules('area','Area','required');
        $id = $this->input->post('id');
        
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('Customers/update_customer/'.$id);
        } 

        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $data['addr1'] = $this->input->post('addr1');
        $data['addr2'] = $this->input->post('addr2');
        $data['area'] = $this->input->post('area');
        $data['users'] = $this->Customers_model->update_customer($data,$id);
        $this->session->set_flashdata('update_msgs','The Server details has been updated successfully');
        // $this->load->view('customer/index',$data);
        
        redirect('Customers/index');

    }


    public function customer_devices() {
        $id = $this->uri->segment('3');
        $data['all_info'] = $this->Customers_model->getCustomerDevices($id);
        $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('customer/customer_devices',$data);
    }

    public function set_device() {
        $device_id = $this->uri->segment('3');
        $customer_id = $this->uri->segment('4');
        $status = $this->uri->segment('5');
        
        // echo $device_id. '::' .$customer_id;exit;
        $device_status= $this->Customers_model->set_device($device_id,$customer_id,$status);
        if($device_status == 'assigned'){
            $message = 'assigned';
        } else if($device_status == 'unassigned'){
           $message = 'unassigned';
        }
        $this->session->set_flashdata('message',$message);
        $data['all_info'] = $this->Customers_model->getCustomerDevices($customer_id);
        $data['alerts_info'] = $this->Customers_model->getAlertsInfo();
        $data['alerts_cnt'] = $this->Customers_model->getAlertsCount();
        //echo "<pre>"; print_r($data);exit;
        $this->load->view('customer/customer_devices',$data);
       
    }

   

}

?>
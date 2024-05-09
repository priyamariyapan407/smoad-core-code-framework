<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index(){
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        
        $data['users'] = $this->User_model->get_users();
        $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
        $this->load->view('user/index',$data);
    }

    public function save_user(){

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('area','Area','required');
        $this->form_validation->set_rules('access_level','Access','required');
        
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('user/add_user');
        } 

        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $data['area'] = $this->input->post('area');
        $data['access_level'] = $this->input->post('access_level');
        
        $status = $this->User_model->save_user($data);
        if($status == true){
            $this->session->set_flashdata('success_msg','The User has been added successfully');
        } else {
            $this->session->set_flashdata('error_msgs','There is a problem in adding a User. Please try again later.');
        }
        
        redirect('user/index');
        
    }

    public function delete_user() {
        $id = $this->input->post('user_id');
        $status = $this->User_model->delete_user($id);
        if($status == true) {
            $this->session->set_flashdata('delete_msg_success','The user has been deleted successfully');
        } else {
            $this->session->set_flashdata('delete_msg_failure','There is a problem in deleting a user. Please try again later.');
        }
    }
    public function delete_bulk_users() {

        $delete_list_id = $this->input->post('alert_ids');
        for($i=0;$i<count($delete_list_id);$i++){
        $this->User_model->delete_user($delete_list_id[$i]);
        }
        $this->session->set_flashdata('delete_msg_success','The selected Users has been deleted successfully');
       
    }

    public function view_user(){

       $id = $this->uri->segment('3');
       $data['user_info'] =  $this->User_model->get_user_info($id);
       $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
       $this->load->view('user/view_user',$data);
       
    }

    public function add_user(){
        $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
        $this->load->view('user/add_user',$data);
    }

    public function update_user(){

        $id = $this->uri->segment('3');
        $data['user_info'] =  $this->User_model->get_user_info($id);
        $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
        $this->load->view('user/update_user',$data);

    }

    public function save_edited_info(){

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('area','Area','required');
        $this->form_validation->set_rules('access_level','Access','required');
        $id = $this->input->post('id');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error_msgs',validation_errors());
            redirect('user/update_user/'.$id);
        } 

        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        $data['area'] = $this->input->post('area');
        $data['access_level'] = $this->input->post('access_level');
        
       // echo "<pre>"; print_r($id);exit;
        
 
        $data['users'] = $this->User_model->update_user($data,$id);
        $this->session->set_flashdata('update_msgs','The Server details has been updated successfully');
        $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
        $this->load->view('user/index',$data);
        
        redirect('user/index');

    }


    public function view_history() {
        $id = $this->uri->segment('3');
        $data['user_history'] = $this->User_model->getUserHistory($id);
        $data['alerts_info'] = $this->User_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->User_model->getAlertsCount();
       // echo "<pre>"; print_r($data);exit;
        $this->load->view('user/view_user_history',$data);
    }

   

}

?>
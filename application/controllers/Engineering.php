<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Engineering extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Engineering_model');
    }

    public function jobs(){
        $logged_in = $this->session->userdata('logged_in');

        if (!($logged_in)) {
            redirect(base_url('/'));
        }
        
        $data['jobs_info'] = $this->Engineering_model->get_jobs_count();
        //echo "<pre>"; print_r($data);exit;
        $data['alerts_info'] = $this->Engineering_model->getAlertsInfo();
		$data['alerts_cnt'] = $this->Engineering_model->getAlertsCount();
        $this->load->view('engineering/index',$data);
    }

   

    public function delete_job() {

        $job_name = $this->input->post('job_name');
        $status = $this->Engineering_model->delete_job($job_name);
        
        if($status == true) {
            $this->session->set_flashdata('delete_msg_success',"Deleted all jobs from the table: $job_name !");
        } else {
            $this->session->set_flashdata('delete_msg_failure',"There is a problem in Deleting all jobs from the table: $job_name. Please try again later.");
        }
        
    }
   
}

?>
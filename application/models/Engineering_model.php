<?php

class Engineering_model extends CI_Model
{


    function get_jobs_count()
    {

        $jobs = array(
            "smoad_device_jobs",
            "smoad_server_jobs",
            "smoad_sdwan_server_jobs",
            "smoad_jobs",
            "smoad_osticket_jobs"
        );

        $all_jobs = array();

        for ($i = 0; $i < count($jobs); $i++) {

            $job_count = $this->db->query("select count(*) as job_count from $jobs[$i]")->result();

            foreach ($job_count as $job) {
                array_push($all_jobs, ['name' => $jobs[$i], 'count' => $job->job_count]);
            }

        }

        return $all_jobs;
    }

    function getAlertsInfo()
    {
      return $this->db->get('smoad_alerts')->result();
    }
  
    function getAlertsCount()
    {
      return $this->db->query('select count(*) as total_cnt from smoad_alerts')->result();
    }

   
    function delete_job($job)
    {

        if ($this->db->empty_table("$job")) {
            return true;
        } else {
            return false;
        }

    }

    

}

?>
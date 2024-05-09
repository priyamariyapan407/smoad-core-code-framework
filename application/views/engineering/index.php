<!DOCTYPE html>
<html lang="en">

<?php $path = APPPATH . 'views/header.php';
include("$path"); ?>

<?php $path = APPPATH . 'views/sidebar.php';
include("$path"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="edge_device">
                <div class="row heading">
                    <div class="col-lg-11">
                        <div>
                            <h5><b>Engineering Debug - Jobs</b></h5>
                        </div>
                    </div>

                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_failure'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_success'); ?> </div>
                <?php } ?>
                <?php if ($this->session->flashdata('update_msgs')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('update_msgs'); ?> </div>
                <?php } ?>

                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>

                                                    <th>Jobs</th>
                                                    <th>Counts</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($jobs_info as $job) {
                                                    if ($job['name'] == 'smoad_device_jobs') {
                                                        $job_name = 'Pending ZTP SMOAD CORE -> Edge Jobs';
                                                    } else if ($job['name'] == 'smoad_server_jobs') {
                                                        $job_name = 'Pending ZTP Edge/Gateway-Server -> SMOAD CORE Jobs';
                                                    } else if ($job['name'] == 'smoad_sdwan_server_jobs') {
                                                        $job_name = 'Pending ZTP: SMOAD CORE -> SMOAD Gateway Jobs';
                                                    } else if ($job['name'] == 'smoad_jobs') {
                                                        $job_name = 'Pending Local SMOAD CORE Jobs';
                                                    } else if ($job['name'] == 'smoad_osticket_jobs') {
                                                        $job_name = 'Pending Local osTicket Jobs';
                                                    }
                                                ?>
                                                    <tr>



                                                        <td> <?php echo $job_name ?> </td>
                                                        <td> <?php echo $job['count'] ?></td>

                                                        <td>

                                                            <span class="fa_delete" style="margin: 2%;">
                                                                <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deletejob('<?php echo $job['name']; ?>')">
                                                                    <span class="fa fa-trash"></span></span>
                                                            </span>

                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                            </tfoot>
                                        </table>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.card -->

                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




<script>
    function deletejob(job_name) {

        $.ajax({
            'url': '<?php echo base_url('Engineering/delete_job') ?>',
            'method': 'post',
            'data': {
                'job_name': job_name
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/Engineering/jobs' ?>';
            }
        })

    }
</script>



<script>
    $(function() {

        var dataTable = $('#users_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });


    });
</script>

</html>
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
                    <div class="col-lg-9">
                        <div>
                            <h5><b>Gateway ZTP - Engineering Debug - Jobs </b></h5>
                        </div>
                        <?php if ($this->session->flashdata('error_msgs')) { ?>
                            <div class='alert_msg alert_msg-danger error_msg' role="alert">
                                <?= $this->session->flashdata('error_msgs'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>






                <div class="row">
                    <div class="col-lg-4">
                        Pending ZTP: SMOAD Server -> SDWAN Server Jobs
                    </div>
                    <div class="col-lg-4">
                        <?php
                        foreach ($job_count as $count) {
                            echo $count->quantity;
                        }
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <?php if (($this->session->userdata('accesslevel') == 'root') && (($job_count[0]->quantity) > 0)) { ?>
                            <span class="fa_delete" style="margin: 2%;">
                                <span style="cursor:pointer;" onclick="deleteid()">
                                    <span class="fa fa-trash"></span></span>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <div style="margin-top: 2%;">
                    <h5><b>Gateway ZTP - Engineering Debug - Server Jobs</b></h5>
                </div>
                <div class="row card" style="margin-top: 1%;">
                    <div class="card-body col-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Command</th>
                                            <th>Job</th>
                                            <th>TIMESTAMP</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">
                                        <?php foreach ($server_jobs as $info) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $info->id; ?>
                                                </td>
                                                <td>
                                                    <?php echo $info->command; ?>
                                                </td>
                                                <td>
                                                    <?php echo $info->job; ?>
                                                </td>
                                                <td>
                                                    <?php echo $info->cfg_timestamp; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>







                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <div class="col-lg-1">
        <a href="<?php echo base_url('Gateway/index'); ?>">
            <input type="button" class="btn btn-block btn-success" value="Back">
        </a>
    </div>
    <!-- /.content -->
</div>

</html>

<script>
    function deleteid() {
        $.ajax({
            'url': '<?php echo base_url('Gateway/delete_job') ?>',
            'method': 'post',
            'data': {
                'job_id': '<?php echo $serialnumber ?>'
            },
            'success': function(data) {
                console.log(data, 'data');
                window.location = '<?php echo base_url() . '/Gateway/engineering_debug/' . $id . '/' . $serialnumber ?>';
            }
        })

    }
</script>
<script>
    $(function() {



        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // Check/uncheck all checkboxes when the "Check All" checkbox is clicked




    });
</script>
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
                <div class="row">
                    <div class="col-lg-8">
                        <h5><b>Edge ZTP - <span class="log_name">Engineering Debug - Dev Jobs - </span>
                                <?php echo $sno . ' -  ';
                                foreach ($device_info as $info) {
                                    echo $info->details;
                                } ?>
                            </b></h5>
                    </div>


                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?>
                    </div>
                <?php } ?>


                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">
                            <div class="col-lg-12 log_table">
                                <table id="log_table" class="table table-bordered table-hover log_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <?php if ($job_name == 'smoad_server_jobs') { ?> <th>command</th><?php } ?>
                                            <th>Job</th>
                                            <th>TIMESTAMP</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">

                                        <?php foreach ($job_list as $list) { ?>
                                            <tr>
                                                <td><?php echo $list->id; ?></td>
                                                <?php if ($job_name == 'smoad_server_jobs') { ?> <td><?php echo $list->command; ?> </td><?php } ?>
                                                <td><?php echo $list->job; ?></td>
                                                <td><?php echo $list->cfg_timestamp; ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    </tfoot>
                                </table>


                            </div>
                            <!-- /.card -->

                        </div>

                        <div class="row lables mrgn_top">

                            <div class="col-lg-1"><a href="<?php echo base_url('Edge/ztp_dev_debug_jobs/' . $id . '/' . $sno); ?>">
                                    <input type="button" class="btn btn-block btn-success" value="Back"></a>
                            </div>
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

</html>
<script>
    $('#log_table').DataTable({
        "lengthMenu": [
            [20, 50],
            [20, 50]
        ]
    });
</script>
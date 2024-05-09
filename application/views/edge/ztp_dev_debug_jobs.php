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
                <div>
                    <h5><b>Edge ZTP - Engineering Debug - Jobs -
                            <?php echo $sno; ?> -<?php foreach ($device_info as $info) {
                                                        echo $info->details;
                                                    } ?>
                        </b></h5>
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


                <form action="<?php echo base_url('Edge/update_firmware/' . $id . '/' . $sno) ?>" method="post">

                    <?php foreach ($jobs_info as $info) {

                        if ($info['name'] == 'smoad_device_jobs') {
                            $job_name = "Pending ZTP SMOAD Server -> Device Jobs";
                        } else {
                            $job_name = "Pending ZTP Device -> SMOAD Server Jobs";
                        }

                    ?>

                        <div class="form-group">
                            <div class="row lables mrgn_top">
                                <a href="<?php echo base_url('Edge/joblist/' . $id . '/' . $sno . '/' . $info['name']) ?>">
                                    <div class="col-lg-4">
                                        <?php echo $job_name; ?>
                                </a>
                            </div>
                            <div class="col-lg-2">
                                <?php echo $info['count']; ?>
                            </div>

                            <div class="col-lg-3">
                                <span class="fa_delete" style="margin: 2%;"><a href="<?php echo base_url('Edge/delete_jobs/' . $id . '/' . $sno . '/' . $info['name']) ?>" class="fa fa-trash" aria-hidden="true" style="font-size: 20px;color: #000;cursor: pointer;"></a></span>
                            </div>

                        </div>
            </div>

        <?php } ?>
        </form>

        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

</html>
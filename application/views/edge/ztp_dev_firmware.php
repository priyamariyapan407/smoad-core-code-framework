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
                    <h5><b>Edge ZTP - Link aggregation -
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

                    <?php foreach ($firmware_info as $info) {

                        if ($info->firmware_status == 'yes') {
                            $_firmware_status = "Pending Update";
                        } else {
                            $_firmware_status = "Complete";
                        }

                    ?>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $info->id; ?>">

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Firmware
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info->firmware; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Update Status
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $_firmware_status; ?>
                                </div>
                            </div>


                            <div class="row lables mrgn_top">

                                <?php if (($this->session->userdata('accesslevel') == 'root') && ($info->firmware_status != 'yes')) { ?>
                                    <div class="col-lg-2">
                                        <input type="submit" class="btn btn-block btn-success" value="Update Firmware"></button>
                                    </div>
                                <?php } ?>

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
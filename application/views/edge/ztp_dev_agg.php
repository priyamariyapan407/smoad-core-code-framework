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


                <form action="<?php echo base_url('Edge/save_ztp_dev_agg/' . $id . '/' . $sno) ?>" method="post">

                    <?php foreach ($agg_data as $info) {

                        $id                   = $info->id;
                        $ssid                 = $info->wireless_ssid;
                        $key                  = $info->wireless_key;
                        $encryption           = $info->wireless_encryption;
                        $wireless_auth_server = $info->wireless_auth_server;
                        $wireless_auth_secret = $info->wireless_auth_secret;

                        if ($this->session->userdata('accesslevel') == 'access_level_limited') {
                            $readonly = 'readonly';
                        } else {
                            $readonly = '';
                        }

                    ?>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="aggpolicy_before" value="<?php echo $info->aggpolicy; ?>">
                            <input type="hidden" class="form-control" name="aggpolicy_mode_before" value="<?php echo $info->aggpolicy_mode; ?>">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $info->id; ?>">

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Mode
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($this->session->userdata('accesslevel') == 'access_level_limited' || $info->aggpolicy == 'balanced') {
                                        if ($aggpolicy_mode == "linkfail") { ?> <input type="text" class="form-control" value="Link Failover"><?php } elseif ($aggpolicy_mode == "loadbal") { ?> <input type="text" class="form-control" value="Load Balance">
                                        <?php }
                                                                                                                                        } else { ?>
                                        <select class="form-control select2 table_menus select" name="aggpolicy_mode" style="width: 100%;">
                                            <option value="notset" <?php if ($info->aggpolicy_mode == 'notset') {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>>Not Set</option>
                                            <option value="linkfail" <?php if ($info->aggpolicy_mode == 'linkfail') {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>>Link Failover</option>
                                            <option value="loadbal" <?php if ($info->aggpolicy_mode == 'loadbal') {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>>Load Balance</option>
                                        </select>
                                    <?php } ?>


                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Prefer
                                </div>
                                <div class="col-lg-3">
                                    <?php $aggpolicy = '';
                                    if ($this->session->userdata('accesslevel') == 'access_level_limited') {

                                        if ($info->aggpolicy == "balanced") {
                                            $aggpolicy = 'Balanced';
                                        } elseif ($info->aggpolicy == "wan") {
                                            $aggpolicy = 'WAN';
                                        } elseif ($info->aggpolicy == "wan2") {
                                            $aggpolicy = 'WAN2';
                                        } elseif ($info->aggpolicy == "notset") {
                                            $aggpolicy = 'Not Set';
                                        }

                                    ?>
                                        <?php if ($readonly == 'readonly') {
                                            echo $aggpolicy;
                                        } else {  ?>
                                            <input type="text" class="form-control" value="<?php echo $aggpolicy; ?>">
                                        <?php } ?>

                                    <?php } else { ?>
                                        <select class="form-control select2 table_menus select" name="aggpolicy" style="width: 100%;">
                                            <?php if ($info->aggpolicy == "notset") { ?> <option value="notset" selected>Not Set</option><?php }
                                                                                                                                        if ($info->aggpolicy_mode == 'loadbal') { ?>
                                                <option value="balanced" <?php if ($info->aggpolicy == 'balanced') {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>>Balanced</option><?php } ?>
                                            <option value="wan" <?php if ($info->aggpolicy == 'wan') {
                                                                    echo 'selected';
                                                                } ?>>WAN</option>
                                            <option value="wan2" <?php if ($info->aggpolicy == 'wan2') {
                                                                        echo 'selected';
                                                                    } ?>>WAN2</option>
                                            <option value="lte1" <?php if ($info->aggpolicy == 'lte1') {
                                                                        echo 'selected';
                                                                    } ?>>LTE1</option>
                                            <option value="lte2" <?php if ($info->aggpolicy == 'lte2') {
                                                                        echo 'selected';
                                                                    } ?>>LTE2</option>
                                        </select>

                                    <?php } ?>
                                </div>
                            </div>


                            <div class="row lables mrgn_top">

                                <?php if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>
                                    <div class="col-lg-1">
                                        <input type="submit" class="btn btn-block btn-success" value="Update"></button>
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
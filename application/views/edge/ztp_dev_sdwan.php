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
                    <h5><b>Edge ZTP - SD-WAN Settings -
                            <?php echo $sno; ?> - <?php //echo '<pre>'; print_r($device_details); 
                                                    foreach ($device_details as $inf) {
                                                        echo $inf->details;
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


                <form action="<?php echo base_url('Edge/save_ztp_dev_sdwan/' . $id . '/' . $sno) ?>" method="post">

                    <?php foreach ($device_info['smoad_devices'] as $info) {

                        $id                  = $info->id;
                        $sdwan_server_ipaddr = $info->sdwan_server_ipaddr;
                        $sdwan_enable        = $info->sdwan_enable;
                        $qos_sdwan           = $info->qos_sdwan;

                        foreach ($device_info['smoad_device_network_cfg'] as $data) {

                            $id_smoad_device_network_cfg       = $data->id;
                            $sdwan_link_high_usage_threshold   = $data->sdwan_link_high_usage_threshold;
                            $sdwan_link_high_latency_threshold = $data->sdwan_link_high_latency_threshold;
                            $sdwan_link_high_jitter_threshold  = $data->sdwan_link_high_jitter_threshold;

                            if ($this->session->userdata('accesslevel') == 'access_level_limited') {
                                $readonly = 'readonly';
                            } else {
                                $readonly = '';
                            }

                            if ($sdwan_enable == "TRUE") {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }

                    ?>

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" class="form-control" name="sdwan_enable_before" value="<?php echo $sdwan_enable; ?>">
                                <input type="hidden" class="form-control" name="sdwan_server_ipaddr_before" value="<?php echo $sdwan_server_ipaddr; ?>">
                                <input type="hidden" class="form-control" name="sdwan_link_high_usage_threshold_before" value="<?php echo $sdwan_link_high_usage_threshold; ?>">
                                <input type="hidden" class="form-control" name="sdwan_link_high_latency_threshold_before" value="<?php echo $sdwan_link_high_latency_threshold; ?>">
                                <input type="hidden" class="form-control" name="qos_sdwan_before" value="<?php echo $qos_sdwan; ?>">
                                <input type="hidden" class="form-control" name="id_smoad_device_network_cfg" value="<?php echo $id_smoad_device_network_cfg; ?>">

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Enable
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="checkbox" name="sdwan_enable" placeholder="Enter ssid" <?php echo $checked; ?>>
                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Gateway
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $sdwan_server_ipaddr;
                                        } else {  ?>
                                            <input type="text" class="form-control" value="<?php echo $sdwan_server_ipaddr; ?>">
                                        <?php } ?>

                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Link High Usage Alert Threshold (Kb/s)
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $sdwan_link_high_usage_threshold;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="sdwan_link_high_usage_threshold" value="<?php echo $sdwan_link_high_usage_threshold; ?>" placeholder="Enter sdwan link high usage threshold">
                                        <?php } ?>


                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Link High Latency Threshold (ms)
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $sdwan_link_high_latency_threshold;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="sdwan_link_high_latency_threshold" value="<?php echo $sdwan_link_high_latency_threshold; ?>" placeholder="Enter sdwan link high latency threshold">
                                        <?php } ?>


                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Link High Jitter Threshold (ms)
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $sdwan_link_high_jitter_threshold;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="sdwan_link_high_jitter_threshold" value="<?php echo $sdwan_link_high_jitter_threshold; ?>" placeholder="Enter link High Jitter Threshold (ms)">
                                        <?php } ?>


                                    </div>
                                </div>


                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        SD-WAN Priority
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $qos_sdwan;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="qos_sdwan" value="<?php echo $qos_sdwan; ?>" placeholder="Enter qos sdwan">
                                        <?php } ?>


                                    </div>
                                </div>



                            </div>
            </div>

            <div class="row lables mrgn_top">

                <?php if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>
                    <div class="col-lg-1">
                        <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                    </div>
                <?php } ?>

            </div>



    <?php }
                    } ?>
    </form>

    <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



</html>
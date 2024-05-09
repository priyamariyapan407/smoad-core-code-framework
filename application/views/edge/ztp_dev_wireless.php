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
                    <h5><b>Edge ZTP - Wireless Settings -
                            <?php echo $sno; ?> - <?php foreach ($device_info as $info) {
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


                <form action="<?php echo base_url('Edge/save_ztp_dev_wireless/' . $id . '/' . $sno) ?>" method="post">

                    <?php foreach ($network_cfg as $info) {

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
                            <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control" name="ssid_before" value="<?php echo $ssid; ?>">
                            <input type="hidden" class="form-control" name="key_before" value="<?php echo $key; ?>">
                            <input type="hidden" class="form-control" name="encryption_before" value="<?php echo $encryption; ?>">
                            <input type="hidden" class="form-control" name="wireless_auth_server_before" value="<?php echo $wireless_auth_server; ?>">
                            <input type="hidden" class="form-control" name="wireless_auth_secret_before" value="<?php echo $wireless_auth_secret; ?>">

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    SSID
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($readonly == 'readonly') {
                                        echo $ssid;
                                    } else {  ?>
                                        <input type="text" class="form-control" name="ssid" value="<?php echo $ssid; ?>" placeholder="Enter ssid">
                                    <?php } ?>


                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Wireless Security (encryption)
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($this->session->userdata('accesslevel') == 'access_level_limited') {

                                        if ($encryption == "psk2") {
                                            print "WPA2-PSK (strong security)";
                                        } elseif ($encryption == "psk-mixed") {
                                            print "WPA-PSK/WPA2-PSK Mixed Mode (medium security)";
                                        } elseif ($encryption == "psk") {
                                            print "WPA-PSK (medium security)";
                                        } elseif ($encryption == "wpa") {
                                            print "WPA-EAP (medium security)";
                                        } elseif ($encryption == "wpa2") {
                                            print "WPA2-EAP (strong security)";
                                        }

                                    ?>
                                        <?php echo $encryption; ?>
                                    <?php } else { ?>
                                        <select class="form-control select2 table_menus select" style="width: 100%;" name="encryption">
                                            <option value="psk2" <?php echo $encryption == "psk2" ? 'selected' : '' ?>>
                                                WPA2-PSK (strong security)</option>
                                            <option value="psk-mixed" <?php echo $encryption == "psk-mixed" ? 'selected' : '' ?>>WPA-PSK/WPA2-PSK Mixed Mode (medium security)</option>
                                            <option value="psk" <?php echo $encryption == "psk" ? 'selected' : '' ?>>WPA-PSK
                                                (medium security)</option>
                                            <option value="wpa" <?php echo $encryption == "wpa" ? 'selected' : '' ?>>WPA-EAP
                                                (medium security)</option>
                                            <option value="wpa2" <?php echo $encryption == "wpa2" ? 'selected' : '' ?>>
                                                WPA2-EAP (strong security)</option>
                                        </select>

                                    <?php } ?>
                                </div>
                            </div>
                            <?php if ($encryption == "wpa" || $encryption == "wpa2") { ?>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        RADIUS Authentication Server
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $wireless_auth_server;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="wireless_auth_server" value="<?php echo $wireless_auth_server; ?>" placeholder="Enter wireless_auth_server">
                                        <?php } ?>


                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        RADIUS Authentication Secret
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $wireless_auth_secret;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="wireless_auth_secret" value="<?php echo $wireless_auth_secret; ?>" placeholder="Enter wireless_auth_secret">
                                        <?php } ?>


                                    </div>
                                </div>


                            <?php } else { ?>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Key
                                    </div>
                                    <div class="col-lg-3">
                                        <?php if ($readonly == 'readonly') {
                                            echo $key;
                                        } else {  ?>
                                            <input type="text" class="form-control" name="key" value="<?php echo $key; ?>" placeholder="Enter Key">
                                        <?php } ?>


                                    </div>
                                </div>


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
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>



</html>
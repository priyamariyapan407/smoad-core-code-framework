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
        <div class="container-fluid padding">

            <div class="row heading">
                <div class="col-lg-12">
                    <h4><b>Alert - Configuration</b></h4>
                    <div class="alert_heading">
                        <h7><b>EDGE Alerts</b></h7>
                    </div>

                </div>
            </div>

            <?php if (!empty($get_alert_config)) {

                foreach ($get_alert_config as $alert_config) {
                    $id = $alert_config->id;
                    $edge_up_down = $alert_config->edge_up_down;
                    $edge_up_down_mail = $alert_config->edge_up_down_mail;
                    $gw_up_down = $alert_config->gw_up_down;
                    $gw_up_down_mail = $alert_config->gw_up_down_mail;
                    $fw_high_pkt_drop = $alert_config->fw_high_pkt_drop;
                    $fw_high_pkt_drop_mail = $alert_config->fw_high_pkt_drop_mail;
                    $core_ui_user_login = $alert_config->core_ui_user_login;
                    $core_ui_user_login_mail = $alert_config->core_ui_user_login_mail;
                    $link_status_sdwan_down = $alert_config->link_status_sdwan_down;
                    $link_status_sdwan_down_mail = $alert_config->link_status_sdwan_down_mail;
                    $link_status_sdwan_up = $alert_config->link_status_sdwan_up;
                    $link_status_sdwan_up_mail = $alert_config->link_status_sdwan_up_mail;
                    $sdwan_link_high_usage = $alert_config->sdwan_link_high_usage;
                    $sdwan_link_high_usage_mail = $alert_config->sdwan_link_high_usage_mail;
                    $sdwan_link_high_latency = $alert_config->sdwan_link_high_latency;
                    $sdwan_link_high_latency_mail = $alert_config->sdwan_link_high_latency_mail;
                    $sdwan_link_high_jitter = $alert_config->sdwan_link_high_jitter;
                    $sdwan_link_high_jitter_mail = $alert_config->sdwan_link_high_jitter_mail;
                }
            }
            ?>
            <form action="<?php echo base_url('Alerts/update_alert_config') ?>" method="post">
                <div class="devices">
                    <?php if ($edge_up_down == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">EDGE is up or down/disconnected</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="edge_up_down" id="edge_up_down" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($edge_up_down_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">EDGE is up or down/disconnected - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="edge_up_down_mail" id="edge_up_down_mail" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($link_status_sdwan_up == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN Network up</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="link_status_sdwan_up" id="link_status_sdwan_up" <?php echo $checked ?> />
                        </div>
                    </div>
                    <?php if ($link_status_sdwan_up_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN Network up - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="link_status_sdwan_up_mail" id="link_status_sdwan_up_mail" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($link_status_sdwan_down == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN Network down</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="link_status_sdwan_down" id="link_status_sdwan_down" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($link_status_sdwan_down_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN Network down - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="link_status_sdwan_down_mail" id="link_status_sdwan_down_mail" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_usage == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high usage</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_usage" id="sdwan_link_high_usage" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_usage_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high usage - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_usage_mail" id="sdwan_link_high_usage_mail" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_latency == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high latency</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_latency" id="sdwan_link_high_latency" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_latency_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high latency - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_latency_mail" id="sdwan_link_high_latency_mail" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_jitter == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high jitter</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_jitter" id="sdwan_link_high_jitter" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($sdwan_link_high_jitter_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">SD-WAN link high jitter - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="sdwan_link_high_jitter_mail" id="sdwan_link_high_jitter_mail" <?php echo $checked ?> /></div>
                    </div>
                </div>
                <div class="alert_heading">
                    <h7><b> Gateway Alerts </b></h7>
                </div>
                <div class="devices">
                    <?php if ($gw_up_down == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">GW is up or down/disconnected</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="gw_up_down" id="gw_up_down" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($gw_up_down_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">GW is up or down/disconnected - Mail Alert</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="gw_up_down_mail" id="gw_up_down_mail" <?php echo $checked ?> /></div>
                    </div>
                </div>
                <div class="alert_heading">
                    <h7><b> Security Alerts</b></h7>
                </div>

                <div class="devices">
                    <?php if ($fw_high_pkt_drop == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">Firewall high packet drop</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="fw_high_pkt_drop" id="fw_high_pkt_drop" <?php echo $checked ?> /></div>
                    </div>
                    <?php if ($fw_high_pkt_drop_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">Firewall high packet drop - Mail Alert </div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="fw_high_pkt_drop_mail" id="fw_high_pkt_drop_mail" <?php echo $checked ?> /></div>
                    </div>
                </div>
                <div class="alert_heading">
                    <h7><b> CORE Server Alerts </b></h7>
                </div>

                <div class="devices">
                    <?php if ($core_ui_user_login == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">CORE UI user login/logout</div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="core_ui_user_login" id="core_ui_user_login" <?php echo $checked ?> />
                        </div>
                    </div>
                    <?php if ($core_ui_user_login_mail == "TRUE") {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    } ?>
                    <div class="row">
                        <div class="col-lg-5">CORE UI user login/logout - Mail Alert </div>
                        <div class="col-lg-6"><input type="checkbox" style="border: 0;" name="core_ui_user_login_mail" id="core_ui_user_login_mail" <?php echo $checked ?> /></div>
                    </div>
                </div>

                <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) { ?>

                    <div class="row update_button">
                        <div class="col-lg-2 update_button">
                            <input type="submit" class="btn btn-block btn-danger" value="Update">
                        </div>
                    </div>

                <?php } ?>
                <!-- /.row -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

</div>

</html>
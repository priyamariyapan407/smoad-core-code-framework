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
                            <h5><b>SMOAD Edge Device Config Template Details</b></h5>
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



                <div class="form-group">
                    <?php foreach ($templates_info as $info) {
                        $_model = $_model_variant = '';
                        $model = $info->model;
                        $model_variant = $info->model_variant;
                        if ($model == "spider") {
                            $_model = "Spider";
                        } else if ($model == "spider2") {
                            $_model = "Spider2";
                        } else if ($model == "beetle") {
                            $_model = "Beetle";
                        } else if ($model == "bumblebee") {
                            $_model = "BumbleBee";
                        } else if ($model == "vm") {
                            $_model = "VM";
                        } else if ($model == "soft_client") {
                            $_model = "Soft-client";
                        }

                        //if($status=='up') { $status="led-green"; } else { $status="led-red"; }
                        if ($model_variant == "l2") {
                            $_model_variant = "L2 SD-WAN";
                        } else if ($model_variant == "l2w1l2") {
                            $_model_variant = "L2 SD-WAN (L2W1L2)";
                        } else if ($model_variant == "l3") {
                            $_model_variant = "L3 SD-WAN";
                        } else if ($model_variant == "mptcp") {
                            $_model_variant = "MPTCP";
                        }
                    ?>


                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                ID
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->id; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Template Details
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->template_details; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Edge Details
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->details; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Model - Variant
                            </div>
                            <div class="col-lg-3">
                                <?php echo $_model . ' - ' . $_model_variant; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Area
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->area; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LAN IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lan_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LAN Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lan_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN Connection Type
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_proto; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN DNS Servers
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_dns; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN Username
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_username; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN Password
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan_password; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 Connection Type
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_proto; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 DNS Servers
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_dns; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 Username
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_username; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN2 Password
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan2_password; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 Connection Type
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_proto; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 DNS Servers
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_dns; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 Username
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_username; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                WAN3 Password
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wan3_password; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE1 IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte1_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE1 Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte1_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE1 Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte1_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE2 IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte2_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE2 Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte2_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE2 Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte2_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE3 IP Address
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte3_ipaddr; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE3 Netmask
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte3_netmask; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                LTE3 Gateway
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->lte3_gateway; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Wireless SSID
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wireless_ssid; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Wireless Key
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wireless_key; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Wireless Security (encryption)
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wireless_encryption; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Wireless RADIUS Authentication Server
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wireless_auth_server; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Wireless RADIUS Authentication Secret
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->wireless_auth_secret; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Link aggregation mode
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->aggpolicy_mode; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Link aggregation prefer
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->aggpolicy; ?>
                            </div>
                        </div>

                        <div class="row lables readonly_texts">
                            <div class="col-lg-3">
                                Link High Usage Alert Threshold (Kb/s)
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->sdwan_link_high_usage_threshold; ?>
                            </div>
                        </div>



                        <div class="row lables readonly_texts mrgn_top">


                            <div class="col-lg-1">
                                <a href="<?php echo base_url('Edge/dev_config_templates') ?>">
                                    <input type="button" class="btn btn-block btn-success" value="Back">
                                </a>
                            </div>

                        </div>


                    <?php } ?>
                </div>


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

</html>
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
                            <h5><b>Edge ZTP - WAN Settings -
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
                                <?= $this->session->flashdata('success_msg'); ?> </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>


                <form action="<?php echo base_url('Edge/save_port_status') ?>" method="post">

                    <div class="form-group">
                        <?php

                        if ($this->session->userdata('accesslevel') == 'access_level_limited') {
                            $readonly = 'readonly';
                        } else {
                            $readonly = '';
                        }

                        foreach ($port_info as $info) { //echo "<pre>"; print_r($info); 
                        ?>


                            <div class="row lables">
                                <div class="col-lg-3">
                                    Port
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($wanport == 'wan') {
                                        $wanport_name = 'WAN1';
                                    } elseif ($wanport == 'wan2') {
                                        $wanport_name = 'WAN2';
                                    } elseif ($wanport == 'wan3') {
                                        $wanport_name = 'WAN3';
                                    } else {
                                        $wanport_name = ' ';
                                    } ?>
                                    <?php echo $wanport_name; ?>
                                    <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="id">
                                    <input type="hidden" class="form-control" value="<?php echo $sno; ?>" name="sno">
                                    <input type="hidden" class="form-control" value="<?php echo $wanport; ?>" name="wanport">
                                    <input type="hidden" class="form-control" value="<?php echo $this->uri->segment('6'); ?>" name="redirect">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Connection Type
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="proto">
                                        <option value="dhcp" <?php echo $info->_wan_proto == 'dhcp' ? 'selected' : ''; ?>>DHCP</option>
                                        <option value="pppoe" <?php echo $info->_wan_proto == 'pppoe' ? 'selected' : ''; ?>>PPPoE</option>
                                        <option value="static" <?php echo $info->_wan_proto == 'static' ? 'selected' : ''; ?>>Static</option>
                                    </select>
                                </div>
                            </div>
                            <?php if ($info->_wan_proto == 'dhcp' || $info->_wan_proto == 'pppoe') { ?>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        IP Address
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control ipaddr" value="<?php echo $info->_wan_ipaddr ? $info->_wan_ipaddr : 'not set'; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Netmask
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control netmask" value="<?php echo $info->_wan_netmask ? $info->_wan_netmask : 'not set'; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Gateway
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control gateway" value="<?php echo $info->_wan_gateway ? $info->_wan_gateway : 'not set'; ?>" readonly>
                                    </div>
                                </div>
                                <?php if ($info->_wan_proto == 'pppoe') { ?>
                                    <div class="row lables mrgn_top username">
                                        <div class="col-lg-3">
                                            Username
                                        </div>
                                        <div class="col-lg-3">
                                            <?php if ($readonly == 'readonly') {
                                                echo $info->_wan_username;
                                            } else {  ?>
                                                <input type="text" class="form-control details" value="<?php echo $info->_wan_username; ?>" name="username">
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="row lables mrgn_top password">
                                        <div class="col-lg-3">
                                            Password
                                        </div>
                                        <div class="col-lg-3">
                                            <?php if ($readonly == 'readonly') {
                                                echo $info->_wan_password;
                                            } else {  ?>
                                                <input type="password" class="form-control details" value="<?php echo $info->_wan_password; ?>" name="password" $readonly id="password">
                                                <i class="fa fa-eye password-toggle" onclick="togglePasswordVisibility()"></i>
                                            <?php } ?>

                                        </div>
                                    </div>

                                <?php }
                            }
                            if ($info->_wan_proto == 'static') { ?>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        IP Address
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control details ipaddr" value="<?php echo $info->_wan_ipaddr ? $info->_wan_ipaddr : 'not set'; ?>" name="ipaddr" $readonly>
                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Netmask
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control details netmask" value="<?php echo $info->_wan_netmask ? $info->_wan_netmask : 'not set'; ?>" name="netmask" $readonly>
                                    </div>
                                </div>

                                <div class="row lables mrgn_top">
                                    <div class="col-lg-3">
                                        Gateway
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control details gateway" value="<?php echo $info->_wan_gateway ? $info->_wan_gateway : 'not set'; ?>" name="gateway" $readonly>
                                    </div>
                                </div>


                            <?php }
                            if ($info->_wan_ipaddr == '' || $info->_wan_ipaddr == 'not set' || $info->_wan_ipaddr == 'notset') {
                                $ipaddr_meta_dump = '';
                            } else {
                                $ipaddr_meta       = json_decode(file_get_contents("http://ipinfo.io/{$info->_wan_ipaddr}/json"));
                                $ipaddr_meta_found = false;
                                $ipaddr_meta_city  = $ipaddr_meta_org  = $ipaddr_meta_hostname  = null;
                                $ipaddr_meta_dump  = null;
                                if (isset($ipaddr_meta->org)) {
                                    $ipaddr_meta_found = true;
                                    $ipaddr_meta_dump .= $ipaddr_meta->org;
                                }
                                if (isset($ipaddr_meta->city)) {
                                    $ipaddr_meta_found = true;
                                    $ipaddr_meta_dump .= "<br>" . $ipaddr_meta->city;
                                }
                                if (isset($ipaddr_meta->country)) {
                                    $ipaddr_meta_found = true;
                                    $ipaddr_meta_dump .= ", " . $ipaddr_meta->country;
                                }
                                if (isset($ipaddr_meta->hostname)) {
                                    $ipaddr_meta_found = true;
                                    $ipaddr_meta_dump .= "<br>" . $ipaddr_meta->hostname;
                                }
                            }

                            ?>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    IP Whois Details
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $ipaddr_meta_dump; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    DNS Servers
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($readonly == 'readonly') {
                                        echo $info->_wan_dns;
                                    } else {  ?>
                                        <input type="text" class="form-control details" value="<?php echo $info->_wan_dns; ?>" name="dns">
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Connection Status
                                </div>
                                <div class="col-lg-3">
                                    <?php $_wan_link_status = $info->_wan_link_status == 'up' ? 'assets/images/network-cable2.png' : 'assets/images/ethernet.png'; ?>
                                    <img src="<?php echo $CI->config->base_url() . $_wan_link_status; ?>" alt="image" style="width:20px;">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-12">
                                    <b>QoS Settings</b>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Max Bandwidth (Mbps)
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($readonly == 'readonly') {
                                        echo $info->_max_bandwidth;
                                    } else {  ?>
                                        <input type="text" class="form-control details" value="<?php echo $info->_max_bandwidth; ?>" name="max_bandwidth">
                                    <?php } ?>

                                </div>
                            </div>

                            <?php
                            $max_bandwidth        = $info->_max_bandwidth;
                            $medium_bandwidth_pct = $info->_medium_bandwidth_pct;
                            $low_bandwidth_pct    = $info->_low_bandwidth_pct;
                            $medium_bandwidth     = round((($max_bandwidth * $medium_bandwidth_pct) / 100), 2);
                            $low_bandwidth        = round((($max_bandwidth * $low_bandwidth_pct) / 100), 2);
                            ?>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Medium Bandwidth %
                                    <?php echo $medium_bandwidth ?> Mbps
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control details" value="<?php echo $medium_bandwidth_pct; ?>" name="medium_bandwidth_pct" $readonly>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Low Bandwidth %
                                    <?php echo $low_bandwidth ?> Mbps
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($readonly == 'readonly') {
                                        echo $low_bandwidth_pct;
                                    } else {  ?>
                                        <input type="text" class="form-control details" value="<?php echo $low_bandwidth_pct; ?>" name="low_bandwidth_pct">
                                    <?php } ?>


                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="row">

                                    <div class="col-lg-1">
                                        <?php if ($this->session->userdata('accesslevel') != 'access_level_limited') { ?>
                                            <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                                    </div>
                                <?php }
                                        if ($redirect == 'status') {
                                            $filename = "status";
                                        } else {
                                            $filename = "edge_config";
                                        } ?>

                                </div>

                            </div>


                        <?php } ?>
                    </div>

                </form>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<script>
    $('.select').on('change', function() {
        var selected_val = $(this).val();
        if (selected_val == 'static') {
            $('.ipaddr').removeAttr('readonly');
            $('.netmask').removeAttr('readonly');
            $('.gateway').removeAttr('readonly');
        } else {
            $('.ipaddr').prop('readonly', 'true');
            $('.netmask').prop('readonly', 'true');
            $('.gateway').prop('readonly', 'true');
        }

        if (selected_val == 'pppoe') {
            $('.username').show();
            $('.password').show();
        } else {
            $('.username').hide();
            $('.password').hide();
        }
    })
</script>

<script>
    function togglePasswordVisibility() {
        var password_input = document.getElementById('password');
        var password_toggle = document.querySelector('.password-toggle');
        if (password_input.type === 'password') {
            password_input.type = 'text';
            $('.password-toggle').removeClass('fa-eye');
            $('.password-toggle').addClass('fa-eye-slash');
        } else {
            password_input.type = 'password';
            $('.password-toggle').addClass('fa-eye');
            $('.password-toggle').removeClass('fa-eye-slash');
        }

    }
</script>


</html>
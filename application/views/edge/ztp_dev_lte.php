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
                    <h5><b>Edge ZTP - LTE Settings - <?php echo $sno; ?> - <?php foreach ($device_info as $info) {
                                                                                echo $info->details;
                                                                            } ?> </h5>
                </div>






                <?php if ($lteport == "lte1") {
                    $_lteport = "LTE1";
                } elseif ($lteport == "lte2") {
                    $_lteport = "LTE2";
                } elseif ($lteport == "lte3") {
                    $_lteport = "LTE3";
                }
                $_signal_strength = " ";

                foreach ($port_info as $info) {

                    $signal_strength = $info->_lte_signal_strength;
                    if ($signal_strength == "error") {
                        $_signal_strength = "error";
                    } elseif ($signal_strength == "excellent") {
                        $_signal_strength = '<td style="padding:0px;"><div style="background-color:#00baad;width:7px;height:8px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#00baad;width:7px;height:12px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#00baad;width:7px;height:16px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#00baad;width:7px;height:20px;border-radius:2px;"></div></td>';
                    } elseif ($signal_strength == "good") {
                        $_signal_strength = '<td style="padding:0px;"><div style="background-color:#add45c;width:7px;height:8px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#add45c;width:7px;height:12px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#add45c;width:7px;height:16px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:16px;border-radius:2px;"></div></td>';
                    } elseif ($signal_strength == "fair") {
                        $_signal_strength = '<td style="padding:0px;"><div style="background-color:#FF5733;width:7px;height:8px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#FF5733;width:7px;height:12px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:16px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:20px;border-radius:2px;"></div></td>';
                    } elseif ($signal_strength == "bad") {
                        $_signal_strength = '<td style="padding:0px;"><div style="background-color:#C70039;width:7px;height:8px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:16px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:16px;border-radius:2px;"></div></td><td style="padding:0px;"><div style="background-color:#fff;width:7px;height:16px;border-radius:2px;"></div></td>';
                    }

                ?>

                    <div class="form-group">

                        <div class="row lables">
                            <div class="col-lg-3">
                                Port
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $_lteport; ?>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Carrier
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_carrier; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                IMEI
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_imei; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Connection Status
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_link_status; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Signal Strength
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $_signal_strength; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                IP Address
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_ipaddr; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Netmask
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_netmask; ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Gateway
                            </div>
                            <div class="col-lg-3 column_value">
                                <?php echo $info->_lte_gateway; ?>
                            </div>
                        </div>
                        <?php $ipaddr_meta_dump = '';

                        if ($info->_lte_ipaddr != 'notset') {
                            $ipaddr_meta       = json_decode(file_get_contents("http://ipinfo.io/{$info->_lte_ipaddr}/json"));
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

                        if ($ipaddr_meta_dump != null) { ?>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    IP Whois Details
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $ipaddr_meta_dump; ?>">
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                <?php } ?>


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

</html>
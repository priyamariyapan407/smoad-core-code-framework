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
                            <h5><b>IMS - Ticketing Servers</b></h5>
                        </div>
                    </div>
                </div>
                <div>[Interface]</div>

                <div class="form-group">
                    <?php foreach ($peer_info as $info) {
                        $prikey = $info->prikey;
                        $allowedipsubnet = $info->allowedipsubnet;
                        $device_serialnumber = $info->device_serialnumber;
                        echo "<div>PrivateKey = $prikey</div>";
                        echo "<div>Address = $allowedipsubnet </div>";
                    }
                    ?>
                    <div>DNS = 8.8.8.8</div>
                    <br>
                    <div>[Peer]</div>
                    <?php foreach ($server_info as $info) {
                        $pubkey = $info->pubkey;
                        $ipaddr = $info->ipaddr;
                        echo "<div>PublicKey = $pubkey</div>";
                        echo "<div>AllowedIPs = 0.0.0.0/0</div>";
                        echo "<div>Endpoint = $ipaddr:51820</div>";
                    }

                    $config = "[Interface]\n";
                    $config .= "PrivateKey = $prikey\n";
                    $config .= "Address = $allowedipsubnet\n";
                    $config .= "DNS = 8.8.8.8\n";
                    $config .= "\n";
                    $config .= "[Peer]\n";
                    $config .= "PublicKey = $pubkey\n";
                    $config .= "AllowedIPs = 0.0.0.0/0\n";
                    $config .= "Endpoint = $ipaddr" . ":51820\n";
                    file_put_contents("images/softclient.conf", $config);
                    ?>
                    <div class="row lables mrgn_top">
                        <div class="col-lg-1">
                            <a href="softclient.conf" download="SMOADsoftclient<?php echo $device_serialnumber ?>.conf">
                                <input type="button" class="btn btn-block btn-success" value="Download">
                            </a>
                        </div>

                        <div class="col-lg-1">
                            <a href="<?php echo base_url('Gateway/gateway_network/' . $server_id . '/' . $serialnumber) ?>">
                                <input type="button" class="btn btn-block btn-success" value="Back">
                            </a>
                        </div>

                    </div>



                </div>


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




</html>
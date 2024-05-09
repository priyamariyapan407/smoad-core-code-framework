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
                    <h5><b>Edge ZTP - LAN Settings - <?php echo $sno; ?> - dual tunne ...</b></h5>
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


                <form action="<?php echo base_url('Edge/save_ztp_dev_lan/' . $id . '/' . $sno) ?>" method="post">

                    <?php foreach ($lan_info as $info) {

                        $id = $info->id;
                        $ipaddr = $info->lan_ipaddr;
                        $netmask = $info->lan_netmask;

                    ?>

                        <div class="form-group">

                            <div class="row lables">
                                <div class="col-lg-3">
                                    IP Address
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="lan_ipaddr" value="<?php echo $ipaddr; ?>" placeholder="Enter ipaddr">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" placeholder="Enter ipaddr">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Netmask
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="lan_netmask" value="<?php echo $netmask; ?>" placeholder="Enter netmask">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">

                                <?php if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>
                                    <div class="col-lg-1">
                                        <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                                    </div>
                                <?php } ?>
                                <div class="col-lg-1"><a href="<?php echo base_url('Edge/edge_config/' . $id . '/' . $sno); ?>">
                                        <input type="button" class="btn btn-block btn-success" value="Back"></a></div>
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
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
                    <h5><b>Add Server:</b></h5>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>


                <form action="<?php echo base_url('Edge/save_edge') ?>" method="post">
                    <div class="form-group">

                        <div class="row lables">
                            <div class="col-lg-3">
                                Details
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="details" placeholder="Enter details">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                License
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="license" placeholder="Enter license" value="license" readonly>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Model & Variant
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control select2 select" name="model_and_variant">
                                    <option value="spider_l2">SMOAD Spider - L2 SD-WAN</option>
                                    <option value="spider_l2w1l2">SMOAD Spider - L2 SD-WAN (L2W1L2)</option>
                                    <option value="spider_l3">SMOAD Spider - L3 SD-WAN</option>
                                    <option value="spider_mptcp">SMOAD Spider - MPTCP</option>
                                    <option value="spider2_l2">SMOAD Spider2 (Supermicro) - L2 SD-WAN</option>
                                    <option value="spider2_l3">SMOAD Spider2 (Supermicro) - L3 SD-WAN</option>
                                    <option value="beetle_l2">SMOAD Beetle - L2 SD-WAN</option>
                                    <option value="beetle_l3">SMOAD Beetle - L3 SD-WAN</option>
                                    <option value="bumblebee_l2">SMOAD BumbleBee - L2 SD-WAN</option>
                                    <option value="bumblebee_l3">SMOAD BumbleBee - L3 SD-WAN</option>
                                    <option value="wasp1_l2">SMOAD Wasp1 - L2 SD-WAN</option>
                                    <option value="wasp2_l2">SMOAD Wasp2 - L2 SD-WAN</option>
                                    <option value="vm_l2">SMOAD VM - L2 SD-WAN</option>
                                    <option value="vm_l3">SMOAD VM - L3 SD-WAN</option>
                                    <option value="vm_mptcp">SMOAD VM - MPTCP</option>
                                    <option value="soft_client">SMOAD Soft-client</option>
                                </select>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Os
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control select2 select" name="os">
                                    <option value="openwrt">OpenWRT</option>
                                    <option value="ubuntu">Ubuntu</option>
                                </select>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Area
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="area" placeholder="Enter area">
                            </div>
                        </div>


                        <div class="row lables mrgn_top">
                            <div class="col-lg-1">
                                <input type="submit" class="btn btn-block btn-success" value="Add"></button>
                            </div>
                            <div class="col-lg-1"><a href="<?php echo base_url('Edge/index'); ?>">
                                    <input type="button" class="btn btn-block btn-success" value="Back"></a>
                            </div>
                        </div>

                    </div>
                </form>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


</html>
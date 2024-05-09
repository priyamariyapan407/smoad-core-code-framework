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


                <form action="<?php echo base_url('Gateway/save_vlan/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')) ?>" method="post">
                    <div class="form-group">

                        <div class="row lables">
                            <div class="col-lg-3">
                                Details
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="details" placeholder="Enter Details">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                vlan_id
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="vlan_id" placeholder="Enter vlan_id">
                            </div>
                        </div>


                        <div class="row lables mrgn_top">
                            <div class="col-lg-1">
                                <input type="submit" class="btn btn-block btn-success" value="Add"></button>
                            </div>
                            <div class="col-lg-1"><a href="<?php echo base_url('Gateway/index'); ?>">
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
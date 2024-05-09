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
                        <?php if ($this->session->flashdata('error_msgs')) { ?>
                            <div class='alert_msg alert_msg-danger error_msg' role="alert">
                                <?= $this->session->flashdata('error_msgs'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>


                <form action="<?php echo base_url('Ims/update_server') ?>" method="post">


                    <div class="form-group">
                        <?php foreach ($ims_info as $ims) { ?>
                            <div class="row lables">
                                <div class="col-lg-3">
                                    Details
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="details" value="<?php echo $ims->details; ?>" placeholder="Enter details">
                                    <input type="hidden" name="id" value="<?php echo $ims->id; ?>">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    License
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="license" value="<?php echo $ims->license; ?>" placeholder="Enter license">
                                </div>
                            </div>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Serial Number
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="serialnumber" value="<?php echo $ims->serialnumber; ?>" placeholder="Enter serial number">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Type
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $ims->type; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    IP Addr or DNS
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="ipaddr" value="<?php echo $ims->ipaddr; ?>" placeholder="Enter ip or DNS">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    API Key
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="api_key" value="<?php echo $ims->api_key; ?>" placeholder="Enter api key">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Area
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="area" value="<?php echo $ims->area; ?>" placeholder="Enter area">
                                </div>
                            </div>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-1">
                                    <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                                </div>
                                <div class="col-lg-1"><a href="<?php echo base_url('Ims/index') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
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

</html>
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





                <div class="form-group">
                    <?php foreach ($user_info as $info) { ?>


                        <div class="row lables">
                            <div class="col-lg-3">
                                Name
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->name ?>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Username
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->username ?>
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Password
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->password ?>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Area
                            </div>
                            <div class="col-lg-3">
                                <?php echo $info->area ?>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Access
                            </div>
                            <div class="col-lg-3">
                                <!-- <select class="form-control select2" name="access" readonly>
                                            <option value="limited" <?php echo $info->access_level == "limited" ? 'selected' : '' ?> >LIMITED</option>
                                            <option value="admin" <?php echo $info->access_level == "admin" ? 'selected' : '' ?> >ADMIN</option>
                                            <option value="block" <?php echo $info->access_level == "block" ? 'selected' : '' ?> >BLOCK</option>
                                        </select> -->
                                <?php echo $info->access_level; ?>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">

                            <div class="col-lg-1"><a href="<?php echo base_url('User/index') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
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
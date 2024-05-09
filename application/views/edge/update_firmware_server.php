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
                            <h5><b>Firmware Server Settings</b></h5>
                        </div>
                        <?php if ($this->session->flashdata('success_msg')) { ?>
                            <div class='col-lg-6 bg-success-msg' role="alert">
                                <?= $this->session->flashdata('success_msg'); ?>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error_msgs')) { ?>
                            <div class='alert_msg alert_msg-danger error_msg' role="alert">
                                <?= $this->session->flashdata('error_msgs'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>


                <form action="<?php echo base_url('Edge/save_firmware_info') ?>" method="post">

                    <div class="form-group">
                        <?php foreach ($firmware_info as $info) { ?>


                            <div class="row lables">
                                <div class="col-lg-3">
                                    Name
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->update_firmware_server_user ?>" name="update_firmware_server_user" placeholder="Enter name">
                                    <input type="hidden" class="form-control" value="<?php echo $info->id ?>" name="id" placeholder="Enter name">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    IP Address
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->update_firmware_server_ipaddr; ?>" name="update_firmware_server_ipaddr" placeholder="Enter ip address">
                                </div>
                            </div>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Basepath
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->update_firmware_server_base_path ?>" name="update_firmware_server_base_path" placeholder="Enter base path">
                                </div>
                            </div>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Password
                                </div>
                                <div class="col-lg-3">
                                    <input type="password" class="form-control" value="<?php echo $info->update_firmware_server_pass ?>" name="update_firmware_server_pass" placeholder="Enter password" id="password">
                                    <i class="fa fa-eye password-toggle" onclick="togglePasswordVisibility()"></i>
                                </div>
                            </div>



                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Firmware Version
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->update_firmware_release_version ?>" name="update_firmware_release_version" placeholder="Enter version">


                                </div>
                            </div>

                            <div class="row lables mrgn_top">

                                <div class="col-lg-1">
                                    <input type="submit" class="btn btn-block btn-success" value="Update"></button>
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
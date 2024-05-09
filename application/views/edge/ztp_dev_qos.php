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
                            <h5><b>Edge ZTP - QoS Settings -
                                    <?php echo $sno; ?> -
                                    <?php foreach ($device_info as $info) {
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
                                <?= $this->session->flashdata('success_msg'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>


                <form action="<?php echo base_url('Edge/save_ztp_dev_qos/' . $id . '/' . $sno) ?>" method="post">

                    <div class="form-group">
                        <?php

                        if ($this->session->userdata('accesslevel') == 'access_level_limited') {
                            $readonly = 'readonly';
                        } else {
                            $readonly = '';
                        }

                        foreach ($app_info as $info) { //echo "<pre>"; print_r($info); 
                            $id = $info->id;
                            $qos_enabled = $info->qos_enabled;
                            if ($qos_enabled == "TRUE") {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }
                        }
                        ?>
                            <input type="hidden" name="qos_enabled_before" value="<?php echo $qos_enabled; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Enable
                                </div>
                                <div class="col-lg-3">
                                    <input type="checkbox" name="qos_enabled" id="qos_enabled" value="TRUE" <?php echo  $qos_enabled . ' ' . $checked ?> />
                                </div>
                            </div>



                            <div class="row lables mrgn_top">
                                <div class="row">

                                    <div class="col-lg-1">
                                        <?php if ($this->session->userdata('accesslevel') != 'access_level_limited') { ?>
                                            <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                                    </div>
                                <?php } ?>

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
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
                            <h5><b>Edge ZTP - QoS Application Prioritization -
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


                <form action="<?php echo base_url('Edge/save_ztp_dev_qos_app_prio/' . $id . '/' . $sno) ?>" method="post">

                    <div class="form-group">
                        <?php

                        if ($this->session->userdata('accesslevel') == 'access_level_limited') {
                            $readonly = 'readonly';
                        } else {
                            $readonly = '';
                        }

                        foreach ($app_info as $info) { //echo "<pre>"; print_r($info); 
                            $id = $info->id;
                            $qos_microsoft_teams = $info->qos_microsoft_teams;
                            $qos_youtube = $info->qos_youtube;
                            $qos_iperf = $info->qos_iperf;
                            $qos_voip = $info->qos_voip;
                            $qos_skype = $info->qos_skype;
                            $qos_zoom = $info->qos_zoom;
                            $qos_sdwan = $info->qos_sdwan;
                        ?>
                            <input type="hidden" name="qos_microsoft_teams_before" value="<?php echo $qos_microsoft_teams; ?>">
                            <input type="hidden" name="qos_youtube_before" value="<?php echo $qos_youtube; ?>">
                            <input type="hidden" name="qos_iperf_before" value="<?php echo $qos_iperf; ?>">
                            <input type="hidden" name="qos_voip_before" value="<?php echo $qos_voip; ?>">
                            <input type="hidden" name="qos_skype_before" value="<?php echo $qos_skype; ?>">
                            <input type="hidden" name="qos_zoom_before" value="<?php echo $qos_zoom; ?>">
                            <input type="hidden" name="qos_sdwan_before" value="<?php echo $qos_sdwan; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Zoom Meetings
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_zoom">
                                        <option value="high" <?php echo $qos_zoom == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_zoom == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_zoom == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Microsoft Teams
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_microsoft_teams">
                                        <option value="high" <?php echo $qos_microsoft_teams == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_microsoft_teams == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_microsoft_teams == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Youtube
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_youtube">
                                        <option value="high" <?php echo $qos_youtube == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_youtube == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_youtube == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Skype
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_skype">
                                        <option value="high" <?php echo $qos_skype == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_skype == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_skype == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    VOIP
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_voip">
                                        <option value="high" <?php echo $qos_voip == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_voip == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_voip == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    iperf
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_iperf">
                                        <option value="high" <?php echo $qos_iperf == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_iperf == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_iperf == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    SD-WAN
                                </div>
                                <div class="col-lg-3">

                                    <select class="form-control select2 table_menus select" style="width: 100%;" name="qos_sdwan">
                                        <option value="high" <?php echo $qos_sdwan == 'high' ? 'selected' : ''; ?>>high</option>
                                        <option value="medium" <?php echo $qos_sdwan == 'medium' ? 'selected' : ''; ?>>medium</option>
                                        <option value="low" <?php echo $qos_sdwan == 'low' ? 'selected' : ''; ?>>low</option>
                                    </select>
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
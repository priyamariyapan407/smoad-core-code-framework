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
                            <h5><b>Edge ZTP - Home - <?php echo $sno; ?> - <?php //$CI = &get_instance(); $CI->session->unset_userdata('session_model');
                                      // $CI->session->unset_userdata('session_model_variant');
                                       foreach ($device_info as $info) {

                                                                       
                                                                                echo $info->details;
                                                                            } ?>
                                </b></h5>
                        </div>
                        <?php if ($this->session->flashdata('error_msgs')) { ?>
                            <div class='alert_msg alert_msg-danger error_msg' role="alert">
                                <?= $this->session->flashdata('error_msgs'); ?> </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-2">


                    </div>
                </div>


                <form action="<?php echo base_url('Edge/save_edited_info') ?>" method="post">

                    <div class="form-group">
                        <?php foreach ($edge_info as $info) { ?>


                            <div class="row lables">
                                <div class="col-lg-3">
                                    ID
                                </div>
                                <div class="col-lg-3">

                                    <?php echo $info['id']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Serial Number
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['serialnumber']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Details
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control details" value="<?php echo $info['details']; ?>" name="details" placeholder="Enter details">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Area
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control area" name="area" placeholder="Enter area" value="<?php echo $info['area']; ?>">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Model
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['model']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Model Variant
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['model_variant']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Os
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['os']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Firmware
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['firmware']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Uptime
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['uptime']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Boot Up Count (past 24 hours)
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['boot_up_count']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Last Boot Up Timestamp
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['boot_up_count_timestamp']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Gateway
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['gateway_details']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Root Password
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['root_password']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Superadmin Password
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['superadmin_password']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Customer
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['smoad_customer']; ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Provision Ready ?
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info['provision_ready'] == true ? '<span class="provision_true"></span>' : '<span class="provision_false"></span>' ?>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">

                                <div class="col-lg-2">
                                    <input type="text" class="btn btn-block btn-success" onclick="update('update')" value="Update"></button>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="btn btn-block btn-success" value="Reboot" onclick="update('reboot')"></button>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="btn btn-block btn-success" value="Reprovision" onclick="update('reprovision')"></button>
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" class="btn btn-block btn-success" value="Reset SDWAN" onclick="update('reset_sdwan')"></button>
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
    function update(job) {
        var id = $('.id').val();
        var details = $('.details').val();
        var area = $('.area').val();
        var serialnumber = $('.serialnumber').val();
        $.ajax({
            'url': '<?php echo base_url('Edge/save_edited_info') ?>',
            'method': 'post',
            'data': {
                'edge_id': id,
                'details': details,
                'area': area,
                'serialnumber': serialnumber,
                'job': job
            },
            'success': function(data) {
                console.log(data);
                window.location = '<?php echo base_url('Edge/index') ?>';
            }
        });
    }
</script>

</html>
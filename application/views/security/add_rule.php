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
                    <h5><b>Add New Firewall Rule:</b></h5>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>


                <form action="<?php echo base_url('Security/save_rule') ?>" method="post">
                    <div class="form-group">

                        <div class="row lables">
                            <div class="col-lg-3">
                                Port
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="port" placeholder="Enter port">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Source MAC
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="src_mac" placeholder="Enter source mac">
                            </div>
                        </div>
                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Destination MAC
                            </div>
                            <div class="col-lg-3 password-container">
                                <input type="text" class="form-control" name="dst_mac" placeholder="Enter destination mac">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Source IP-Address
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="src_ip" placeholder="Enter source ip address">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Destination IP-Address
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="dst_ip" placeholder="Enter destination ip address">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Protocol
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control select2 select" name="proto">
                                    <option value="*" default>ANY</option>
                                    <option value="6">TCP</option>
                                    <option value="17">UDP</option>
                                    <option value="1">ICMP</option>
                                </select>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Source Port
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="src_port" placeholder="Enter source port">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Destination Port
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="dst_port" placeholder="Enter destination port">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Action
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control select2 select" name="action">
                                    <option value="drop">Drop</option>
                                    <option value="allow">Allow</option>
                                    <option value="monitor">Monitor</option>
                                </select>
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                Description
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="description" placeholder="Enter description">
                            </div>
                        </div>


                        <div class="row lables mrgn_top">
                            <div class="col-lg-1">
                                <input type="submit" class="btn btn-block btn-success" value="Add"></button>
                            </div>
                            <div class="col-lg-1"><a href="<?php echo base_url('Security/firewall') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
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
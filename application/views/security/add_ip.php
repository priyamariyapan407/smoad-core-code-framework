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
                    <h5><b>Add New IP:</b></h5>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>


                <form action="<?php echo base_url('Security/add_new_ip') ?>" method="post">
                    <div class="form-group">

                        <div class="row lables">
                            <div class="col-lg-3">
                                Source IP-Address
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="src_ip" placeholder="Enter source ip address">
                            </div>
                        </div>

                        <div class="row lables mrgn_top">
                            <div class="col-lg-3">
                                type
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control select2 select" name="type">
                                    <option value="whitelist">Whitelist</option>
                                    <option value="blacklist">Blacklist</option>
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
                            <div class="col-lg-1"><a href="<?php echo base_url('Security/iplist') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
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
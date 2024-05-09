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
                            <h5><b>Update user</b></h5>
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


                <form action="<?php echo base_url('User/save_edited_info') ?>" method="post">

                    <div class="form-group">
                        <?php foreach ($user_info as $info) { ?>


                            <div class="row lables">
                                <div class="col-lg-3">
                                    Name
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->name ?>" name="name" placeholder="Enter name">
                                    <input type="hidden" class="form-control" value="<?php echo $info->id ?>" name="id" placeholder="Enter name">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Username
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info->username; ?>
                                    <input type="hidden" class="form-control" value="<?php echo $info->username; ?>" name="username" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Password
                                </div>
                                <div class="col-lg-3">
                                    <input type="password" class="form-control" value="<?php echo $info->password ?>" name="password" placeholder="Enter password" id="password">
                                    <i class="fa fa-eye password-toggle" onclick="togglePasswordVisibility()"></i>
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Area
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="<?php echo $info->area ?>" name="area" placeholder="Enter area">
                                </div>
                            </div>

                            <div class="row lables mrgn_top">
                                <div class="col-lg-3">
                                    Access
                                </div>
                                <div class="col-lg-3">
                                    <?php echo $info->access_level; ?>
                                    <!-- <input type="hidden" class="form-control" value="<?php // echo $info->access_level; 
                                                                                            ?>"
                                                name="access_level" placeholder="Enter access_level" >
                                            <option value="limited" <?php // echo $info->access_level == "limited" ? 'selected' : '' 
                                                                    ?> >LIMITED</option>
                                            <option value="admin" <?php // echo $info->access_level == "admin" ? 'selected' : '' 
                                                                    ?> >ADMIN</option>
                                            <option value="block" <?php // echo $info->access_level == "block" ? 'selected' : '' 
                                                                    ?> >BLOCK</option>
                                        </select>  -->
                                </div>
                            </div>

                            <div class="row lables mrgn_top">

                                <div class="col-lg-1">
                                    <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                                </div>
                                <div class="col-lg-1">
                                    <a href="<?php echo base_url('User/index') ?>">
                                        <input type="button" class="btn btn-block btn-success" value="Back">
                                    </a>
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
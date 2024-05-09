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
                    <div class="col-lg-11">
                        <div>
                            <h5><b>Security - Firewall IP List</b></h5>
                        </div>
                    </div>
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin') || ($this->session->userdata('accesslevel') == 'customer')) {  ?>
                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url('Security/add_ip') ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_failure'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_success'); ?> </div>
                <?php } ?>
                <?php if ($this->session->flashdata('update_msgs')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('update_msgs'); ?> </div>
                <?php } ?>

                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <div>
                                            <h6><b>Applied Firewall Rules:</b></h6>
                                        </div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Source IP-Address</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($ip_lists as $list) {



                                                    if ($list->type == "whitelist") {
                                                        $list_type = 'WHITELIST';
                                                        $bg_style = "color:#2981e4;font-weight:bold;";
                                                    } else if ($list->type == "blacklist") {
                                                        $list_type = 'BLACKLIST';
                                                        $bg_style = "color:#2981e4;font-weight:bold;";
                                                    } else {
                                                        $list_type = '<span><i class="fa fa-times"></i></span>';
                                                    }

                                                ?>
                                                    <tr>

                                                        <td> <?php echo $list->id ?> </td>
                                                        <td style=" <?php echo $bg_style ?>"> <?php echo $list_type ?></td>
                                                        <td> <?php echo $list->src_ip ?></td>
                                                        <td> <?php echo $list->description ?></td>
                                                        <td>
                                                            <?php
                                                            if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>

                                                                <span class="fa_view" style="margin: 2%;">

                                                                    <a style="color:#000 !important" href="<?php echo base_url('Security/delete_ip/' . $list->id) ?>">
                                                                        <span class='fa fa-trash'></span>
                                                                    </a>

                                                                </span>

                                                            <?php } ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                            </tfoot>
                                        </table>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <!-- /.card -->

                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>







<script>
    $(function() {

        var dataTable = $('#users_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });


    });
</script>

</html>
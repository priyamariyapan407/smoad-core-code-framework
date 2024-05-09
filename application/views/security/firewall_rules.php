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
                            <h5><b>Security - Firewall Log</b></h5>
                        </div>
                    </div>
                    <div class="col-lg-1 txt-end">
                        <div><a href="<?php echo base_url('Security/add_rule') ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                    </div>
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
                                                    <th>Port</th>
                                                    <th>Source MAC</th>
                                                    <th>Destination MAC</th>
                                                    <th>Source IP-Address</th>
                                                    <th>Destination IP-Address</th>
                                                    <th>Protocol</th>
                                                    <th>Source Port</th>
                                                    <th>Destination Port</th>
                                                    <th>Action</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($rules as $rule) {

                                                    if ($rule->action == "allow") {
                                                        $_action = "ALLOW";
                                                        $bg_style = "color:#2981e4;font-weight:bold;\"";
                                                    } else if ($rule->action == "monitor") {
                                                        $_action = "MONITOR";
                                                        $bg_style = "color:#4d916a;font-weight:bold;\"";
                                                    } else if ($rule->action == "drop") {
                                                        $_action = "DROP";
                                                        $bg_style = "color:#D84430;font-weight:bold;\"";
                                                    }

                                                    if ($rule->proto == "6") {
                                                        $_proto = "TCP";
                                                    } else if ($rule->proto == "17") {
                                                        $_proto = "UDP";
                                                    } else if ($rule->proto == "1") {
                                                        $_proto = "ICMP";
                                                    } else if ($rule->proto == "*") {
                                                        $_proto = "ANY";
                                                    }

                                                    if ($rule->type == "user") {
                                                        $user_type = '<span><i class="fa fa-user"></i></span>';
                                                    } else if ($rule->type == "ips") {
                                                        $user_type = '<span><i class="fa-solid fa-microchip-ai"></i></span>';
                                                    } else {
                                                        $user_type = '<span><i class="fa fa-times"></i></span>';
                                                    }

                                                ?>
                                                    <tr>

                                                        <td> <?php echo $rule->id ?> </td>
                                                        <td> <?php echo $user_type ?></td>
                                                        <td> <?php echo $rule->port ?></td>
                                                        <td> <?php echo $rule->src_mac ?></td>
                                                        <td> <?php echo $rule->dst_mac ?></td>
                                                        <td> <?php echo $rule->src_ip ?> </td>
                                                        <td> <?php echo $rule->dst_ip ?></td>
                                                        <td> <?php echo $_proto ?></td>
                                                        <td> <?php echo $rule->src_port ?></td>
                                                        <td> <?php echo $rule->dst_port ?></td>
                                                        <td style="<?php echo $bg_style; ?>"> <?php echo $_action ?></td>
                                                        <td> <?php echo $rule->description ?></td>
                                                        <td>
                                                            <?php



                                                            if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>

                                                                <span class="fa_view" style="margin: 2%;">

                                                                    <a style="color:#000 !important" href="<?php echo base_url('Security/delete_rule/' . $rule->id) ?>">
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
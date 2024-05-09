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
                            <h5><b>SD-WAN Servers</b></h5>
                        </div>
                    </div>
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) {  ?>

                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url('Gateway/add_server') ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
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

                                <table id="users_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Details</th>
                                            <th>License</th>
                                            <th>Serial Number</th>
                                            <th>IP Addr (or DNS)</th>
                                            <th>Type</th>
                                            <th>Area</th>
                                            <th>Assigned Devices</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">
                                        <?php foreach ($servers as $server) { ?>
                                            <tr>
                                                <?php
                                                $type = $server['type'];
                                                if ($type == "l2") {
                                                    $type = "L2 SD-WAN";
                                                } else if ($type == "l3") {
                                                    $type = "L3 SD-WAN";
                                                } else if ($type == "mptcp") {
                                                    $type = "MPTCP";
                                                }

                                                ?>


                                                <td> <?php echo $server['id']; ?> </td>
                                                <td> <?php echo $server['details']; ?></td>
                                                <td> <?php echo $server['license']; ?></td>
                                                <td> <?php echo $server['serialnumber']; ?></td>
                                                <?php $ipaddress = $server['ipaddr']; ?>
                                                <td> <a href="https://<?php echo $ipaddress; ?>" target="_blank"><?php echo $ipaddress; ?></a> </td>
                                                <td> <?php echo $type; ?></td>
                                                <td> <?php echo $server['area']; ?></td>
                                                <td> <?php echo $server['assigned_devices']; ?></td>

                                                <?php
                                                if ($server['status'] == "up" || $server['status'] == "UP") {
                                                    $status = '<div class="status"><i class="fa fa-arrow-up status_up" aria-hidden="true"></i></div>';
                                                } else {
                                                    $status = '<div class="status"><i class="fa fa-arrow-down status_down" aria-hidden="true"></i></div>';
                                                }

                                                ?>
                                                <td> <?php echo $status; ?></td>
                                                <td>

                                                    <span class="fa_edit" style="margin: 2%;">
                                                        <a style="color:#000 !important" href="<?php echo base_url('Gateway/update_server/' . $server['id']) ?>"><span class='fas fa-edit'></span></a>
                                                    </span>

                                                    <span style="margin: 2%;">
                                                        <a style="color:#000 !important" href="<?php echo base_url('Gateway/gateway_devices/' . $server['id'] . '/' . $server['serialnumber'] . '/gateway') ?>"><span class='fas fa-tasks'></span></a>
                                                    </span>
                                                    <span style="margin: 2%;">
                                                        <a style="color:#000 !important" href="<?php echo base_url('Gateway/gateway_network/' . $server['id'] . '/' . $server['serialnumber']) ?>"><span class="fas fa-network-wired"></span></a>
                                                    </span>
                                                    <span style="margin: 2%;">
                                                        <a style="color:#000 !important" href="<?php echo base_url('Gateway/engineering_debug/' . $server['id'] . '/' . $server['serialnumber']) ?>"><span class="fa fa-clock"></span></a>
                                                    </span>
                                                    <?php if (($server['assigned_devices'] == 0) && (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin') || ($this->session->userdata('accesslevel') == 'customer'))) {  ?>
                                                        <span class="fa_delete" style="margin: 2%;">
                                                            <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deleteid('<?php echo $server['id'] ?>')">
                                                                <span class="fa fa-trash"></span></span>
                                                        </span>
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    </tfoot>
                                </table>
                                <div class="col-lg-2">
                                    <div id="delete-selected">
                                        <button type="button" class="btn btn-block btn-primary btn-sm" fdprocessedid="qjv3e">Delete Selected</button>
                                    </div>

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
    function deleteid(id) {

        $.ajax({
            'url': '<?php echo base_url('Gateway/delete_server') ?>',
            'method': 'post',
            'data': {
                'server_id': id
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/Gateway' ?>';
            }
        })

    }
</script>



<script>
    $(function() {
        $('#users_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
    });
</script>

</html>
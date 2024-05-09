<!DOCTYPE html>
<html lang="en">
<?php $path = APPPATH . 'views/header.php';
include "$path"; ?>

<?php $path = APPPATH . 'views/sidebar.php';
include "$path"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="edge_device">
                <div class="row heading">
                    <div class="col-lg-10">
                        <div>
                            <h5><b>SMOAD Edge Devices</b></h5>
                        </div>
                    </div>
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) { ?>

                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url('Edge/add_edge') ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                        </div>

                    <?php } ?>

                    <?php if (($this->uri->segment('4') == 'device_per_port') || ($this->uri->segment('4') == 'device_per_model')) { ?>

                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url('Welcome/dashboard') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
                        </div>

                    <?php } ?>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?=$this->session->flashdata('error_msgs'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?=$this->session->flashdata('delete_msg_failure'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?=$this->session->flashdata('success_msg'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?=$this->session->flashdata('delete_msg_success'); ?> </div>
                <?php } ?>
<?php if ($this->session->flashdata('update_msgs')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?=$this->session->flashdata('update_msgs'); ?> </div>
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
                                            <th>Model - Variant</th>
                                            <th>Area</th>
                                            <th>Gateway</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">
                                        <?php foreach ($devices as $device) { $background_color = $class = '';

                                                if (($device['status'] == "up" || $device['status'] == "UP") && ($device['wan_up'] == "true")) {
                                                    $background_color = 'background-color:rgba(0,116,235,0.9)';
                                                    $class            = 'fa-arrow-up';
                                                } elseif (($device['status'] == "up" || $device['status'] == "UP") && ($device['lte_up'] == "true")) {
                                                    $background_color = 'background-color:rgba(246,211,84,0.9)';
                                                    $class            = 'fa-arrow-up';
                                                } elseif (($device['status'] == "up" || $device['status'] == "UP") && ($device['wan_lte_up'] == "true")) {
                                                    $background_color = 'background-color:rgba(29,118,50,0.9)';
                                                    $class            = 'fa-arrow-up';
                                                } elseif (($device['status'] == "down" || $device['status'] == "DOWN") && ($device['wan_lte_down'] == "true")) {
                                                    $background_color = 'background-color:rgba(255,12,62,0.9)';
                                                    $class            = 'fa-arrow-down';
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $device['id']; ?> </td>
                                                <td><?php echo $device['details']; ?></td>
                                                <td><?php echo $device['license']; ?></td>
                                                <td><?php echo $device['serialnumber']; ?></td>
                                                <td><?php echo $device['model'] . " - " . $device['model_variant']; ?></td>
                                                <td><?php echo $device['area']; ?></td>
                                                <td> <a href="<?php echo base_url('Gateway/gateway_devices/' . $device['server_id'] . '/' . $device['server_sno'] . '/edge'); ?>"><?php echo $device['server_details']; ?></a></td>

                                                <td><div class="status"><i class="fa <?=$class ?> port_css" style="<?php echo $background_color; ?>" aria-hidden="true"></i></div></td>
                                                <td>

                                                    <!-- <span class="fa_edit" style="margin: 2%;">
                                                            <a style="color:#000 !important"
                                                                href="<?php // echo base_url('Edge/update_edge/' . $device['id']) ?>"><span
                                                                    class='fas fa-edit'></span></a>
                                                    </span> -->
                                                    <?php if ($device['model'] != 'Soft-client') { ?>

                                                        <span style="margin: 2%;">
                                                            <a style="color:#000 !important" href="<?php echo base_url('Edge/update_edge/' . $device['id'] . '/' . $device['serialnumber']) ?>"><span class="fa fa-cog"></span></a>
                                                        </span>

                                                        <!-- <span style="margin: 2%;">
                                                        <a style="color:#000 !important"
                                                                href="<?php //echo base_url('Edge/edge_config/' . $device['id'] . '/' . $device['serialnumber']) ?>"><span
                                                                class="fa fa-cog"></span></a>
                                                        </span> -->

                                                    <?php }
                                                        if ((($device['sdwan_server_id'] == null) && ($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin'))) { ?>
                                                        <span class="fa_delete" style="margin: 2%;">
                                                            <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deleteid('<?php echo $device['id'] ?>')">
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
            'url': '<?php echo base_url('Edge/delete_edge') ?>',
            'method': 'post',
            'data': {
                'edge_id': id
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/Edge' ?>';
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
            ],
        });
    });
</script>

</html>
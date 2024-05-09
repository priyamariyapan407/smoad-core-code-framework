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
                        <?php
                        foreach ($all_info['server'] as $devices) { ?>
                            <div>
                                <h5><b>Gateway ZTP - Devices - <?php echo $devices->serialnumber; ?> - <?php echo $devices->details; ?></b></h5>
                            </div>
                        <?php } ?>

                    </div>
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) {
                        if ($back_button == 'gateway') {
                            $back = 'Gateway/index';
                        } else {
                            $back = 'Edge/index';
                        } ?>
                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url($back); ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a></div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($this->session->flashdata('message')) {
                    if ($this->session->flashdata('message') == 'assigned') {
                        $message = 'The device has been assigned successfully';
                        $style = 'bg-success-msg';
                    } else {
                        $message = 'The device has been unassigned successfully';
                        $style = 'alert_msg alert_msg-danger error_msg';
                    }
                ?>
                    <div class='col-lg-6 <?php echo $style ?>' role="alert">
                        <?php echo $message; ?> </div>
                <?php } ?>







                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="heading">
                                    <b>
                                        <h5>Unassigned Devices:</h5>
                                    </b>
                                </div>

                                <!-- /.card-header -->

                                <table id="unassigned_devices_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Details</th>
                                            <th>License</th>
                                            <th>Serial Number</th>
                                            <th>Model</th>
                                            <th>Area</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">
                                        <?php foreach ($all_info['notset_devices'] as $notset_device) {

                                            $model = $notset_device->model;
                                            if ($model == "spider") {
                                                $_model = "Spider";
                                            } else if ($model == "spider2") {
                                                $_model = "Spider2";
                                            } else if ($model == "beetle") {
                                                $_model = "Beetle";
                                            } else if ($model == "bumblebee") {
                                                $_model = "BumbleBee";
                                            } else if ($model == "wasp1") {
                                                $_model = "Wasp1";
                                            } else if ($model == "wasp2") {
                                                $_model = "Wasp2";
                                            } else if ($model == "vm") {
                                                $_model = "VM";
                                            } else if ($model == "soft_client") {
                                                $_model = "Soft-client";
                                            } else {
                                                $_model = '';
                                            }

                                            $modl = $_model ? $_model : '';
                                            $model_variant = $notset_device->model_variant;
                                            if ($model_variant == "l2") {
                                                $_model_variant = "L2 SD-WAN";
                                            } else if ($model_variant == "l2w1l2") {
                                                $_model_variant = "L2 SD-WAN (L2W1L2)";
                                            } else if ($model_variant == "l3") {
                                                $_model_variant = "L3 SD-WAN";
                                            } else if ($model_variant == "mptcp") {
                                                $_model_variant = "MPTCP";
                                            } else {
                                                $_model_variant = '';
                                            }
                                            $_modelvariant = $_model_variant ? $_model_variant : '';
                                        ?>
                                            <tr>

                                                <td> <?php echo $notset_device->id; ?> </td>
                                                <td> <?php echo $notset_device->details; ?></td>
                                                <td> <?php echo $notset_device->license; ?></td>
                                                <td> <?php echo $notset_device->serialnumber; ?></td>
                                                <td> <?php echo $_modelvariant . " - " . $modl; ?></td>
                                                <td> <?php echo $notset_device->area; ?></td>
                                                <td>
                                                    <span class="fa_view" style="margin: 2%;">
                                                        <a style="color:#000 !important" href="<?php echo base_url('Gateway/set_device/' . $notset_device->id . '/' . $all_info['server'][0]->id . '/' . 'assign/' . $all_info['server'][0]->sdwan_proto . '/' . $notset_device->serialnumber . '/' . $gateway_sno) ?>"> <button type="button" class="btn btn-block btn-success btn-xs" fdprocessedid="qjv3e">Assign</button></a>
                                                    </span>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    </tfoot>
                                </table>


                                <!-- /.card-body -->

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading" style="margin-top:1.5%;">
                                    <b>
                                        <h5>Assigned Devices:</h5>
                                    </b>
                                </div>
                                <!-- /.card-header -->

                                <table id="assigned_devices_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Details</th>
                                            <th>License</th>
                                            <th>Serial Number</th>
                                            <th>Model</th>
                                            <th>Area</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">
                                        <?php foreach ($all_info['assigned_devices'] as $notset_device) {
                                            $model = $notset_device->model;
                                            if ($model == "spider") {
                                                $_model = "Spider";
                                            } else if ($model == "spider2") {
                                                $_model = "Spider2";
                                            } else if ($model == "beetle") {
                                                $_model = "Beetle";
                                            } else if ($model == "bumblebee") {
                                                $_model = "BumbleBee";
                                            } else if ($model == "wasp1") {
                                                $_model = "Wasp1";
                                            } else if ($model == "wasp2") {
                                                $_model = "Wasp2";
                                            } else if ($model == "vm") {
                                                $_model = "VM";
                                            } else if ($model == "soft_client") {
                                                $_model = "Soft-client";
                                            } else {
                                                $_model = '';
                                            }

                                            $modl = $_model ? $_model : '';
                                            $model_variant = $notset_device->model_variant;
                                            if ($model_variant == "l2") {
                                                $_model_variant = "L2 SD-WAN";
                                            } else if ($model_variant == "l2w1l2") {
                                                $_model_variant = "L2 SD-WAN (L2W1L2)";
                                            } else if ($model_variant == "l3") {
                                                $_model_variant = "L3 SD-WAN";
                                            } else if ($model_variant == "mptcp") {
                                                $_model_variant = "MPTCP";
                                            } else {
                                                $_model_variant = '';
                                            }
                                            $_modelvariant = $_model_variant ? $_model_variant : '';
                                        ?>

                                            <tr>
                                                <td> <?php echo $notset_device->id; ?> </td>
                                                <td> <?php echo $notset_device->details; ?></td>
                                                <td> <?php echo $notset_device->license; ?></td>
                                                <td> <?php echo $notset_device->serialnumber; ?></td>
                                                <td> <?php echo $_modelvariant . " - " . $modl; ?></td>
                                                <td> <?php echo $notset_device->area; ?></td>
                                                <td> <?php echo $notset_device->status == "up" ? '<div class="status"><i class="fa fa-arrow-up status_up" aria-hidden="true"></i></div>' : '<div class="status"><i class="fa fa-arrow-down status_down" aria-hidden="true"></i></div>'; ?></td>

                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-1"></div>
                                                        <div class="col-lg-1">
                                                            <span><a href="<?php echo base_url('Gateway/ztp_sds_dev_cfg/' . $id . '/' . $notset_device->serialnumber . '/' . $gateway_sno) ?>"> <i class="fa fa-cog" style="color:#000;"></i></a></span>
                                                        </div>
                                                        <div class="col-lg-1"></div>
                                                        <div class="col-lg-6">
                                                            <span class="fa_view">
                                                                <a style="color:#000 !important" href="<?php echo base_url('Gateway/set_device/' . $notset_device->id . '/' . $all_info['server'][0]->id . '/' . 'unassign/' . $all_info['server'][0]->sdwan_proto . '/' . $notset_device->serialnumber . '/' . $gateway_sno) ?>"> <button type="button" class="btn btn-block btn-danger btn-xs" fdprocessedid="qjv3e">Unassign</button></a>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                    </tfoot>
                                </table>


                                <!-- /.card-body -->

                            </div>

                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<script>
    $(function() {
        $('#unassigned_devices_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
        $('#assigned_devices_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
    });
</script>

</html>
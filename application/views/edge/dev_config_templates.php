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
                            <h5><b>SMOAD Edge Device Config Templates</b></h5>
                        </div>
                        <?php foreach ($template_count as $info) { ?>
                            <div>
                                <p><strong> Config Templates: <?php echo $info->total_items; ?> </p></strong>
                            </div>
                        <?php } ?>

                    </div>

                </div>



                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_failure'); ?> </div>
                <?php } ?>



                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_success'); ?> </div>
                <?php } ?>


                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Template Details</th>
                                                    <th>Details</th>
                                                    <th>Model - Variant</th>
                                                    <th>Area</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($templates as $info) {

                                                    $id = $info->id;
                                                    $template_details = $info->template_details;
                                                    $details = $info->details;
                                                    $model = $info->model;
                                                    $model_variant = $info->model_variant;
                                                    $area = $info->area;
                                                    $vlan_id = $info->vlan_id;
                                                    $enable = $info->enable;

                                                    $_model = $_model_variant = '';
                                                    if ($model == "spider") {
                                                        $_model = "Spider";
                                                    } else if ($model == "spider2") {
                                                        $_model = "Spider2";
                                                    } else if ($model == "beetle") {
                                                        $_model = "Beetle";
                                                    } else if ($model == "bumblebee") {
                                                        $_model = "BumbleBee";
                                                    } else if ($model == "vm") {
                                                        $_model = "VM";
                                                    } else if ($model == "soft_client") {
                                                        $_model = "Soft-client";
                                                    }

                                                    //if($status=='up') { $status="led-green"; } else { $status="led-red"; }
                                                    if ($model_variant == "l2") {
                                                        $_model_variant = "L2 SD-WAN";
                                                    } else if ($model_variant == "l2w1l2") {
                                                        $_model_variant = "L2 SD-WAN (L2W1L2)";
                                                    } else if ($model_variant == "l3") {
                                                        $_model_variant = "L3 SD-WAN";
                                                    } else if ($model_variant == "mptcp") {
                                                        $_model_variant = "MPTCP";
                                                    }

                                                ?>
                                                    <tr>

                                                        <td> <?php echo $id; ?> </td>
                                                        <td> <?php echo $template_details; ?></td>
                                                        <td> <?php echo $details; ?></td>
                                                        <td> <?php echo $_model . ' - ' . $_model_variant; ?></td>
                                                        <td> <?php echo $area; ?></td>
                                                        <td>

                                                            <span class="fa_edit" style="margin: 2%;">
                                                                <a style="color:#000 !important" href="<?php echo base_url('Edge/dev_config_template_details/' . $id) ?>"><span class='fas fa-tasks'></span></a>
                                                            </span>
                                                            <?php if (($this->session->userdata('accesslevel') == 'root') || $this->session->userdata('accesslevel') == 'admin') { ?>
                                                                <span class="fa_delete" style="margin: 2%;">
                                                                    <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deleteid('<?php echo  $id ?>','<?php echo  $details ?>')">
                                                                        <span class="fa fa-trash"></span></span>
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
    function deleteid(id, details) {

        $.ajax({
            'url': '<?php echo base_url('Edge/delete_template') ?>',
            'method': 'post',
            'data': {
                'template_id': id,
                'details': details
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/Edge/dev_config_templates' ?>';
            }
        })

    }
</script>



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
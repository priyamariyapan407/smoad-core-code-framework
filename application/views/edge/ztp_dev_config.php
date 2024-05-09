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
                            <h5><b>Edge ZTP - <span class="log_name"> Device Config </span> -
                                    <?php echo $sno . ' - ';
                                    foreach ($device_info as $info) {
                                        echo $info->details;
                                    } ?>
                                </b></h5>
                        </div>
                    </div>
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) { ?>

                        <div class="col-lg-1 txt-end">
                            <div><a href="<?php echo base_url('Edge/add_ztp_dev_config/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')) ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
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
                <div class="row" style="margin: 0% 0% 2%;">
                    <div class="col-lg-2">Download config</div>
                    <div class="col-lg-1"><span style="cursor:pointer;"> <a href="<?php echo base_url('Edge/download_config/' . $sno) ?>"><span class="fas fa-download"></span></a> </span></div>
                </div>

                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">

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
                                        <?php foreach ($config_info as $info) {

                                            $template_id = $info->id;
                                            $template_details = $info->template_details;
                                            $details = $info->details;
                                            $model = $info->model;
                                            $model_variant = $info->model_variant;
                                            $area = $info->area;
                                            $sdwan_server_ipaddr = $info->sdwan_server_ipaddr;
                                            $vlan_id = $info->vlan_id;
                                            $enable = $info->enable;


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
                                            } else {
                                                $_model = '';
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
                                            } else {
                                                $_model_variant = '';
                                            }

                                        ?>
                                            <tr>
                                                <td> <?php echo $template_id; ?> </td>
                                                <td> <?php echo $template_details; ?></td>
                                                <td> <?php echo $details; ?></td>
                                                <td> <?php echo $_model . ' - ' . $_model_variant; ?></td>
                                                <td> <?php echo $area ?></td>
                                                <td>

                                                    <?php if ((($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin'))) { ?>

                                                        <span class="fa_delete" style="margin: 2%;">
                                                            <span style="cursor:pointer;">
                                                                <a href="<?php echo base_url('Edge/install_dev_config_template/' . $id . '/' . $sno . '/' . $template_id) ?>"><span class="fas fa-download"></span></a> </span>
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
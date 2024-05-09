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
                <div class="row">
                    <div class="col-lg-8">
                        <h5><b>Edge ZTP - <span class="log_name">Consolidated Log </span> -
                                <?php echo $sno . ' - ';
                                foreach ($device_info as $info) {
                                    echo $info->details;
                                } ?>
                            </b></h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select class="form-control select2 table_menus log select" style="width: 100%;">
                                <option value="consolidated_log" selected="selected">Consolidated Logs</option>
                                <option value="link_status">Link status</option>
                                <option value="network_status">Network status</option>
                                <option value="user_access">User access</option>
                            </select>
                        </div>
                    </div>

                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?>
                    </div>
                <?php } ?>


                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">
                            <div class="col-lg-12 log_table">
                                <table id="log_table" class="table table-bordered table-hover log_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>BYTES</th>
                                            <th>RATE</th>
                                            <th>LINK STATUS UP-COUNT</th>
                                            <th>LATENCY</th>
                                            <th>JITTER</th>
                                            <th>TIMESTAMP</th>
                                        </tr>
                                    </thead>
                                    <tbody class="contest_lst">

                                        <?php foreach ($consolidated_logs as $log) { ?>
                                            <tr>
                                                <td><?php echo $log['id']; ?> </td>

                                                <td><strong>WAN1: </strong><br>Rx<?php echo $log['sum_wan1_rx_bytes']; ?> <br>Tx<?php echo $log['sum_wan1_tx_bytes'] ?> <br> <strong>WAN2: </strong> <br>Rx<?php echo $log['sum_wan2_rx_bytes'] ?> <br>Tx<?php echo $log['sum_wan2_tx_bytes'] ?> <br> <strong>LTE1: </strong> <br>Rx<?php echo $log['sum_lte1_rx_bytes'] ?> <br>Tx<?php echo $log['sum_lte1_tx_bytes'] ?> <br> <strong>LTE2: </strong> <br>Rx<?php echo $log['sum_lte2_rx_bytes'] ?> <br>Tx<?php echo $log['sum_lte1_tx_bytes'] ?> <br> <strong>LTE3: </strong><br>Rx<?php echo $log['sum_lte3_rx_bytes'] ?> <br>Tx<?php echo $log['sum_lte3_tx_bytes'] ?> <br> <strong>SD-WAN: </strong><br>Rx<?php echo $log['sum_lte3_rx_bytes'] ?> <br>Tx<?php echo $log['sum_sdwan_tx_bytes'] ?> <br></td>


                                                <td><strong>WAN1: </strong><br>Rx<?php echo $log['avg_wan1_rx_bytes_rate'] ?> <br>Tx<?php echo $log['avg_wan1_tx_bytes_rate'] ?><br><strong>WAN2: </strong><br>Rx<?php echo $log['avg_wan2_rx_bytes_rate'] ?> <br>Tx<?php echo $log['avg_wan2_tx_bytes_rate'] ?><br><strong>LTE1: </strong><br>Rx<?php echo $log['avg_lte1_rx_bytes_rate'] ?><br>Tx<?php echo $log['avg_lte1_tx_bytes_rate'] ?><br><strong>LTE2: </strong><br>Rx<?php echo $log['avg_lte2_rx_bytes_rate'] ?> <br>Tx<?php echo $log['avg_lte2_tx_bytes_rate'] ?><br> <strong>LTE3: </strong><br>Rx<?php echo $log['avg_lte3_rx_bytes_rate'] ?> <br>Tx<?php echo $log['avg_lte3_tx_bytes_rate'] ?><br> <strong>SD-WAN: </strong><br>Rx<?php echo $log['avg_sdwan_rx_bytes_rate'] ?><br>Tx<?php echo $log['avg_sdwan_tx_bytes_rate'] ?><br></td>


                                                <td><strong>WAN1: </strong><?php echo $log['sum_link_status_wan_up_count']; ?><br><br><br><strong>WAN2: </strong><?php echo $log['sum_link_status_wan2_up_count'] ?><br><br><br><strong>LTE1: </strong><?php echo $log['sum_link_status_lte1_up_count'] ?><br><br><br><strong>LTE2: </strong><?php echo $log['sum_link_status_lte2_up_count'] ?><br><br><br><strong>LTE3: </strong><?php echo $log['sum_link_status_lte3_up_count'] ?><br><br><br>
                                                    <strong>SD-WAN: </strong><?php echo $log['sum_link_status_sdwan_up_count'] ?><br><br><br>
                                                </td>

                                                <td><strong>WAN1: </strong><?php echo $log['avg_wan1_latency'] ?> ms<br><br><br><strong>WAN2: </strong><?php echo $log['avg_wan2_latency'] ?> ms<br><br><br><strong>LTE1: </strong><?php echo $log['avg_lte1_latency'] ?> ms<br><br><br><strong>LTE2: </strong><?php echo $log['avg_lte2_latency'] ?>ms<br><br><br><strong>LTE3: </strong><?php echo $log['avg_lte3_latency'] ?> ms<br><br><br><strong>SD-WAN: </strong><?php echo $log['avg_sdwan_latency'] ?> ms<br><br><br></td>

                                                <td><strong>WAN1: </strong><?php echo $log['avg_wan1_jitter'] ?> ms<br><br><br><strong>WAN2: </strong><?php echo $log['avg_wan2_jitter'] ?> ms<br><br><br><strong>LTE1: </strong><?php echo $log['avg_lte1_jitter'] ?> ms<br><br><br><strong>LTE2: </strong><?php echo $log['avg_lte2_jitter'] ?> ms<br><br><br><strong>LTE3: </strong><?php echo $log['avg_lte3_jitter'] ?> ms<br><br><br><strong>SD-WAN: </strong><?php echo $log['avg_sdwan_jitter'] ?> ms<br><br><br></td>

                                                <td><?php echo $log['timestamp']; ?></td>

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
        </div>
    </section>
    <!-- /.content -->
</div>


</html>
<script>
    $('#log_table').DataTable({
        "lengthMenu": [
            [20, 50],
            [20, 50]
        ]
    });
</script>
<script>
    $(document).ready(function() {
        $('.log').on('change', function() {

            var selectd_val = $(this).val();

            if (selectd_val == 'link_status') {
                $('.log_name').html('Link status');
            } else if (selectd_val == 'network_status') {
                $('.log_name').html('Network status');
            }
            if (selectd_val == 'user_access') {
                $('.log_name').html('User access');
            }
            if (selectd_val == 'consolidated_log') {
                $('.log_name').html('Consolidated log');
            }

            var id = '<?php echo $this->uri->segment('3') ?>';
            var sno = '<?php echo $this->uri->segment('4') ?>';

            $.ajax({
                'url': '<?php echo base_url() . 'Edge/get_logs_info'; ?>',
                'method': 'post',
                'data': {
                    'page': selectd_val,
                    'sno': sno,
                    'id': id
                },
                'success': function(data) {
                    console.log(data);
                    $('.log_table').html(data);
                    $('#link_status').DataTable({
                        "lengthMenu": [
                            [20, 50],
                            [20, 50]
                        ]
                    });
                    $('#network_status').DataTable({
                        "lengthMenu": [
                            [20, 50],
                            [20, 50]
                        ]
                    });
                    $('#user_access').DataTable({
                        "lengthMenu": [
                            [20, 50],
                            [20, 50]
                        ]
                    });
                    $('#consolidated_log').DataTable({
                        "lengthMenu": [
                            [20, 50],
                            [20, 50]
                        ]
                    });
                }
            })
        })
    })
</script>
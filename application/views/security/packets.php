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
                            <h5><b>Security - Firewall Dashboard</b></h5>
                        </div>
                    </div>
                    <!-- <div class="col-lg-1 txt-end">
                                 <div><a href="<?php // echo base_url('Security/add_rule') 
                                                ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                            </div> -->
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_failure'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('update_msgs')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('update_msgs'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-lg-12">
                        <?php

                        $log_timestamp = array();
                        $pkt_count = array();

                        foreach ($packets_drops_24_hrs as $drops) {
                            array_push($log_timestamp, $drops->log_timestamp);
                            array_push($pkt_count, $drops->pkt_count);
                        }

                        ?>

                        <h6><b>Packet Drops (Past 24 hours)</b></h6>
                        <div id="chart-container" style="position: relative; height:30vh; width:80vw">
                            <canvas id="LineChart" style="width:100%;max-width:1000px;height:200px"></canvas><br><br>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <?php

                        $user_packet_cnt = '';
                        $type_packet_cnt = '';

                        foreach ($content_firewall as $content) {
                            $user_packet_cnt = $content->user_packet_cnt;
                            $type_packet_cnt = $content->type_packet_cnt;
                        }

                        ?>
                        <div class="row head_space">
                            <div class="col-lg-12">
                                <h6><b>Packet Drops - User defined vs IPS (AI) (Past 24 hours)</b></h6>
                                <div style="position: relative; height:30vh; width:80vw">
                                    <canvas id="donutChart" style="width:100%;max-width:1000px;height:200px"></canvas><br><br>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row card head_space">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <div>
                                            <h6><b>Dropped Packets - IP Addr Tracking (past 24 hour):</b></h6>
                                        </div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Source IP-Address</th>
                                                    <th>Dropped Packets</th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($ip_track as $track) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $track->src_ip_cnt; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $track->src_ip; ?>
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
    // Get the canvas element
    var ctx = document.getElementById('LineChart').getContext('2d');
    var graphLabels = '<?php echo json_encode($log_timestamp); ?>';
    var graphData = '<?php echo json_encode($pkt_count); ?>';
    var color = "rgba(216,68,48,0.98)";
    var pointHoverBorderColor = "rgba(216,68,48,0.98)";
    var backgroundColor = "rgba(216,68,48,0.4)";
    var portMetric = 'Firewall Packet Drop Count';
    var data = {
        labels: JSON.parse(graphLabels),
        datasets: [{
            label: portMetric,
            fill: true,
            lineTension: 0.1,
            backgroundColor: backgroundColor,
            borderColor: color,
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: color,
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: color,
            pointHoverBorderColor: pointHoverBorderColor,
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            borderWidth: 2, //line thickness
            data: JSON.parse(graphData),
        }],
    };

    var options = {
        responsive: true,
        maintainAspectRatio: false,
    };

    // Create the line chart
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options,
    });




    // Get the canvas element
    var ctx = document.getElementById('donutChart').getContext('2d');

    // Sample data
    var data = {
        labels: ['User', 'IPS'],
        datasets: [{
            data: ['<?php echo $user_packet_cnt; ?>', '<?php echo $type_packet_cnt; ?>'],
            backgroundColor: ['rgba(41,129,228,0.9)', 'rgba(216,68,48,0.98)'],
        }]
    };

    var options = {
        responsive: true,
        maintainAspectRatio: false,
    };

    // Create the donut chart
    var myDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options,
    });



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
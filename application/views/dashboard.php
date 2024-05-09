<!DOCTYPE html>

<html lang="en">

<?php $path = APPPATH . 'views/header.php';
include "$path"; ?>

<?php $path = APPPATH . 'views/sidebar.php';
include "$path"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5><b>SMOAD Core - Home</b></h5>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="row">

      <!-- server specs starts here -->
      <div class="col-md-6">
        <!-- Widget: user widget style 2 -->
        <div class="card card-primary">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div align="center" class="card-header dashboard_header">
            <h5>Server Specs</h5>
          </div>
          <div class="card-footer p-0">
            <ul class="nav specs_nav flex-column">

              <?php
                  $G_server_name = '';
                  foreach ($server_details as $info) {
                      $G_server_name = $info->server_name;
                  }
                  // echo "<pre>";
                  // print_r($server_details);
                  // if (!empty($server_details[0]->server_name)) {
                  //     $G_server_name = $server_details[0]->server_name;
                  // } else {
                  //     $G_server_name = '';
                  // }

                  $uptime       = shell_exec("uptime -p");
                  $version      = "smoad_server_1.5.32";
                  $release_date = "12-Dec-2022";
                  if (strpos(strtolower(PHP_OS), 'linux') !== false) {
                      $current_mem_utilization = shell_exec("free -t | awk 'FNR == 2 {printf(\"%.2f %\"), $3/$2*100}'");
                      $current_cpu_utilization = shell_exec("top -b -n 1 | grep Cpu | awk '{print $8}'|cut -f 1 -d '.'");
                      $current_cpu_utilization = chop($current_cpu_utilization);
                      $current_cpu_utilization = 100 - $current_cpu_utilization;
                      $current_cpu_utilization .= " %";
                  } elseif (strpos(strtolower(PHP_OS), 'win') !== false) {
                      // Memory utilization
                      $current_mem_utilization = shell_exec('powershell.exe "(Get-WmiObject Win32_OperatingSystem | Select-Object TotalVisibleMemorySize, FreePhysicalMemory | ForEach-Object { $_.FreePhysicalMemory / $_.TotalVisibleMemorySize * 100 }).ToString(\"F2\")"');
                      $current_mem_utilization .= " %";

                      // CPU utilization
                      $current_cpu_utilization = shell_exec('powershell.exe "(Get-WmiObject Win32_PerfFormattedData_PerfOS_Processor | Where-Object { $_.Name -eq \"_Total\" } | Select-Object PercentProcessorTime).PercentProcessorTime"');
                      $current_cpu_utilization = trim($current_cpu_utilization);
                      $current_cpu_utilization = 100 - $current_cpu_utilization;
                      $current_cpu_utilization .= " %";

                  }
                  $kernel_version = shell_exec("uname -r");

              ?>

              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                      <?=$this->session->flashdata('error_msgs'); ?>
                    </div>
                  <?php } ?>

                  <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                      <?=$this->session->flashdata('success_msg'); ?>
                    </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-lg-6">Server name</div>
                    <div class="col-lg-6">
                      <?php echo form_open(base_url('Welcome/save_server_name'), array('id', 'myform')); ?>
                      <input type="text" value="<?php echo $G_server_name; ?>" name="server_name" onsubmit="submitform()" class="form-control" placeholder="Server name">
                      <?php echo form_error('server_name');
                          echo form_close();
                      ?>
                    </div>
                  </div>

                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">Version</div>
                    <div class="col-lg-6">
                      <?php echo $version ?>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">CPU usage</div>
                    <div class="col-lg-6">
                      <?php echo $current_cpu_utilization ?>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">Kernel version</div>
                    <div class="col-lg-6">
                      <?php echo $kernel_version ?>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">Server uptime</div>
                    <div class="col-lg-6">
                      <?php echo $uptime ?>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">Release</div>
                    <div class="col-lg-6">
                      <?php echo $release_date ?>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link remove-cursor">
                  <div class="row">
                    <div class="col-lg-6">Memory usage</div>
                    <div class="col-lg-6">
                      <?php echo $current_mem_utilization ?>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
      <!-- server specs ends here -->


      <!-- Network specs starts here -->
      <div class="col-md-6">

        <?php
            $login_type = $this->session->userdata('accesslevel');
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
            ?>
          <!-- Widget: user widget style 2 -->
          <div class="card card-primary">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div align="center" class="card-header dashboard_header">
              <h5>Network Stats</h5>
            </div>
            <div class="card-footer p-0">
              <ul class="nav specs_nav flex-column">

                <?php
                    // echo "<pre>"; print_r($server_details[0]->server_name);
                        foreach ($network_details as $network_detail) {
                            $wan1_rx         = $network_detail->wan1_rx;
                            $wan1_tx         = $network_detail->wan1_tx;
                            $wan2_rx         = $network_detail->wan2_rx;
                            $wan2_tx         = $network_detail->wan2_tx;
                            $lte1_rx         = $network_detail->lte1_rx;
                            $lte2_rx         = $network_detail->lte2_rx;
                            $lte2_tx         = $network_detail->lte2_tx;
                            $avg_wan_traffic = $wan1_rx + $wan1_tx + $wan2_rx + $wan2_tx + $lte1_rx + $lte2_rx + $lte2_tx;
                            $avg_wan_traffic = round($avg_wan_traffic / 8, 1);

                            $sdwan_rx          = $network_detail->sdwan_rx;
                            $sdwan_tx          = $network_detail->sdwan_tx;
                            $avg_sdwan_traffic = $sdwan_rx + $sdwan_tx;
                            $avg_sdwan_traffic = round($avg_sdwan_traffic / 2, 1);

                            $wan1_rx_drop    = $network_detail->wan1_rx_drop;
                            $wan1_tx_drop    = $network_detail->wan1_tx_drop;
                            $wan2_rx_drop    = $network_detail->wan2_rx_drop;
                            $wan2_tx_drop    = $network_detail->wan2_tx_drop;
                            $lte1_rx_drop    = $network_detail->lte1_rx_drop;
                            $lte1_tx_drop    = $network_detail->lte1_tx_drop;
                            $lte2_rx_drop    = $network_detail->lte2_rx_drop;
                            $lte2_tx_drop    = $network_detail->lte2_tx_drop;
                            $total_wan_drops = $wan1_rx_drop + $wan1_tx_drop + $wan2_rx_drop + $wan2_tx_drop + $lte1_rx_drop + $lte1_tx_drop + $lte2_rx_drop + $lte2_tx_drop;
                            $total_wan_drops = round($total_wan_drops, 0);

                            $sdwan_rx_drop     = $network_detail->sdwan_rx_drop;
                            $sdwan_tx_drop     = $network_detail->sdwan_tx_drop;
                            $total_sdwan_drops = $sdwan_rx_drop + $sdwan_tx_drop;
                            $total_sdwan_drops = round($total_sdwan_drops, 0);

                            $wan1            = $network_detail->wan1;
                            $wan2            = $network_detail->wan2;
                            $lte1            = $network_detail->lte1;
                            $lte2            = $network_detail->lte2;
                            $avg_wan_latency = $wan1 + $wan2 + $lte1 + $lte2;
                            $port_count      = 0;
                            if ($wan1 > 0) {
                                ++$port_count;
                            }
                            if ($wan2 > 0) {
                                ++$port_count;
                            }
                            if ($lte1 > 0) {
                                ++$port_count;
                            }
                            if ($lte2 > 0) {
                                ++$port_count;
                            }
                            if ($port_count == 0) {
                                $avg_wan_latency = 0;
                            } else {
                                $avg_wan_latency = round($avg_wan_latency / $port_count, 0);
                            }

                            $avg_sdwan_latency = $network_detail->sdwan_lt;
                            $avg_sdwan_latency = round($avg_sdwan_latency, 0);

                            $wan1_jitter    = $network_detail->wan1_jitter;
                            $wan2_jitter    = $network_detail->wan2_jitter;
                            $lte1_jitter    = $network_detail->lte1_jitter;
                            $lte2_jitter    = $network_detail->lte2_jitter;
                            $avg_wan_jitter = $wan1_jitter + $wan2_jitter + $lte1_jitter + $lte2_jitter;
                            $port_count     = 0;
                            if ($wan1_jitter > 0) {
                                ++$port_count;
                            }
                            if ($wan2_jitter > 0) {
                                ++$port_count;
                            }
                            if ($lte1_jitter > 0) {
                                ++$port_count;
                            }
                            if ($lte2_jitter > 0) {
                                ++$port_count;
                            }
                            if ($port_count == 0) {
                                $avg_wan_jitter = 0;
                            } else {
                                $avg_wan_jitter = round($avg_wan_jitter / $port_count, 0);
                            }
                        }

                    ?>

                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    EDGE <span class="float-right "></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg WAN Traffic</div>
                      <div class="col-lg-6">
                        <?php echo $avg_wan_traffic ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">WAN Pkt Drops</div>
                      <div class="col-lg-6">
                        <?php echo $total_wan_drops ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg WAN Latency</div>
                      <div class="col-lg-6">
                        <?php echo $avg_wan_latency . 'ms' ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg WAN Jitter</div>
                      <div class="col-lg-6">
                        <?php echo $avg_wan_jitter . 'ms' ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    SD-WAN <span class="float-right "></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg Traffic</div>
                      <div class="col-lg-6">
                        <?php echo $avg_sdwan_traffic . 'Kb/s' ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Pkt Drops</div>
                      <div class="col-lg-6">
                        <?php echo $total_sdwan_drops ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg SD-WAN Latency</div>
                      <div class="col-lg-6">
                        <?php echo $avg_sdwan_latency . 'ms' ?>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link remove-cursor">
                    <div class="row">
                      <div class="col-lg-6">Avg Jitter</div>
                      <div class="col-lg-6">
                        <?php echo $avg_wan_jitter . 'ms' ?>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>

        <?php
        } ?>
        <!-- /.widget-user -->
      </div>
      <!-- Network specs ends here -->

    </div>


    <div class="row">
      <div class="col-lg-6">
        <?php
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
            ?>
          <!-- area chart -->
          <div class="card card-primary">
            <div class="card-header card_title">
              <h3 class="card-title">SMOAD Gateways:
                <?php echo $sm_gw_count; ?>
              </h3>



            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $up_count   = '';
                            $down_count = '';
                            $up_name    = '';
                            $down_name  = '';

                            foreach ($donutChart1 as $donutChart) {

                                if ($donutChart->status == 'up') {
                                    $up_count = $donutChart->quantity;
                                    $up_name  = $donutChart->status;
                                }

                                if ($donutChart->status == 'down') {
                                    $down_count = $donutChart->quantity;
                                    $down_name  = $donutChart->status;
                                }
                            }

                        ?>
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $l2_count = '';
                            $l3_count = '';
                            $l2_name  = '';
                            $l3_name  = '';

                            foreach ($donutChart2 as $donutChart) {

                                if ($donutChart->type == 'l2') {
                                    $l2_count = $donutChart->quantity;
                                    $l2_name  = $donutChart->type;
                                }

                                if ($donutChart->type == 'l3') {
                                    $l3_count = $donutChart->quantity;
                                    $l3_name  = $donutChart->type;
                                }
                            }

                        ?>
                    <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $wg_count     = '';
                            $mptcp_count  = '';
                            $notset_count = '';
                            $wg_name      = '';
                            $mptcp_name   = '';
                            $notset_name  = '';

                            foreach ($donutChart3 as $donutChart) {

                                if ($donutChart->sdwan_proto == 'wg') {
                                    $wg_count = $donutChart->quantity;
                                    $wg_name  = 'SD-WAN';
                                }

                                if ($donutChart->sdwan_proto == 'mptcp') {
                                    $mptcp_count = $donutChart->quantity;
                                    $mptcp_name  = 'MPTCP';
                                }

                                if ($donutChart->sdwan_proto == 'notset') {
                                    $notset_count = $donutChart->quantity;
                                    $notset_name  = 'Not Set';
                                }
                            }

                        ?>
                    <canvas id="donutChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
        <?php
        } ?>
        <!-- /.end of area chart  -->
      </div>
      <div class="col-lg-6">
        <?php
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
            ?>
          <!-- area chart -->
          <div class="card card-primary">
            <div class="card-header card_title">
              <h3 class="card-title">SMOAD Edge Devices:
                <?php echo $edge_devices_count; ?>
              </h3>

            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $device_up_count   = '';
                            $device_down_count = '';
                            $device_up_name    = '';
                            $device_down_name  = '';

                            foreach ($donutChart4 as $donutChart) {

                                if ($donutChart->status == 'up') {
                                    $device_up_count = $donutChart->quantity;
                                    $device_up_name  = $donutChart->status;
                                }

                                if ($donutChart->status == 'down') {
                                    $device_down_count = $donutChart->quantity;
                                    $device_down_name  = $donutChart->status;
                                }
                            }

                        ?>
                    <canvas id="donutChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="chart">

                    <?php
                        $beetle_count      = '';
                            $beetle_name       = '';
                            $spider_count      = '';
                            $spider_name       = '';
                            $spider2_count     = '';
                            $spider2_name      = '';
                            $bumblebee_count   = '';
                            $bumblebee_name    = '';
                            $wasp1_count       = '';
                            $wasp1_name        = '';
                            $wasp2_count       = '';
                            $wasp2_name        = '';
                            $vm_count          = '';
                            $vm_name           = '';
                            $soft_client_count = '';
                            $soft_client_name  = '';

                            foreach ($donutChart5 as $donutChart) {

                                if ($donutChart->model == 'beetle') {
                                    $beetle_count = $donutChart->quantity;
                                    $beetle_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'spider') {
                                    $spider_count = $donutChart->quantity;
                                    $spider_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'spider2') {
                                    $spider2_count = $donutChart->quantity;
                                    $spider2_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'bumblebee') {
                                    $bumblebee_count = $donutChart->quantity;
                                    $bumblebee_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'wasp1') {
                                    $wasp1_count = $donutChart->quantity;
                                    $wasp1_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'wasp2') {
                                    $wasp2_count = $donutChart->quantity;
                                    $wasp2_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'vm') {
                                    $vm_count = $donutChart->quantity;
                                    $vm_name  = $donutChart->model;
                                }

                                if ($donutChart->model == 'soft_client') {
                                    $soft_client_count = $donutChart->quantity;
                                    $soft_client_name  = $donutChart->model;
                                }
                            }
                        ?>

                    <canvas id="donutChart5" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="chart">

                    <?php
                        $wan_up_count       = '';
                            $lte_up_count       = '';
                            $wan_lte_up_count   = '';
                            $wan_lte_down_count = '';

                            foreach ($donutChart6 as $donutChart) {
                                $wan_up_count       = $donutChart->wan_up;
                                $lte_up_count       = $donutChart->lte_up;
                                $wan_lte_up_count   = $donutChart->wan_lte_up;
                                $wan_lte_down_count = $donutChart->wan_lte_down;
                            }
                        ?>

                    <canvas id="donutChart6" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>

                </div>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
        <?php
        } ?>
        <!-- /.end of area chart  -->
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <?php
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
            ?>
          <!-- area chart -->
          <div class="card card-primary">
            <div class="card-header card_title">
              <h3 class="card-title">SMOAD Edge Devices GW Status
              </h3>


            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $wg_cnt     = '';
                            $mptcp_cnt  = '';
                            $notset_cnt = '';

                            foreach ($donutChart3 as $donutChart) {

                                if ($donutChart->sdwan_proto == 'wg') {
                                    $wg_cnt = $donutChart->quantity;
                                }

                                if ($donutChart->sdwan_proto == 'mptcp') {
                                    $mptcp_cnt = $donutChart->quantity;
                                }

                                if ($donutChart->sdwan_proto == 'notset') {
                                    $notset_cnt = $donutChart->quantity;
                                }
                            }

                        ?>
                    <canvas id="donutChart7" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="chart">

                    <?php

                            $assigned = '';
                            $not_set  = '';

                            foreach ($donutChart8 as $donutChart) {
                                //  echo "<pre>"; print_r($donutChart['equal_to_notset']);
                                $assigned = $donutChart['not_equal_to_notset'];
                                $not_set  = $donutChart['equal_to_notset'];
                            }

                        ?>

                    <canvas id="donutChart8" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="col-lg-4">

                </div>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
        <?php
        } ?>
        <!-- /.end of area chart  -->
      </div>
      <div class="col-lg-6">
        <?php
            if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') {
            ?>
          <div class="card card-primary">
            <div class="card-header card_title">
              <h3 class="card-title">Firmware Update Summary</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Updated</th>
                    <th>Pending</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($firmware_summary as $summary) { ?>
                    <tr>
                      <td>
                        <span class="badge badge_size bg-success">
                          <?php echo $summary['updated_cnt']; ?>
                        </span>

                      </td>
                      <td>
                        <span class="badge badge_size bg-danger">
                          <?php
                              echo $summary['pending_cnt'];
                                  ?>
                        </span>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
                <!-- <tfoot>
                    <tr>
                      <th>Updated</th>
                      <th>Pending</th>
                    </tr>
                  </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        <?php
        } ?>
      </div>
    </div>

    <div class="row">

    
      <div class="col-lg-6">
        <div class="card card-primary">
          <div class="card-header card_title">
            <h3 class="card-title">Link Reliability (past 24 hours)</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Details</th>
                  <th>Serial Number</th>
                  <th>Model</th>
                  <th>Area</th>
                  <th>Up Count</th>
                  <th>Down Count</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($link_counts as $link) { ?>
                  <tr>
                    <td>
                      <?php
                          echo $link['id'];
                          ?>
                    </td>
                    <td>
                      <?php
                          echo $link['details'];
                          ?>
                    </td>
                    <td>
                      <?php
                          echo $link['serialnumber'];
                          ?>
                    </td>
                    <td>
                      <?php
                          echo $link['model'];
                          ?>
                    </td>
                    <td>
                      <?php
                          echo $link['area'];
                          ?>
                    </td>
                    <td>
                      <span class="badge badge_size bg-success">
                        <?php
                            echo $link['up_count'];
                            ?>
                      </span>
                    </td>
                    <td>
                      <span class="badge badge_size bg-danger">
                        <?php
                            echo $link['down_count'];
                            ?>
                      </span>
                    </td>

                  </tr>
                <?php } ?>

              </tbody>
              <!-- <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Details</th>
                      <th>Serial Number</th>
                      <th>Model</th>
                      <th>Area</th>
                      <th>Up Count</th>
                      <th>Down Count</th>
                    </tr>
                  </tfoot> -->
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

     
      <div class="col-lg-6">


        <div class="card card-primary">
          <div class="card-header card_title">
            <h3 class="card-title">SD-WAN Link High usage (past 5 minutes)</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="sd_wan_link_usage" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Details</th>
                  <th>Serial Number</th>
                  <th>Model</th>
                  <th>Area</th>
                  <th>Rx rate</th>
                  <th>Tx rate</th>
                  <th>Threshold (Kb/s)</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($sd_wan_link_usage as $summary) { ?>
                  <tr>
                    <td>
                      <?php echo $summary['id']; ?>
                    </td>
                    <td>
                      <?php echo $summary['details']; ?>
                    </td>
                    <td>
                      <?php echo $summary['serialnumber']; ?>
                    </td>
                    <td>
                      <?php echo $summary['model']; ?>
                    </td>
                    <td>
                      <?php echo $summary['area']; ?>
                    </td>
                    <td>
                      <?php echo $summary['avg_sdwan_rx_bytes_rate']; ?>
                    </td>
                    <td>
                      <?php echo $summary['avg_sdwan_tx_bytes_rate']; ?>
                    </td>
                    <td>
                      <?php echo $summary['sdwan_link_high_usage_threshold']; ?>
                    </td>

                  </tr>
                <?php } ?>

              </tbody>
              <!-- <tfoot>
        <tr>
        <th>ID</th>
          <th>Details</th>
          <th>Serial Number</th>
          <th>Model</th>
          <th>Area</th>
          <th>Rx rate</th>
          <th>Tx rate</th>
          <th>Threshold (Kb/s)</th>
        </tr>
      </tfoot> -->
            </table>
          </div>
          <!-- /.card-body -->
        </div>

      </div>
   

    </div>

 

    <!-- <div class="container-fluid">

                <div>
                <canvas id="cool-canvas" width="600" height="300"></canvas>
                </div>
                <div style="height: 0; width: 0; overflow: hidden">
                <canvas id="supercool-canvas" width="1200" height="600"></canvas>
                </div>

                <button type="button" id="download-pdf2">
                Download PDF
                </button>


                </div> -->

  </section>


</div>


<script>
  $(document).ready(function() {

    var up_name = '<?php echo $up_name; ?>';
    var up_count = '<?php echo $up_count; ?>';
    var down_name = '<?php echo $down_name; ?>';
    var down_count = '<?php echo $down_count; ?>';
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
      labels: [up_name ? up_name : 'Up', down_name ? down_name : 'Down'],
      datasets: [{
        data: [up_count, down_count],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(200, 200, 200, 0.9)'],
      }]
    }
    var donutOptions = {
      maintainAspectRatio: true,
      legend: {
        position: 'right' // Position legend (labels) to the right
      }

    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    var l2_name = '<?php echo $l2_name; ?>';
    var l2_count = '<?php echo $l2_count; ?>';
    var l3_name = '<?php echo $l3_name; ?>';
    var l3_count = '<?php echo $l3_count; ?>';


    var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
    var donutData = {
      labels: ['L2 Servers', 'L3 Servers'],
      datasets: [{
        data: [l2_count, l3_count],
        backgroundColor: ['rgba(41,129,228,0.9)', 'rgba(255, 195, 0, 0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });

    var wg_name = '<?php echo $wg_name; ?>';
    var wg_count = '<?php echo $wg_count; ?>';
    var mptcp_name = '<?php echo $mptcp_name; ?>';
    var mptcp_count = '<?php echo $mptcp_count; ?>';
    var notset_name = '<?php echo $notset_name; ?>';
    var notset_count = '<?php echo $notset_count; ?>';

    var donutChartCanvas = $('#donutChart3').get(0).getContext('2d')
    var donutData = {
      labels: ['SD-WAN', 'MPTCP', 'Not Set'],
      datasets: [{
        data: [wg_count, mptcp_count, notset_count],
        backgroundColor: ['rgba(41,129,228,0.9)', 'rgba(216,68,48,0.98)', 'rgba(200, 200, 200, 0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });

    var device_up_name = '<?php echo $device_up_name; ?>';
    var device_up_count = '<?php echo $device_up_count; ?>';
    var device_down_name = '<?php echo $device_down_name; ?>';
    var device_down_count = '<?php echo $device_down_count; ?>';


    var donutChartCanvas = $('#donutChart4').get(0).getContext('2d')
    var donutData = {
      labels: ['Up', 'Down'],
      datasets: [{
        data: [device_up_count, device_down_count],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(200, 200, 200, 0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    var beetle_count = '<?php echo $beetle_count; ?>';
    var beetle_name = '<?php echo $beetle_name; ?>';
    var spider_count = '<?php echo $spider_count; ?>';
    var spider_name = '<?php echo $spider_name; ?>';
    var spider2_count = '<?php echo $spider2_count; ?>';
    var spider2_name = '<?php echo $spider2_name; ?>';
    var bumblebee_count = '<?php echo $bumblebee_count; ?>';
    var bumblebee_name = '<?php echo $bumblebee_name; ?>';
    var wasp1_count = '<?php echo $wasp1_count; ?>';
    var wasp1_name = '<?php echo $wasp1_name; ?>';
    var wasp2_count = '<?php echo $wasp2_count; ?>';
    var wasp2_name = '<?php echo $wasp2_name; ?>';
    var vm_count = '<?php echo $vm_count; ?>';
    var vm_name = '<?php echo $vm_name; ?>';
    var soft_client_count = '<?php echo $soft_client_count; ?>';
    var soft_client_name = '<?php echo $soft_client_name; ?>';


    var donutChartCanvas = $('#donutChart5').get(0).getContext('2d')
    var donutData = {
      labels: ['beetle', 'spider', 'spider2', 'bumblebee', 'wasp1', 'wasp2', 'vm', 'soft_client'],
      datasets: [{
        data: [beetle_count, spider_count, spider2_count, bumblebee_count, wasp1_count, wasp2_count, vm_count, soft_client_count],
        backgroundColor: ['rgba(216,68,48,0.98)', 'rgba(41,129,228,0.9)', 'rgba(154, 197, 244, 1)', 'rgba(255, 195, 0, 0.9)', 'rgba(33, 145, 80,0.9)', 'rgba(211, 208, 79, 1)', 'rgba(200, 200, 200, 0.9)', 'rgba(250, 78, 171,0.98)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: { maintainAspectRatio: true,
      legend: {
          position: 'right',
          onClick: function(event, legendItem) {
                      // Perform actions when a legend item is clicked
                      console.log("Legend clicked: ", legendItem);
                       var apiUrl = '<?php echo base_url('Welcome/linked_Devices/'); ?>';
                        var legend_Item = '';

                       apiUrl += legendItem.text;
         apiUrl += '/';
                       apiUrl += 'device_per_model';
                    console.log("Legend clicked: ", legend_Item);
                    //   // Navigate to the URL
                      window.location.href = apiUrl;

                  }
        }}
    });


    var wan_up_count = '<?php echo $wan_up_count; ?>';
    var lte_up_count = '<?php echo $lte_up_count; ?>';
    var wan_lte_up_count = '<?php echo $wan_lte_up_count; ?>';
    var wan_lte_down_count = '<?php echo $wan_lte_down_count; ?>';


    var donutChartCanvas = $('#donutChart6').get(0).getContext('2d');
    var donutData = {
      labels: ['wan up', 'lte up', 'wan lte up', 'wan lte down'],
      datasets: [{
        data: [wan_up_count, lte_up_count, wan_lte_up_count, wan_lte_down_count],
        backgroundColor: ['rgba(0,116,235,0.9)', 'rgba(246,211,84,0.9)', 'rgba(29,118,50,0.9)', 'rgba(255,12,62,0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: { maintainAspectRatio: true,
      legend: {
          position: 'right',
          onClick: function(event, legendItem) {
                      // Perform actions when a legend item is clicked
                      console.log("Legend clicked: ", legendItem);
                       var apiUrl = '<?php echo base_url('Welcome/linked_Devices/'); ?>';
                        var legend_Item = '';
                      // // Add legendItem as a query parameter to the URL
                      if(legendItem.text == 'wan up'){
                        legend_Item = 'wan_up';
                      } else if(legendItem.text == 'lte up'){
                        legend_Item = 'lte_up';
                      } else if(legendItem.text == 'wan lte up'){
                        legend_Item = 'wan_lte_up';
                      } else if(legendItem.text == 'wan lte down'){
                        legend_Item = 'wan_lte_down';
                      }
                       apiUrl += legend_Item;
                       apiUrl += '/';
                       apiUrl += 'device_per_port';
                    console.log("Legend clicked: ", legend_Item);
                    //   // Navigate to the URL
                      window.location.href = apiUrl;

                  }
        }}
      });


    var wg_cnt = '<?php echo $wg_cnt; ?>';
    var mptcp_cnt = '<?php echo $mptcp_cnt; ?>';
    var notset_cnt = '<?php echo $notset_cnt; ?>';


    var donutChartCanvas = $('#donutChart7').get(0).getContext('2d')
    var donutData = {
      labels: ['SD-WAN', 'MPTCP', 'Not Set'],
      datasets: [{
        data: [wg_cnt, mptcp_cnt, notset_cnt],
        backgroundColor: ['rgba(41,129,228,0.9)', 'rgba(216,68,48,0.98)', 'rgba(200, 200, 200, 0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });


    var assigned = '<?php echo $assigned; ?>';
    var not_set = '<?php echo $not_set; ?>';

    var donutChartCanvas = $('#donutChart8').get(0).getContext('2d')
    var donutData = {
      labels: ['GW Assigned', 'Not Set'],
      datasets: [{
        data: [assigned, not_set],
        backgroundColor: ['rgba(41,129,228,0.9)', 'rgba(200, 200, 200, 0.9)'],
      }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    });





  });
</script>

<script>
  $(function() {

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });
    $('#sd_wan_latency').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });
    $('#sd_wan_jitter').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });
    $('#sd_wan_link_usage').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });

  });
</script>

<script>
  function submitform() {
    alert('words');
    $('#myform').submit();
  }
</script>


</body>

</html>
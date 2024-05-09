<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smoad| Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <?php $CI =& get_instance(); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href=" https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $CI->config->base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <link rel="stylesheet" href="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $CI->config->base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo $CI->config->base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
    <!-- Daterange picker -->
    <style>
        canvas {
            height: 300px;
            /* Set the desired height in pixels */
        }

        td {
            font-size: 14px;
            padding: 0.8rem !important;
            width: 150px;
        }
    </style>

</head>



    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php echo $CI->config->base_url(); ?>assets/dist/img/smoad_logo.jpg"
        alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->

      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php echo $CI->config->base_url(); ?>assets/#"
            role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul> -->
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- user login -->
        <li class="nav-item">
          <a class="nav-link loggedin_user" href="#" role="button">
            <i class="fas fa-user"></i><i class="logged_in_user"> <span>
                <?php echo $this->session->userdata('accesslevel'); ?>
              </span>
            </i>
          </a>


        </li>

        <?php $cnt = 0;foreach ($alerts_cnt as $info) {$cnt = $info->total_cnt;} ?>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"><?=$cnt; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification_bar " style="max-width: unset !important;">
            <span class="dropdown-item dropdown-header">  <?=$cnt . 'Notifications'; ?></span>
            <div class="dropdown-divider"></div>
          <?php $count = 0;foreach ($alerts_info as $info) {++$count;if ($count == 6) {break;} ?>
            <a  class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <?=$info->title; ?>
              <span class="float-right text-muted text-sm"> <?=$info->log_timestamp; ?> </span>
            </a>
            <div class="dropdown-divider" style="margin-top: 5%;"></div>
            <?php } ?>
            <!-- <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a> -->
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('Notifications/index'); ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $CI->config->base_url(); ?>" role="button">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>

    </nav>

<?php $path = APPPATH . 'views/sidebar.php';
include "$path"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="edge_device">
                <div>
                    <h5><b>Edge ZTP - Dashboard -
                            <?php echo $sno; ?> -
                            <?php foreach ($device_info as $info) {
                            		echo $info->details;
                            		$model         = $info->model;
                            		$model_variant = $info->model_variant;
                            } ?>
                        </b></h5>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='alert_msg alert_msg-danger error_msg' role="alert"> <?=$this->session->flashdata('error_msgs'); ?> </div>
                <?php } ?>
                <div class="row">
                    <div class="col-lg-7">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Port Status</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <?php

                                    	$lan_cable_status   = '';
                                    	$lan2_cable_status  = '';
                                    	$lan3_cable_status  = '';
                                    	$wan_cable_status   = '';
                                    	$wan2_cable_status  = '';
                                    	$wan3_cable_status  = '';
                                    	$sdwan_cable_status = '';
                                    	$wan_link_status    = '';
                                    	$wan2_link_status   = '';
                                    	$wan3_link_status   = '';
                                    	$sdwan_link_status  = '';
                                    	$lte1_link_status   = '';
                                    	$lte2_link_status   = '';
                                    	$lte3_link_status   = '';

                                    	$wan_latency   = '';
                                    	$wan2_latency  = '';
                                    	$wan3_latency  = '';
                                    	$sdwan_latency = '';
                                    	$lte1_latency  = '';
                                    	$lte2_latency  = '';
                                    	$lte3_latency  = '';

                                    	$wan_jitter   = '';
                                    	$wan2_jitter  = '';
                                    	$wan3_jitter  = '';
                                    	$sdwan_jitter = '';
                                    	$lte1_jitter  = '';
                                    	$lte2_jitter  = '';
                                    	$lte3_jitter  = '';

                                    	foreach ($network_cfg as $cfg) {
                                    		$up_icon            = $CI->config->base_url() . 'assets/images/network-cable2.png';
                                    		$up_image           = "<img src=\"$up_icon\" style=\"width:20px;height:20px;\" />";
                                    		$down_icon          = $CI->config->base_url() . 'assets/images/ethernet.png';
                                    		$down_image         = "<img src=\"$down_icon\" style=\"width:20px;height:20px;\" />";
                                    		$lan_cable_status   = $cfg->lan_cable_status == 'up' ? $up_image : $down_image;
                                    		$lan2_cable_status  = $cfg->lan2_cable_status == 'up' ? $up_image : $down_image;
                                    		$lan3_cable_status  = $cfg->lan2_cable_status == 'up' ? $up_image : $down_image;
                                    		$wan_cable_status   = $cfg->wan_cable_status == 'up' ? $up_image : $down_image;
                                    		$wan2_cable_status  = $cfg->wan2_cable_status == 'up' ? $up_image : $down_image;
                                    		$wan3_cable_status  = $cfg->wan3_cable_status == 'up' ? $up_image : $down_image;
                                    		$sdwan_cable_status = $cfg->sdwan_cable_status == 'up' ? $up_image : $down_image;

                                    		$wan_link_status   = $cfg->wan_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$wan2_link_status  = $cfg->wan2_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$wan3_link_status  = $cfg->wan3_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$sdwan_link_status = $cfg->sdwan_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$lte1_link_status  = $cfg->lte1_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$lte2_link_status  = $cfg->lte2_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';
                                    		$lte3_link_status  = $cfg->lte3_link_status == 'up' ? '<span class="led_green"></span>' : '<span class="led_red"></span>';

                                    		$wan_latency   = $cfg->wan_latency . 'ms';
                                    		$wan2_latency  = $cfg->wan2_latency . 'ms';
                                    		$wan3_latency  = $cfg->wan3_latency . 'ms';
                                    		$sdwan_latency = $cfg->sdwan_latency . 'ms';
                                    		$lte1_latency  = $cfg->lte1_latency . 'ms';
                                    		$lte2_latency  = $cfg->lte2_latency . 'ms';
                                    		$lte3_latency  = $cfg->lte3_latency . 'ms';

                                    		$wan_jitter   = $cfg->wan_jitter . 'ms';
                                    		$wan2_jitter  = $cfg->wan2_jitter . 'ms';
                                    		$wan3_jitter  = $cfg->wan3_jitter . 'ms';
                                    		$sdwan_jitter = $cfg->sdwan_jitter . 'ms';
                                    		$lte1_jitter  = $cfg->lte1_jitter . 'ms';
                                    		$lte2_jitter  = $cfg->lte2_jitter . 'ms';
                                    		$lte3_jitter  = $cfg->lte3_jitter . 'ms';
                                    	}

                                    	$link_status_wan_up_count   = '';
                                    	$link_status_wan2_up_count  = '';
                                    	$link_status_wan3_up_count  = '';
                                    	$link_status_sdwan_up_count = '';
                                    	$link_status_lte1_up_count  = '';
                                    	$link_status_lte2_up_count  = '';
                                    	$link_status_lte3_up_count  = '';

                                    	foreach ($last_24_port_up_count as $up_count) {
                                    		$link_status_wan_up_count   = $up_count->link_status_wan_up_count;
                                    		$link_status_wan2_up_count  = $up_count->link_status_wan2_up_count;
                                    		$link_status_wan3_up_count  = $up_count->link_status_wan3_up_count;
                                    		$link_status_sdwan_up_count = $up_count->link_status_sdwan_up_count;
                                    		$link_status_lte1_up_count  = $up_count->link_status_lte1_up_count;
                                    		$link_status_lte2_up_count  = $up_count->link_status_lte2_up_count;
                                    		$link_status_lte3_up_count  = $up_count->link_status_lte3_up_count;
                                    	}

                                    	$link_status_wan_down_count   = '';
                                    	$link_status_wan2_down_count  = '';
                                    	$link_status_wan3_down_count  = '';
                                    	$link_status_lte1_down_count  = '';
                                    	$link_status_lte2_down_count  = '';
                                    	$link_status_lte3_down_count  = '';
                                    	$link_status_sdwan_down_count = '';

                                    	foreach ($get_last_24_port_down_count as $down_count) {
                                    		$link_status_wan_down_count   = $down_count->link_status_wan_down_count;
                                    		$link_status_wan2_down_count  = $down_count->link_status_wan2_down_count;
                                    		$link_status_wan3_down_count  = $down_count->link_status_wan3_down_count;
                                    		$link_status_lte1_down_count  = $down_count->link_status_lte1_down_count;
                                    		$link_status_lte2_down_count  = $down_count->link_status_lte2_down_count;
                                    		$link_status_lte3_down_count  = $down_count->link_status_lte2_down_count;
                                    		$link_status_sdwan_down_count = $down_count->link_status_sdwan_down_count;
                                    	}

                                    	$link_status_wan_up_count_timestamp     = '';
                                    	$link_status_wan2_up_count_timestamp    = '';
                                    	$link_status_wan3_up_count_timestamp    = '';
                                    	$link_status_sdwan_up_count_timestamp   = '';
                                    	$link_status_lte1_up_count_timestamp    = '';
                                    	$link_status_lte2_up_count_timestamp    = '';
                                    	$link_status_lte3_up_count_timestamp    = '';
                                    	$link_status_wan_down_count_timestamp   = '';
                                    	$link_status_wan2_down_count_timestamp  = '';
                                    	$link_status_wan3_down_count_timestamp  = '';
                                    	$link_status_sdwan_down_count_timestamp = '';
                                    	$link_status_lte1_down_count_timestamp  = '';
                                    	$link_status_lte2_down_count_timestamp  = '';
                                    	$link_status_lte3_down_count_timestamp  = '';

                                    	foreach ($link_status_wan_up_count_timestamp_data as $data) {
                                    		$link_status_wan_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}
                                    	foreach ($link_status_wan2_up_count_timestamp_data as $data) {
                                    		$link_status_wan2_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}
                                    	foreach ($link_status_wan3_up_count_timestamp_data as $data) {
                                    		$link_status_wan3_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}

                                    	foreach ($link_status_sdwan_up_count_timestamp_data as $data) {
                                    		$link_status_sdwan_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}
                                    	foreach ($link_status_lte1_up_count_timestamp_data as $data) {
                                    		$link_status_lte1_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}
                                    	foreach ($link_status_lte2_up_count_timestamp_data as $data) {
                                    		$link_status_lte2_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}
                                    	foreach ($link_status_lte3_up_count_timestamp_data as $data) {
                                    		$link_status_lte3_up_count_timestamp = $data->port_up_count_timestamp;
                                    	}

                                    	foreach ($link_status_wan_down_count_timestamp_data as $data) {
                                    		$link_status_wan_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}
                                    	foreach ($link_status_wan2_down_count_timestamp_data as $data) {
                                    		$link_status_wan2_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}
                                    	foreach ($link_status_wan3_down_count_timestamp_data as $data) {
                                    		$link_status_wan3_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}

                                    	foreach ($link_status_sdwan_down_count_timestamp_data as $data) {
                                    		$link_status_sdwan_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}
                                    	foreach ($link_status_lte1_down_count_timestamp_data as $data) {
                                    		$link_status_lte1_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}
                                    	foreach ($link_status_lte2_down_count_timestamp_data as $data) {
                                    		$link_status_lte2_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}

                                    	foreach ($link_status_lte3_down_count_timestamp_data as $data) {
                                    		$link_status_lte3_down_count_timestamp = $data->port_down_count_timestamp;
                                    	}

                                    ?>

                                    <tbody>
                                        <?php if ($model == 'vm' && $model_variant == "l3") { //content_ztp_dev_port_status_vm_l3 ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a href="<?php echo $CI->config->base_url(); ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/sdwan.png" alt="image" style="width:20px;"> </a> </td>
                                                <td><a href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>

                                                </td>
                                                <td><a href="<?php echo $CI->config->base_url(); ?>">
                                                        <?php echo $lan_cable_status; ?>

                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>WAN2</td>
                                                <td>SD-WAN</td>
                                                <td>WAN</td>
                                                <td>LAN</td>
                                            </tr>
                                            <tr>
                                                <td>Link Status</td>
                                                <td>
                                                    <div>
                                                        <?php echo $sdwan_link_status; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan2_link_status; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan_link_status; ?>
                                                    </div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Latency</td>
                                                <td>
                                                    <div>
                                                        <?php echo $sdwan_latency ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan2_latency ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan_latency ?>
                                                    </div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Jitter</td>
                                                <td>
                                                    <div>
                                                        <?php echo $sdwan_jitter ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan2_jitter ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <?php echo $wan_jitter ?>
                                                    </div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Link Up Count (past 24 hours)</td>


                                                <td>
                                                    <?php echo $link_status_wan_up_count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_wan2_up_count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_sdwan_up_count; ?>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan','sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                        <?php
                                        } elseif ($model == 'vm' && $model_variant == "l2") { //content_ztp_dev_port_status_vm_l2 ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>

                                                </td>
                                                <td><a href="<?php echo $CI->config->base_url(); ?>"><?php echo $lan_cable_status ?></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>WAN2</td>
                                                <td>SD-WAN</td>
                                                <td>WAN</td>
                                                <td>LAN</td>
                                            </tr>
                                            <tr>
                                                <td>Link Status</td>
                                                <td>
                                                    <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $wan2_link_status; ?></div>
                                                </td>
                                                <td>
                                                    <div><?php echo $sdwan_link_status; ?></div>
                                                </td>
                                                <td>
                                                    <div><?php echo $wan_link_status; ?></div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Latency</td>
                                                <td>
                                                    <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $wan2_latency ?> </div>
                                                </td>
                                                <td>
                                                    <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $sdwan_latency ?></div>
                                                </td>
                                                <td>
                                                    <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $wan_latency ?> </div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Jitter</td>
                                                <td>
                                                    <div><?php echo $wan2_jitter ?> </div>
                                                </td>
                                                <td>
                                                    <div><?php echo $sdwan_jitter ?></div>
                                                </td>
                                                <td>
                                                    <div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo $wan_jitter ?></div>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Link Up Count (past 24 hours)</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $link_status_wan2_up_count; ?></td>
                                                <td>
                                                    <?php echo $link_status_sdwan_up_count; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_wan_up_count; ?>
                                                </td>

                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Last Link Up Timestamp</td>
                                                <td>
                                                    <?php echo $link_status_wan2_up_count_timestamp; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_sdwan_up_count_timestamp; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_wan_up_count_timestamp; ?>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Last Link Down Timestamp</td>
                                                <td>
                                                    <?php echo $link_status_wan2_down_count_timestamp; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_sdwan_down_count_timestamp; ?>
                                                </td>
                                                <td>
                                                    <?php echo $link_status_wan_down_count_timestamp; ?>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" newChart onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div><a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/piechart.png" alt="image" style="width:20px;" onclick="edge_qos_stats('<?php echo $sno; ?>');"></a>
                                                    </div>
                                                    <div> <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="edge_qos_stats_live('<?php echo $sno; ?>')">
                                                        </a></div>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php
                                        } elseif ($model == 'spider' && $model_variant == "l2") { ?>

                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/sdwan/status') ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>WAN</td>
                                                <td>SD-WAN</td>
                                                <td>WAN2</td>
                                                <td>LAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td><?php echo $wan2_link_status ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_link_status ?></td>
                                                <td><?php echo $lte2_link_status ?></td>
                                            </tr>
                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                            </tr>
                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_up_count; ?></td>
                                                <td><?php echo $link_status_sdwan_up_count ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_wan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } elseif ($model == 'spider' && $model_variant == "l2w1l2") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/sdwan/status') ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>

                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>WAN</td>
                                                <td>SD-WAN</td>
                                                <td>LAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                            </tr>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_link_status ?></td>
                                                <td><?php echo $lte2_link_status ?></td>
                                            </tr>
                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                            </tr>
                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_up_count; ?></td>
                                                <td><?php echo $link_status_sdwan_up_count ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_wan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>

                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } elseif ($model == 'spider' && $model_variant == "l3") { ?>

                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/sdwan.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>

                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>WAN</td>
                                                <td>WAN2</td>
                                                <td>LAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td><?php echo $wan2_link_status ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_link_status ?></td>
                                                <td><?php echo $lte2_link_status ?></td>
                                            </tr>
                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                            </tr>
                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                            </tr>
                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                            </tr>
                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } elseif ($model == 'spider2' && $model_variant == "l2") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url(); ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>

                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE3 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>WAN</td>
                                                <td>SD-WAN</td>
                                                <td>WAN2</td>
                                                <td>LAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                                <td>LTE3</td>
                                            </tr>

                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_link_status ?></td>
                                                <td><?php echo $lte2_link_status ?></td>
                                                <td><?php echo $lte3_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                                <td><?php echo $lte3_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                                <td><?php echo $lte3_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_up_count; ?></td>
                                                <td><?php echo $link_status_sdwan_up_count ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                                <td><?php echo $link_status_lte3_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_wan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte3_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                                <td><?php echo $link_status_lte3_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte3_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>

                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte3', 'lte3','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } elseif ($model == 'spider2' && $model_variant == "l3") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url(); ?>"><img src="<?php echo $CI->config->base_url() ?>assets/images/sdwan.png" style="width:20px;"></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>

                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN3 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan3/status') ?>"><?php echo $wan3_cable_status; ?></a>
                                                </td>

                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE3 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>WAN</td>
                                                <td>WAN2</td>
                                                <td>WAN3</td>
                                                <td>LAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                                <td>LTE3</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan3_link_status ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_link_status ?></td>
                                                <td><?php echo $lte2_link_status ?></td>
                                                <td><?php echo $lte3_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan3_latency ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                                <td><?php echo $lte3_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan3_jitter ?></td>
                                                <td>-</td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                                <td><?php echo $lte3_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan3_up_count ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                                <td><?php echo $link_status_lte3_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan3_up_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte3_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td><?php echo $link_status_wan3_down_count; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                                <td><?php echo $link_status_lte3_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan3_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte3_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan3', 'wan3','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>

                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte3', 'lte3','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } elseif ($model == 'beetle' && $model_variant == "l2") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url() ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan2_cable_status ?></a> </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>LAN</td>
                                                <td>LAN2</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                            </tr>

                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } elseif ($model == 'beetle' && $model_variant == "l3") { ?>

                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url(); ?>"><img src="<?php echo $CI->config->base_url() ?>assets/images/sdwan.png" style="width:20px;"></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan2_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan3_cable_status; ?> </a> </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>LAN</td>
                                                <td>LAN</td>
                                                <td>LAN</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                            </tr>

                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                            </tr>


                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>

                                            </tr>

                                        <?php } elseif ($model == 'bumblebee' && $model_variant == "l2") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url() ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan2_cable_status ?> </a> </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>LAN</td>
                                                <td>LAN</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } elseif ($model == 'bumblebee' && $model_variant == "l3") { ?>
                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url(); ?>"><img src="<?php echo $CI->config->base_url() ?>assets/images/sdwan.png" style="width:20px;"></a>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan2_cable_status ?> </a> </td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan3_cable_status; ?> </a> </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>SD-WAN</td>
                                                <td>LAN</td>
                                                <td>LAN</td>
                                                <td>LAN</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php } elseif ($model == 'wasp1' && $model_variant == "l2") { ?>

                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url() ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>LAN</td>
                                                <td>SD-WAN</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                            </tr>
                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td>-</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td>-</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>-</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } elseif ($model == 'wasp2' && $model_variant == "l2") { ?>

                                            <tr>
                                                <td>H/w Status</td>
                                                <td><a href="<?php echo base_url(); ?>"><?php echo $lan_cable_status ?> </a> </td>
                                                <td><a title="Configure SDWAN ?" href="<?php echo base_url() ?>"><?php echo $sdwan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN2 port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan2/status') ?>"><?php echo $wan2_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure WAN port ?" href="<?php echo base_url('Edge/port_status/' . $id . '/' . $sno . '/wan/status') ?>"><?php echo $wan_cable_status; ?></a>
                                                </td>
                                                <td><a title="Configure LTE1 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                                <td><a title="Configure LTE2 port ?" href="<?php echo base_url() ?>"><img src="<?php echo $CI->config->base_url(); ?>assets/images/lte.png" alt="image" style="width:20px;" /></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>LAN</td>
                                                <td>SD-WAN</td>
                                                <td>WAN2</td>
                                                <td>WAN</td>
                                                <td>LTE1</td>
                                                <td>LTE2</td>
                                            </tr>

                                            <tr title="Link Status is the real end-to-end network connectivity status. Hence it is not real-time !">
                                                <td align=left>Link Status</td>
                                                <td>-</td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $sdwan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan2_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $wan_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte1_link_status ?></td>
                                                <td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $lte2_link_status ?></td>
                                            </tr>

                                            <tr title="Latency is the real end-to-end network latency status polled periodically. Hence it is not real-time !">
                                                <td align=left>Latency</td>
                                                <td>-</td>
                                                <td><?php echo $sdwan_latency ?></td>
                                                <td><?php echo $wan2_latency ?></td>
                                                <td><?php echo $wan_latency ?></td>
                                                <td><?php echo $lte1_latency ?></td>
                                                <td><?php echo $lte2_latency ?></td>
                                            </tr>

                                            <tr title="Jitter is the real end-to-end network jitter status (derived from latency) polled periodically. Hence it is not real-time !">
                                                <td align=left>Jitter</td>
                                                <td>-</td>
                                                <td><?php echo $sdwan_jitter ?></td>
                                                <td><?php echo $wan2_jitter ?></td>
                                                <td><?php echo $wan_jitter ?></td>
                                                <td><?php echo $lte1_jitter ?></td>
                                                <td><?php echo $lte2_jitter ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Up Count (past 24 hours)</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_up_count; ?></td>
                                                <td><?php echo $link_status_wan2_up_count ?></td>
                                                <td><?php echo $link_status_wan_up_count ?></td>
                                                <td><?php echo $link_status_lte1_up_count ?></td>
                                                <td><?php echo $link_status_lte2_up_count ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Up Timestamp</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_up_count_timestamp ?></td>
                                                <td><?php echo $link_status_wan2_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_up_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_up_count_timestamp; ?></td>
                                            </tr>

                                            <tr title="Derived from port status last 24 hours. Hence it is not real-time !">
                                                <td align=left>Link Down Count (past 24 hours)</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_down_count; ?></td>
                                                <td><?php echo $link_status_wan2_down_count; ?></td>
                                                <td><?php echo $link_status_wan_down_count; ?></td>
                                                <td><?php echo $link_status_lte1_down_count; ?></td>
                                                <td><?php echo $link_status_lte2_down_count; ?></td>
                                            </tr>

                                            <tr>
                                                <td align=left>Last Link Down Timestamp</td>
                                                <td>-</td>
                                                <td><?php echo $link_status_sdwan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan2_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_wan_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte1_down_count_timestamp; ?></td>
                                                <td><?php echo $link_status_lte2_down_count_timestamp; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Stats</td>
                                                <td>-</td>
                                                <td>
                                                    <a style="cursor: pointer;"><img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('sdwan', 'sdwan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan2', 'wan2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('wan1', 'wan','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte1', 'lte1','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                                <td><a style="cursor: pointer;">
                                                        <img src="<?php echo $CI->config->base_url(); ?>assets/images/combo-chart2.png" alt="image" style="width:20px;" onclick="byte_area_chart('lte2', 'lte2','<?php echo $sno; ?>')">
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } else {
                                        		echo 'No matched models were found.';
                                        } ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div>
                            <h6><b>Internet usage breakup (past 24 hours)</b></h6>
                        </div>
                        <?php foreach ($device_dash_pie_chart_data as $data) {
                        		$avg_wan1_bytes_rate     = $data->avg_wan1_rx_bytes_rate + $data->avg_wan1_tx_bytes_rate;
                        		$avg_wan2_bytes_rate     = $data->avg_wan2_rx_bytes_rate + $data->avg_wan2_tx_bytes_rate;
                        		$avg_wan3_bytes_rate     = $data->avg_wan3_rx_bytes_rate + $data->avg_wan3_tx_bytes_rate;
                        		$avg_lte1_bytes_rate     = $data->avg_lte1_rx_bytes_rate + $data->avg_lte1_tx_bytes_rate;
                        		$avg_lte2_bytes_rate     = $data->avg_lte2_rx_bytes_rate + $data->avg_lte2_tx_bytes_rate;
                        		$avg_lte3_bytes_rate     = $data->avg_lte3_rx_bytes_rate + $data->avg_lte3_tx_bytes_rate;
                        		$total                   = $avg_wan1_bytes_rate + $avg_wan2_bytes_rate + $avg_wan3_bytes_rate + $avg_lte1_bytes_rate + $avg_lte2_bytes_rate + $avg_lte3_bytes_rate;
                        		$avg_wan1_bytes_rate_pct = $avg_wan1_bytes_rate ? number_format($avg_wan1_bytes_rate / $total * 100, 1) : 0;
                        		$avg_wan2_bytes_rate_pct = $avg_wan2_bytes_rate ? number_format($avg_wan2_bytes_rate / $total * 100, 1) : 0;
                        		$avg_wan3_bytes_rate_pct = $avg_wan3_bytes_rate ? number_format($avg_wan3_bytes_rate / $total * 100, 1) : 0;
                        		$avg_lte1_bytes_rate_pct = $avg_lte1_bytes_rate ? number_format($avg_lte1_bytes_rate / $total * 100, 1) : 0;
                        		$avg_lte2_bytes_rate_pct = $avg_lte2_bytes_rate ? number_format($avg_lte2_bytes_rate / $total * 100, 1) : 0;
                        		$avg_lte3_bytes_rate_pct = $avg_lte3_bytes_rate ? number_format($avg_lte3_bytes_rate / $total * 100, 1) : 0;
                        } ?>

                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>

                <!-- chart div starts here -->
                <div class="stats_info">
                    <div class="row ">
                        <div class="col-lg-1"><button onclick="ShowPastWeek('byte_area_graph_data')" id="PW" class="btn PW">Past
                                Week</button></div>
                        <div class="col-lg-2"><button onclick="ShowPastDay('byte_area_graph_data')" id="PD" class="btn PD" disabled>Past
                                24 Hours</button></div>
                    </div>
                    <div id="DisplayText" style="position: relative;padding-top:30px;font-weight: bold;">
                        Showing: Past 24 Hours</div>

                    <div id="chart-container" style="position: relative; height:30vh; width:80vw">
                        <canvas id="myChart3" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                        <canvas id="myChart2" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                        <canvas id="myChart" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                        <canvas id="myChart1" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                        <canvas id="myChart4" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                        <canvas id="myChart5" style="width:100%;max-width:1000px;height:150px"></canvas><br><br>
                    </div>

                    <div id="chart-container-week" style="position: relative ; height:30vh; width:80vw">
                        <canvas id="myChart8" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                        <canvas id="myChart9" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                        <canvas id="myChart6" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                        <canvas id="myChart7" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                        <canvas id="myChart10" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                        <canvas id="myChart11" style="width:100%;max-width:1000px;height:45px"></canvas><br><br>
                    </div>
                </div>

                <div class="edge_qos_stats">
                    <div class="row ">
                        <div class="col-lg-1"><button onclick="ShowPastWeek('edge_qos_stats')" id="PW" class="btn PW">Past
                                Week</button></div>
                        <div class="col-lg-2"><button onclick="ShowPastDay('edge_qos_stats')" id="PD" class="btn PD" disabled>Past
                                24 Hours</button></div>
                    </div>
                    <div class="row">

                        <div class="col-lg-6" align="center">
                            <div class="graph">

                                <div class="title">
                                    <h4> RX Bytes </h4>
                                </div>
                                <div class="empty_rx_bytes">No data's</div>
                                <div class="row rx_bytes">

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Application Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="rx-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-rx-pie-chart"></canvas>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 protocol-stat">
                                        <div class="chart-heading ">
                                            <b>
                                                <h6>Protocol Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="pro-rx-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-pro-rx-pie-chart"></canvas>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-6" align="center">
                            <div class="graph">
                                <div class="title">
                                    <h4>RX Packet </h4>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Application Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="rx-pkt-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-rx-pkt-pie-chart"></canvas>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 protocol-stat">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Protocol Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="pro-rx-pkt-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-pro-rx-pkt-pie-chart"></canvas>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:4%;">

                        <div class="col-lg-6" align="center">
                            <div class="graph">
                                <div class="title">
                                    <h4> TX Bytes </h4>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Application Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="tx-bytes-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-tx-bytes-pie-chart"></canvas>
                                    </div>
                                    <div class="col-lg-6 protocol-stat col-md-6 col-sm-6">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Protocol Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="pro-tx-bytes-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-pro-tx-bytes-pie-chart"></canvas>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-6" align="center">
                            <div class="graph">
                                <div class="title">
                                    <h4>TX Packet </h4>
                                </div>
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="chart-heading">
                                            <b>
                                                <h6>Application Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="tx-pkt-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-tx-pkt-pie-chart"></canvas>
                                    </div>
                                    <div class="col-lg-6 protocol-stat col-md-6 col-sm-6">
                                        <div class="chart-heading ">
                                            <b>
                                                <h6>Protocol Stats</h6>
                                            </b>
                                        </div>
                                        <canvas class="past_day" id="pro-tx-pkt-pie-chart"></canvas>
                                        <canvas class="past_week past_week_qos_stats" id="wk-pro-tx-pkt-pie-chart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="edge_qos_stats_live">
                    <button onclick="ShowPastWeek('edge_qos_stats_live')" id="PW" class="btn PW">Past Week</button>
                    <button onclick="ShowPastDay('edge_qos_stats_live')" id="PD" class="btn PD" disabled>Past 24 Hours</button>
                    <div id="DisplayText" style="position: relative;padding-top:30px;font-weight: bold;">Showing: Past 24 Hours</div>
                    <div class="parent_container">
                        <div class="row rx_bytes">
                            <div class="col-lg-9">
                                <h4>RX Bytes</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Application Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <canvas class="past_day" id="myChart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="myChart-live-wk"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Protocol Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <canvas class="past_day" id="rx-byte-pro-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="rx-byte-pro-chart-live-wk"></canvas>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-9">
                                <h4>RX Packet</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Application Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <canvas class="past_day" id="rx-pkt-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="rx-pkt-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Protocol Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <canvas class="past_day" id="rx-pkt-pro-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="rx-pkt-pro-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <h4>TX Bytes</h4>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Application Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <canvas class="past_day" id="tx-bytes-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="tx-bytes-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Protocol Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <canvas class="past_day" id="tx-bytes-pro-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="tx-bytes-pro-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <h4>TX Packet </h4>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Application Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11">
                                <canvas class="past_day" id="tx-pkt-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="tx-pkt-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <b>
                                    <h6>Protocol Stats
                                </b></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <canvas class="past_day" id="tx-pkt-pro-pie-chart-live"></canvas>
                                <canvas class="past_week_lv past_week_live" id="tx-pkt-pro-pie-chart-live-wk"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- chart div ends here -->


                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>



<!-- jQuery -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?php // echo $CI->config->base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.0/chartjs-plugin-zoom.js"></script> -->

<!-- Sparkline -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo $CI->config->base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
</script>
<!-- AdminLTE App -->
<script src="<?php echo $CI->config->base_url(); ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $CI->config->base_url(); ?>assets/dist/js/pages/dashboard.js"></script>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
</div>
<!-- DataTables  & Plugins -->
<!-- <script src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script
        src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script
        src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script
        src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script
        src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script
        src="<?php // echo $CI->config->base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->

<script>
    function ShowPastDay(graph_type) {
        var z = document.getElementById("DisplayText");
        z.innerHTML = "Showing: Past 24 Hours";
        $('.PW').attr('disabled', false);
        $('.PD').attr('disabled', true);
        if (graph_type == 'byte_area_graph_data') {
            var x = document.getElementById("chart-container-week");
            var y = document.getElementById("chart-container");
            $('.edge_qos_stats').hide();
            if (y.style.display === "none") {
                x.style.display = "none";
                y.style.display = "block";
            }
        } else if (graph_type == 'edge_qos_stats') {
            $('.edge_qos_stats').show();
            $('#stats_info').hide();
            $('.past_day').show();
            $('.past_week').hide();
            $('.past_week').removeClass('past_week_qos_stats');
        } else if (graph_type == 'edge_qos_stats_live') {
            $('.edge_qos_stats_live').show()
            $('.edge_qos_stats').hide();
            $('#stats_info').hide();
            $('.past_day').show();
            $('.past_week_lv').hide();
            $('.past_week_lv').removeClass('past_week_live');

        }
        // alert('test');

    }

    function ShowPastWeek(graph_type) {
        var z = document.getElementById("DisplayText");
        z.innerHTML = "Showing: Past Week";
        $('.PW').attr('disabled', true);
        $('.PD').attr('disabled', false);
        if (graph_type == 'byte_area_graph_data') {
            $('.edge_qos_stats_live').hide();
            var x = document.getElementById("chart-container");
            var y = document.getElementById("chart-container-week");

            if (y.style.display === "none") {
                x.style.display = "none";
                y.style.display = "block";
            }
            $('.edge_qos_stats').hide();
        } else if (graph_type == 'edge_qos_stats') {
            console.log('ShowPastWeek');
            $('.edge_qos_stats').show();
            $('#stats_info').hide();
            $('.past_day').hide();
            $('.past_week').show();
            $('.past_week').removeClass('past_week_qos_stats');
        } else if (graph_type == 'edge_qos_stats_live') {
            $('.edge_qos_stats_live').show();
            $('.edge_qos_stats').hide();
            $('#stats_info').hide();
            $('.past_day').hide();
            $('.past_week_lv').show();
            $('.past_week_lv').removeClass('past_week_live');

        }
    }

    let live_charts = [];

    function edge_qos_stats_live(sno) {

        var z = document.getElementById("DisplayText");
        z.innerHTML = "Showing: Past 24 Hours";
        $('.PW').attr('disabled', false);
        $('.PD').attr('disabled', true);

        $('.past_week_lv').addClass('past_week_live');
        if ((live_charts.length) > 0) {
            live_charts.forEach(chart => {
                chart.destroy();
            });
        }

        $('.edge_qos_stats').hide();
        $('.stats_info').hide();
        $('.edge_qos_stats_live').show();
        $.ajax({
            url: '<?php echo base_url('Edge/edge_qos_stats_live'); ?>',
            method: 'POST',
            data: {
                'sno': sno
            },
            success: function(data) {
                var parsed_data = JSON.parse(data);
                console.log('parsed_data', parsed_data);
                var myChart = parsed_data['myChart'];
                // $('#myChart').html('no data');
                var rx_byte_pro_chart = parsed_data['rx-byte-pro-chart'];
                var rx_pkt_pie_chart = parsed_data['rx-pkt-pie-chart'];
                var rx_pkt_pro_pie_chart = parsed_data['rx-pkt-pro-pie-chart'];
                var tx_bytes_pie_chart = parsed_data['tx-bytes-pie-chart'];
                var tx_bytes_pro_pie_chart = parsed_data['tx-bytes-pro-pie-chart'];
                var tx_pkt_pie_chart = parsed_data['tx-pkt-pie-chart'];
                var tx_pkt_pro_pie_chart = parsed_data['tx-pkt-pro-pie-chart'];
                var myChart_wk = parsed_data['myChart-wk'];
                var rx_byte_pro_chart_wk = parsed_data['rx-byte-pro-chart-wk'];
                var rx_pkt_pie_chart_wk = parsed_data['rx-pkt-pie-chart-wk'];
                var rx_pkt_pro_pie_chart_wk = parsed_data['rx-pkt-pro-pie-chart-wk'];
                var tx_bytes_pie_chart_wk = parsed_data['tx-bytes-pie-chart-wk'];
                var tx_bytes_pro_pie_chart_wk = parsed_data['tx-bytes-pro-pie-chart-wk'];
                var tx_pkt_pie_chart_wk = parsed_data['tx-pkt-pie-chart-wk'];
                var tx_pkt_pro_pie_chart_wk = parsed_data['tx-pkt-pro-pie-chart-wk'];

                //var rx_byte_chart = JSON.parse(rx_byte_chart);
                render_live_area_chart(myChart, 'myChart-live', 'application_chart', 'with_unit');
                render_live_area_chart(rx_byte_pro_chart, 'rx-byte-pro-chart-live', 'protocol_chart', 'with_unit');
                render_live_area_chart(rx_pkt_pie_chart, 'rx-pkt-pie-chart-live', 'application_chart', 'with_no_unit');
                render_live_area_chart(rx_pkt_pro_pie_chart, 'rx-pkt-pro-pie-chart-live', 'protocol_chart', 'with_no_unit');
                render_live_area_chart(tx_bytes_pie_chart, 'tx-bytes-pie-chart-live', 'application_chart', 'with_unit');
                render_live_area_chart(tx_bytes_pro_pie_chart, 'tx-bytes-pro-pie-chart-live', 'protocol_chart', 'with_unit');
                render_live_area_chart(tx_pkt_pie_chart, 'tx-pkt-pie-chart-live', 'application_chart', 'with_no_unit');
                render_live_area_chart(tx_pkt_pro_pie_chart, 'tx-pkt-pro-pie-chart-live', 'protocol_chart', 'with_no_unit');

                render_live_area_chart(myChart_wk, 'myChart-live-wk', 'application_chart', 'with_unit');
                render_live_area_chart(rx_byte_pro_chart_wk, 'rx-byte-pro-chart-live-wk', 'protocol_chart', 'with_unit');
                render_live_area_chart(rx_pkt_pie_chart_wk, 'rx-pkt-pie-chart-live-wk', 'application_chart', 'with_no_unit');
                render_live_area_chart(rx_pkt_pro_pie_chart_wk, 'rx-pkt-pro-pie-chart-live-wk', 'protocol_chart', 'with_no_unit');
                render_live_area_chart(tx_bytes_pie_chart_wk, 'tx-bytes-pie-chart-live-wk', 'application_chart', 'with_unit');
                render_live_area_chart(tx_bytes_pro_pie_chart_wk, 'tx-bytes-pro-pie-chart-live-wk', 'protocol_chart', 'with_unit');
                render_live_area_chart(tx_pkt_pie_chart_wk, 'tx-pkt-pie-chart-live-wk', 'application_chart', 'with_no_unit');
                render_live_area_chart(tx_pkt_pro_pie_chart_wk, 'tx-pkt-pro-pie-chart-live-wk', 'protocol_chart', 'with_no_unit');
            }
        })

    }

    function render_live_area_chart(chart_data, app_chart_id_name, type, unit_specification) {
        //            var  ctx = document.getElementById("myChart").getContext('2d');
        var live_chart = [];
        if (type == 'application_chart' && unit_specification == 'with_unit') {
            var ctx = document.getElementById(app_chart_id_name).getContext('2d');
            var rx_bytes_label = chart_data['label'];
            var rx_bytes_http = chart_data['http'];
            var rx_bytes_https = chart_data['https'];
            var rx_bytes_iperf = chart_data['iperf'];
            var rx_bytes_zoom = chart_data['zoom'];
            var rx_bytes_microsoft_teams = chart_data['microsoft_teams'];
            var rx_bytes_skype = chart_data['skype'];
            var rx_bytes_voip = chart_data['voip'];
            var rx_bytes_other = chart_data['other'];
            var max_app_unit_name = chart_data['unit_name'];

            live_chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rx_bytes_label,
                    datasets: [{
                            label: 'http', // Name the series
                            data: rx_bytes_http, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(229,124,35)', // Add custom color border (Line)
                            backgroundColor: 'rgba(229,124,35,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'https', // Name the series
                            data: rx_bytes_https, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(233,102,160)', // Add custom color border (Line)
                            backgroundColor: 'rgba(233,102,160,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'iperf', // Name the series
                            data: rx_bytes_iperf, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(137,129,33)', // Add custom color border (Line)
                            backgroundColor: 'rgba(137,129,33,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'zoom', // Name the series
                            data: rx_bytes_zoom, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(167,130,149)', // Add custom color border (Line)
                            backgroundColor: 'rgba(167,130,149,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'microsoft teams', // Name the series
                            data: rx_bytes_microsoft_teams, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(120,193,243)', // Add custom color border (Line)
                            backgroundColor: 'rgba(120,193,243,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'skype', // Name the series
                            data: rx_bytes_skype, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(181,201,154)', // Add custom color border (Line)
                            backgroundColor: 'rgba(181,201,154,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'voip', // Name the series
                            data: rx_bytes_voip, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(78,79,235)', // Add custom color border (Line)
                            backgroundColor: 'rgba(78,79,235,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'other', // Name the series
                            data: rx_bytes_other, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(209,209,209)', // Add custom color border (Line)
                            backgroundColor: 'rgba(209,209,209,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'right',
                    },

                    tooltips: {
                        responsive: true,
                        mode: 'index', // 'nearest', 'index', 'interpolate', or 'point'
                        intersect: false,
                        displayColors: false, // Set to true if you want to show color boxes in tooltips
                        callbacks: {
                            title: function(tooltipItems, data) {
                                return data.labels[tooltipItems[0].index]; // Show the label as the tooltip title
                            },
                            label: function(tooltipItem, data) {
                                const datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                                const value = tooltipItem.yLabel;
                                const unit = max_app_unit_name[tooltipItem.datasetIndex];
                                return `${datasetLabel}: ${value} ${unit}`; // Show the dataset label and value as the tooltip label
                            },
                        },
                    },
                    scales: {
                        x: {
                            display: true,
                        },
                        y: {
                            display: true,
                        },
                    },
                }
            });
        } else if (type == 'protocol_chart' && unit_specification == 'with_unit') {
            chart_data
            var ctx = document.getElementById(app_chart_id_name).getContext('2d');

            var rx_bytes_label = chart_data['label'];
            var rx_bytes_tcp = chart_data['tcp'];
            var rx_bytes_udp = chart_data['udp'];
            var rx_bytes_icmp = chart_data['icmp'];
            var max_pro_unit_name = chart_data['unit_name'];



            live_chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rx_bytes_label,
                    datasets: [{
                            label: 'tcp', // Name the series
                            data: rx_bytes_tcp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(58,166,185)', // Add custom color border (Line)
                            backgroundColor: 'rgba(58,166,185,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'udp', // Name the series
                            data: rx_bytes_udp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(231,206,166)', // Add custom color border (Line)
                            backgroundColor: 'rgba(231,206,166,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'icmp', // Name the series
                            data: rx_bytes_icmp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(209,209,209)', // Add custom color border (Line)
                            backgroundColor: 'rgba(209,209,209,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'right',
                    },

                    tooltips: {
                        responsive: true,
                        mode: 'index', // 'nearest', 'index', 'interpolate', or 'point'
                        intersect: false,
                        displayColors: false, // Set to true if you want to show color boxes in tooltips
                        callbacks: {
                            title: function(tooltipItems, data) {
                                return data.labels[tooltipItems[0].index]; // Show the label as the tooltip title
                            },
                            label: function(tooltipItem, data) {
                                const datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                                const value = tooltipItem.yLabel;
                                const unit = max_pro_unit_name[tooltipItem.datasetIndex];
                                return `${datasetLabel}: ${value} ${unit}`; // Show the dataset label and value as the tooltip label
                            },
                        },
                    },
                    scales: {
                        x: {
                            display: true,
                        },
                        y: {
                            display: true,
                        },
                    },
                }
            });
        } else if (type == 'application_chart' && unit_specification == 'with_no_unit') {
            var ctx = document.getElementById(app_chart_id_name).getContext('2d');
            var rx_pkt_labl = chart_data['label'];
            var rx_pkt_http = chart_data['http'];
            var rx_pkt_https = chart_data['https'];
            var rx_pkt_iperf = chart_data['iperf'];
            var rx_pkt_zoom = chart_data['zoom'];;
            var rx_pkt_microsoft_teams = chart_data['microsoft_teams'];
            var rx_pkt_skype = chart_data['skype'];
            var rx_pkt_voip = chart_data['voip'];
            var rx_pkt_other = chart_data['other'];


            live_chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rx_pkt_labl,
                    datasets: [{
                            label: 'http', // Name the series
                            data: rx_pkt_http, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(229,124,35)', // Add custom color border (Line)
                            backgroundColor: 'rgba(229,124,35,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'https', // Name the series
                            data: rx_pkt_https, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(233,102,160)', // Add custom color border (Line)
                            backgroundColor: 'rgba(233,102,160,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'iperf', // Name the series
                            data: rx_pkt_iperf, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(137,129,33)', // Add custom color border (Line)
                            backgroundColor: 'rgba(137,129,33,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'zoom', // Name the series
                            data: rx_pkt_zoom, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(167,130,149)', // Add custom color border (Line)
                            backgroundColor: 'rgba(167,130,149,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'microsoft teams', // Name the series
                            data: rx_pkt_microsoft_teams, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(120,193,243)', // Add custom color border (Line)
                            backgroundColor: 'rgba(120,193,243,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'skype', // Name the series
                            data: rx_pkt_skype, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(181,201,154)', // Add custom color border (Line)
                            backgroundColor: 'rgba(181,201,154,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'voip', // Name the series
                            data: rx_pkt_voip, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(78,79,235)', // Add custom color border (Line)
                            backgroundColor: 'rgba(78,79,235,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'other', // Name the series
                            data: rx_pkt_other, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(209,209,209)', // Add custom color border (Line)
                            backgroundColor: 'rgba(209,209,209,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'right',
                    },

                    tooltips: {
                        responsive: true,
                        mode: 'index', // 'nearest', 'index', 'interpolate', or 'point'
                        intersect: false,
                        displayColors: false, // Set to true if you want to show color boxes in tooltips
                        callbacks: {
                            title: function(tooltipItems, data) {
                                return data.labels[tooltipItems[0].index]; // Show the label as the tooltip title
                            },
                            label: function(tooltipItem, data) {
                                const datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                                const value = tooltipItem.yLabel;
                                return `${datasetLabel}: ${value}`; // Show the dataset label and value as the tooltip label
                            },
                        },
                    },
                    scales: {
                        x: {
                            display: true,
                        },
                        y: {
                            display: true,
                        },
                    },
                }
            });
        } else if (type == 'protocol_chart' && unit_specification == 'with_no_unit') {
            var ctx = document.getElementById(app_chart_id_name).getContext('2d');
            var rx_pkt_labl = chart_data['label'];
            var rx_pkt_tcp = chart_data['tcp'];
            var rx_pkt_udp = chart_data['udp'];
            var rx_pkt_icmp = chart_data['icmp'];



            live_chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rx_pkt_labl,
                    datasets: [{
                            label: 'tcp', // Name the series
                            data: rx_pkt_tcp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(58,166,185)', // Add custom color border (Line)
                            backgroundColor: 'rgba(58,166,185,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'udp', // Name the series
                            data: rx_pkt_udp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(231,206,166)', // Add custom color border (Line)
                            backgroundColor: 'rgba(231,206,166,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },
                        {
                            label: 'icmp', // Name the series
                            data: rx_pkt_icmp, // Specify the data values array
                            fill: true,
                            borderColor: 'rgb(209,209,209)', // Add custom color border (Line)
                            backgroundColor: 'rgba(209,209,209,0.5)', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'right',
                    },

                    tooltips: {
                        responsive: true,
                        mode: 'index', // 'nearest', 'index', 'interpolate', or 'point'
                        intersect: false,
                        displayColors: false, // Set to true if you want to show color boxes in tooltips
                        callbacks: {
                            title: function(tooltipItems, data) {
                                return data.labels[tooltipItems[0].index]; // Show the label as the tooltip title
                            },
                            label: function(tooltipItem, data) {
                                const datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
                                const value = tooltipItem.yLabel;
                                return `${datasetLabel}: ${value}`; // Show the dataset label and value as the tooltip label
                            },
                        },
                    },
                    scales: {
                        x: {
                            display: true,
                        },
                        y: {
                            display: true,
                        },
                    },
                }
            });
        }
        live_charts.push(live_chart);
    }

    let pie_charts = [];

    function edge_qos_stats(sno) {
        $('.past_week').addClass('past_week_qos_stats');
        var z = document.getElementById("DisplayText");
        z.innerHTML = "Showing: Past 24 Hours";
        $('.PW').attr('disabled', false);
        $('.PD').attr('disabled', true);

        if ((pie_charts.length) > 0) {
            pie_charts.forEach(charts => {
                charts.destroy();
            })
        }
        $('.past_week_lv').addClass('past_week_live');
        $('.edge_qos_stats').show();
        $('.stats_info').hide();
        $('.edge_qos_stats_live').hide();
        $.ajax({
            url: '<?php echo base_url('Edge/edge_qos_stats'); ?>',
            method: 'POST',
            data: {
                'sno': sno
            },
            success: function(data) {

                var parsed_data = JSON.parse(data);

                var qos_array = parsed_data[0]['qos_array'] ? parsed_data[0]['qos_array'] : '';
                var max_app_unit_name = parsed_data[1]['max_app_unit_name'] ? parsed_data[1]['max_app_unit_name'] : '';
                var rx_pkt_array = parsed_data[2]['rx_pkt_array'] ? parsed_data[2]['rx_pkt_array'] : '';
                var pro_rx_pkt_array = parsed_data[3]['pro_rx_pkt_array'] ? parsed_data[3]['pro_rx_pkt_array'] : '';
                var tx_bytes_array = parsed_data[4]['tx_bytes_array'] ? parsed_data[4]['tx_bytes_array'] : '';
                var pro_tx_bytes_array = parsed_data[5]['pro_tx_bytes_array'] ? parsed_data[5]['pro_tx_bytes_array'] : '';
                var max_pro_unit_name = parsed_data[6]['max_pro_unit_name'] ? parsed_data[6]['max_pro_unit_name'] : '';
                var tx_pkt_array = parsed_data[7]['tx_pkt_array'] ? parsed_data[7]['tx_pkt_array'] : '';
                var pro_tx_pkt_array = parsed_data[8]['pro_tx_pkt_array'] ? parsed_data[8]['pro_tx_pkt_array'] : '';
                var wk_qos_array = parsed_data[9]['wk_qos_array'] ? parsed_data[9]['wk_qos_array'] : '';
                var wk_rx_pkt_array = parsed_data[10]['wk_rx_pkt_array'] ? parsed_data[10]['wk_rx_pkt_array'] : '';
                var pro_wk_qos_array = parsed_data[11]['pro_wk_qos_array'] ? parsed_data[11]['pro_wk_qos_array'] : '';
                var wk_tx_bytes_array = parsed_data[12]['wk_tx_bytes_array'] ? parsed_data[12]['wk_tx_bytes_array'] : '';
                var wk_tx_pkt_array = parsed_data[13]['wk_tx_pkt_array'] ? parsed_data[13]['wk_tx_pkt_array'] : '';
                var pro_wk_tx_pkt_array = parsed_data[14]['pro_wk_tx_pkt_array'] ? parsed_data[14]['pro_wk_tx_pkt_array'] : '';
                var pro_wk_tx_bytes_array = parsed_data[15]['pro_wk_tx_bytes_array'] ? parsed_data[15]['pro_wk_tx_bytes_array'] : '';
                var pro_wk_rx_pkt_array = parsed_data[16]['pro_wk_rx_pkt_array'] ? parsed_data[16]['pro_wk_rx_pkt_array'] : '';
                var pro_qos_array = parsed_data[17]['pro_qos_array'] ? parsed_data[17]['pro_qos_array'] : '';
                var wk_max_app_unit_name = parsed_data[18]['wk_max_app_unit_name'] ? parsed_data[18]['wk_max_app_unit_name'] : '';
                var wk_max_pro_unit_name = parsed_data[19]['wk_max_pro_unit_name'] ? parsed_data[19]['wk_max_pro_unit_name'] : '';


                render_piechart('rx-pie-chart', qos_array, max_app_unit_name, ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('pro-rx-pie-chart', pro_qos_array, max_pro_unit_name, ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('rx-pkt-pie-chart', rx_pkt_array, 'no_unit', ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('pro-rx-pkt-pie-chart', pro_rx_pkt_array, 'no_unit', ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('tx-bytes-pie-chart', tx_bytes_array, max_app_unit_name, ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('pro-tx-bytes-pie-chart', pro_tx_bytes_array, max_pro_unit_name, ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('tx-pkt-pie-chart', tx_pkt_array, 'no_unit', ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('pro-tx-pkt-pie-chart', pro_tx_pkt_array, 'no_unit', ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);



                render_piechart('wk-rx-pie-chart', wk_qos_array, wk_max_app_unit_name, ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('wk-rx-pkt-pie-chart', rx_pkt_array, 'no_unit', ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('wk-pro-rx-pie-chart', pro_wk_qos_array, wk_max_pro_unit_name, ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('wk-tx-bytes-pie-chart', wk_tx_bytes_array, wk_max_app_unit_name, ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('wk-tx-pkt-pie-chart', wk_tx_pkt_array, 'no_unit', ["http", "https", "iperf", "zoom",
                    "microsoft teams", "skype", "voip", "other"
                ], ["#E57C23", "#E966A0",
                    "#898121", "#A78295", "#78C1F3", "#B5C99A", "#4E4FEB", "#D1D1D1"
                ]);
                render_piechart('wk-pro-tx-pkt-pie-chart', pro_wk_tx_pkt_array, 'no_unit', ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('wk-pro-tx-bytes-pie-chart', pro_wk_tx_bytes_array, wk_max_pro_unit_name, ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);
                render_piechart('wk-pro-rx-pkt-pie-chart', pro_wk_rx_pkt_array, 'no_unit', ["tcp", "udp", "icmp"], ["#3AA6B9", "#E7CEA6", "#D1D1D1"]);

            }
        });
    }

    function render_piechart(id_name, data_values, unit_value, labels_names, colors) {
        if (unit_value != 'no_unit') {
            var piechart1 = new Chart(document.getElementById(id_name), {
                type: 'pie',
                data: {
                    labels: labels_names,
                    datasets: [{
                        backgroundColor: colors,
                        data: data_values
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'right',
                    },
                    tooltips: {
                        callbacks: {
                            label: (tooltipItem, data) => {
                                const dataset = data.datasets[tooltipItem.datasetIndex];
                                const value = dataset.data[tooltipItem.index];
                                const label = data.labels[tooltipItem.index];
                                const unit = unit_value[tooltipItem.index];
                                return `${label}: ${value} ${unit}`;
                            },
                        },
                    },

                }
            });
            pie_charts.push(piechart1);
        } else {
            var piechart2 = new Chart(document.getElementById(id_name), {
                type: 'pie',
                data: {
                    labels: labels_names,
                    datasets: [{
                        backgroundColor: colors,
                        data: data_values
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'right',
                    }
                }
            });
            pie_charts.push(piechart2);
        }

    }



    let charts = [];

    function byte_area_chart(port_nw_stats, port_device_stats, serialnumber) {
        var z = document.getElementById("DisplayText");
        z.innerHTML = "Showing: Past 24 Hours";
        $('.PW').attr('disabled', false);
        $('.PD').attr('disabled', true);
        if ((charts.length) > 0) {
            charts.forEach(chart => {
                chart.destroy();
            });
        }
        $('.edge_qos_stats').hide();
        $('.stats_info').show();
        $('.edge_qos_stats_live').hide();
        $.ajax({
            url: '<?php echo base_url('Edge/byte_area_chart'); ?>',
            method: 'POST',
            data: {
                'port_nw_stats': port_nw_stats,
                'port_device_stats': port_device_stats,
                'serialnumber': serialnumber
            },
            success: function(data) {
                var splitted_data = data.split('::');
                var myChart = splitted_data[0];
                var myChart1 = splitted_data[1];
                var myChart3 = splitted_data[2];
                var myChart2 = splitted_data[3];
                var myChart4 = splitted_data[4];
                var myChart6 = splitted_data[5];
                var myChart7 = splitted_data[6];
                var myChart8 = splitted_data[7];
                var myChart9 = splitted_data[8];
                var myChart10 = splitted_data[9];

                console.log(myChart, 'myChart');
                console.log(myChart8, 'myChart8');
                var ctx = document.getElementById("myChart");
                var graphDataFromDB = JSON.parse(myChart);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                renderGraph(ctx, graphLabels, graphData, 'Latency (ms)', 'Latency');

                var ctx1 = document.getElementById("myChart1");
                var graphDataFromDB = JSON.parse(myChart1);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                renderGraph(ctx1, graphLabels, graphData, 'Jitter (ms)', 'Jitter');

                var ctx3 = document.getElementById("myChart3");
                var graphDataFromDB = JSON.parse(myChart3);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Received ' + '(' + graphDataFromDB[2] + ')';
                renderGraph(ctx3, graphLabels, graphData, portMetric, 'rx_bytes_rate');

                var ctx2 = document.getElementById("myChart2");
                var graphDataFromDB = JSON.parse(myChart2);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Transferred  ' + '(' + graphDataFromDB[2] + ')';
                renderGraph(ctx2, graphLabels, graphData, portMetric, 'tx_bytes_rate');

                var fourth_chart_data = splitted_data[1];
                var ctx4 = document.getElementById("myChart4");
                var graphDataFromDB = JSON.parse(myChart4);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Link status UP Count';
                port = port_device_stats;
                port_device_stats
                renderGraph(ctx4, graphLabels, graphData, portMetric, 'link_status_' + port + '_up_count', 'bar');

                var ctx5 = document.getElementById("myChart5");
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[2];
                portMetric = 'Link status DOWN Count';
                renderGraph(ctx5, graphLabels, graphData, portMetric, 'link_status_' + port + '_down_count', 'bar');

                var ctx6 = document.getElementById("myChart6");
                var graphDataFromDB = JSON.parse(myChart6);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                renderGraph(ctx6, graphLabels, graphData, 'Latency (ms)', 'Latency');

                var ctx7 = document.getElementById("myChart7");
                var graphDataFromDB = JSON.parse(myChart7);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                renderGraph(ctx7, graphLabels, graphData, 'Jitter (ms)', 'Jitter');

                var ctx8 = document.getElementById("myChart8");
                var graphDataFromDB = JSON.parse(myChart8);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Received ' + '(' + graphDataFromDB[2] + ')';
                renderGraph(ctx8, graphLabels, graphData, portMetric, 'rx_bytes_rate');

                var ctx9 = document.getElementById("myChart9");
                var graphDataFromDB = JSON.parse(myChart9);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Transferred  ' + '(' + graphDataFromDB[2] + ')';
                renderGraph(ctx9, graphLabels, graphData, portMetric, 'tx_bytes_rate');

                var ctx10 = document.getElementById("myChart10");
                var graphDataFromDB = JSON.parse(myChart10);
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[1];
                portMetric = 'Link status UP Count';
                port = port_device_stats;
                renderGraph(ctx10, graphLabels, graphData, portMetric, 'link_status_' + port + '_up_count', 'bar');

                var ctx11 = document.getElementById("myChart11");
                graphLabels = graphDataFromDB[0];
                graphData = graphDataFromDB[2];
                portMetric = 'Link status DOWN Count';
                renderGraph(ctx11, graphLabels, graphData, portMetric, 'link_status_' + port + '_down_count', 'bar');

            }
        })

    }



    var myChart;

    function renderGraph(ctx, graphLabels, graphData, portMetric, yAxisLabel, chartType) {
        if (chartType === null || chartType === undefined) {
            chartType = 'line';
        }
        var color = "rgba(75,192,192,1)";
        var pointHoverBorderColor = "rgba(220,220,220,1)";
        var backgroundColor = "rgba(75,192,192,0.4)";
        if (yAxisLabel === "rx_bytes_rate") {
            color = "rgba(33, 145, 80,0.9)";
            pointHoverBorderColor = "rgba(33, 145, 80,0.9)";
            backgroundColor = "rgba(33, 145, 80,0.4)";
        }
        if (yAxisLabel === "tx_bytes_rate") {
            color = "rgba(41,129,228,0.9)";
            pointHoverBorderColor = "rgba(41,129,228,0.9)";
            backgroundColor = "rgba(41,129,228,0.4)";
        }
        if (yAxisLabel === "Jitter") {
            color = "rgba(216,68,48,0.98)";
            pointHoverBorderColor = "rgba(216,68,48,0.98)";
            backgroundColor = "rgba(216,68,48,0.4)";
        }

        if (yAxisLabel === "Latency") {
            color = "rgba(255, 195, 0, 0.9)";
            pointHoverBorderColor = "rgba(255, 195, 0, 0.9)";
            backgroundColor = "rgba(255, 195, 0, 0.4)";
        }
        if (yAxisLabel.includes("up_count")) {
            color = "rgba(133, 200, 138, 1)";
            pointHoverBorderColor = "rgba(195, 229, 174,0.4)";
            backgroundColor = "rgba(107, 203, 119, 1)";
        }

        if (yAxisLabel.includes("down_count")) {
            color = "rgba(216, 33, 72,0.4)";
            pointHoverBorderColor = "rgba(232, 58, 20, 1)";
            backgroundColor = "rgba(137, 15, 13, 1)";
        }

        var data = {
            labels: graphLabels,
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
                data: graphData,
            }]
        };

        var newChart = new Chart(ctx, {
            type: chartType,
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x'
                        },
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            mode: 'x'
                        }
                    },
                },
                //XY-axis labelling and tick configuration
                scales: {
                    yAxes: [{
                        ticks: {
                            autoskip: true,
                            autoSkipPadding: 20
                        },
                        scaleLabel: {
                            display: true,
                            labelString: yAxisLabel
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.1,
                        ticks: {
                            autoskip: true,
                            autoSkipPadding: 20
                        },

                        scaleLabel: {
                            display: true,
                            labelString: 'Timestamp'
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return " " + portMetric + " " + tooltipItem.yLabel.toFixed(2);
                        }
                    }
                }
            }
        });

        charts.push(newChart);
    }
</script>

<script>
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');

    <?php if ($model == 'vm' && $model_variant == "l3") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",

    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)'],
    }]
}
<?php } elseif ($model == 'vm' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",

    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)'],
    }]
}



<?php } elseif ($model == 'spider' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>"
    ],
    datasets: [{
        data: [ '<?php echo $avg_wan1_bytes_rate ?>','<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)', 'rgba(250, 78, 171,0.98)'],
    }]
}


<?php } elseif ($model == 'spider' && $model_variant == "l2w1l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>"
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}

<?php } elseif ($model == 'spider' && $model_variant == "l3") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>"
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>','<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)', 'rgba(41,129,228,0.9)'],
    }]
}


<?php } elseif ($model == 'spider2' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>",
        "LTE3 <?php echo $avg_lte3_bytes_rate_pct . '%' ?>",
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>', '<?php echo $avg_lte3_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)', 'rgba(41,129,228,0.9)', 'rgba(216,68,48,0.98)'],
    }]
}

<?php } elseif ($model == 'spider2' && $model_variant == "l3") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "WAN3 <?php echo $avg_wan3_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>",
        "LTE3 <?php echo $avg_lte3_bytes_rate_pct . '%' ?>",
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_wan3_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>', '<?php echo $avg_lte3_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)', 'rgba(41,129,228,0.9)', 'rgba(216,68,48,0.98)', 'rgba(250, 78, 171,0.98)'],
    }]
}
<?php } elseif ($model == 'beetle' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> "
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}
<?php } elseif ($model == 'beetle' && $model_variant == "l3") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> "
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}

<?php } elseif ($model == 'bumblebee' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> "
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}
<?php } elseif ($model == 'bumblebee' && $model_variant == "l3") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> "
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}
<?php } elseif ($model == 'wasp1' && $model_variant == "l2") { ?>

var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> "
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)'],
    }]
}
<?php } elseif ($model == 'wasp2' && $model_variant == "l2") { ?>


var donutData = {
    labels: [
        "WAN1 <?php echo $avg_wan1_bytes_rate_pct . '%' ?> ",
        "WAN2 <?php echo $avg_wan2_bytes_rate_pct . '%' ?>",
        "LTE1 <?php echo $avg_lte1_bytes_rate_pct . '%' ?> ",
        "LTE2 <?php echo $avg_lte2_bytes_rate_pct . '%' ?>"
    ],
    datasets: [{
        data: ['<?php echo $avg_wan1_bytes_rate ?>', '<?php echo $avg_wan2_bytes_rate ?>', '<?php echo $avg_lte1_bytes_rate ?>', '<?php echo $avg_lte2_bytes_rate ?>'],
        backgroundColor: ['rgba(33, 145, 80,0.9)', 'rgba(255, 195, 0, 0.9)', 'rgba(75,0,130, 0.9)', 'rgba(41,129,228,0.9)']
    }]
}
<?php } ?>

    var donutOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: 'right',
        }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
</script>

<script>
    function render_piechart(rx - pie - chart, labels_values, background_color, pie_chart_val, max_app_unit_name) {
        console.log(pie_chart_val, 'pie_chart_val');
        var rx_byte_chart = new Chart(document.getElementById(rx - pie - chart), {
            type: 'pie',
            data: {
                labels: labels_values,
                datasets: [{
                    backgroundColor: background_color,
                    data: pie_chart_val
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                },
                tooltips: {
                    callbacks: {
                        label: (tooltipItem, data) => {
                            const dataset = data.datasets[tooltipItem.datasetIndex];
                            const value = dataset.data[tooltipItem.index];
                            const label = data.labels[tooltipItem.index];
                            const unit = max_app_unit_name[tooltipItem.index];
                            return `${label}: ${value} ${unit}`;
                        },
                    },
                },

            }
        });
    }
</script>

</html>
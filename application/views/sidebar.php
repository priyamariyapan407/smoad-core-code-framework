<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link smoad-logo">
        <img src="<?php echo $CI->config->base_url(); ?>assets/dist/img/smoad_rect_logo_5g_white.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="float: none;border-radius: unset;box-shadow: none !important;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php

        $dashboard = $user = $customers = $gateway = $sdwan_server = $circuit_sumary = $edge = $edge_menu = $home_menu = $status = $ztp_dev_lan = $ztp_dev_wireless = $wan1 = $wan2 = $lte1 = $lte2 = $ztp_dev_sdwan =  $ztp_dev_qos = $ztp_dev_qos_app_prio = $ztp_dev_agg = $ztp_dev_firmware = $ztp_dev_config =$ztp_dev_firewall_log =  $ztp_dev_consolidated_log = $ztp_dev_consolidated_report_index = $ztp_dev_debug_jobs = $update_firmware_server = $dev_config_templates = $jitter_tracking = $latency_tracking = $devices_menu = $packets =  $firewall =  $security_menu = $security = $iplist = $log_index =  $alert_menu = $alerts = $alert_config = $alert_index =  $ims =  $network_menu = $networks = $uplink = $console = $engineering_menu = $gateway_menu  = $engineering = $jobs = $notifications =  $network_menu = $alert_menu = $security_menu = $home_menu = $edge_menu = $wan3 = $lte3 = '';



        if ($this->uri->segment('2') == 'dashboard') {
            $dashboard = 'active';
        } else if ($this->uri->segment('1') == 'User') {
            $user = 'active';
        } else if ($this->uri->segment('1') == 'Customers') {
            $customers = 'active';
        } else if (($this->uri->segment('1') == 'Gateway') && ($this->uri->segment('2') == 'sdwan_server')) {
            $gateway_menu = 'menu-open';
            $sdwan_server = 'active';
            $gateway = 'active';
        } else if (($this->uri->segment('1') == 'Gateway') && ($this->uri->segment('2') == 'circuit_sumary')) {
            $gateway_menu = 'menu-open';
            $circuit_sumary = 'active';
            $gateway = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'update_edge')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $home_menu = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'status')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $status = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_lan')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_lan = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_wireless')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_wireless = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'port_status') && ($this->uri->segment('5') == 'wan')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $wan1 = 'active';
            $wan2 = '';
            $wan3 = '';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'port_status') && ($this->uri->segment('5') == 'wan2')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $wan1 = '';
            $wan2 = 'active';
            $wan3 = '';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'port_status') && ($this->uri->segment('5') == 'wan3')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $wan1 = '';
            $wan2 = '';
            $wan3 = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_lte') && ($this->uri->segment('5') == 'lte1')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $lte1 = 'active';
            $lte2 = '';
            $lte3 = '';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_lte') && ($this->uri->segment('5') == 'lte2')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $lte1 = '';
            $lte2 = 'active';
            $lte3 = '';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_lte') && ($this->uri->segment('5') == 'lte3')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $lte1 = '';
            $lte2 = '';
            $lte3 = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_sdwan')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_sdwan = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_qos')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_qos = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_qos_app_prio')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_qos_app_prio = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_agg')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_agg = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_firmware')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_firmware = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'ztp_dev_config') || ($this->uri->segment('2') == 'add_ztp_dev_config'))) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_config = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'ztp_dev_firewall_log'))) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_firewall_log = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_consolidated_log')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_consolidated_log = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_consolidated_report_index')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_consolidated_report_index = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'ztp_dev_debug_jobs')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $ztp_dev_debug_jobs = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && ($this->uri->segment('2') == 'update_firmware_server')) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $update_firmware_server = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'dev_config_templates') || ($this->uri->segment('2') == 'dev_config_template_details'))) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $dev_config_templates = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'jitter_tracking'))) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $jitter_tracking = 'active';
        } else if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'latency_tracking'))) {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $latency_tracking = 'active';
        } else if ($this->uri->segment('1') == 'Edge') {
            $edge = 'active';
            $edge_menu = 'menu-open';
            $devices_menu = 'active';
        } else if (($this->uri->segment('1') == 'Security') && (($this->uri->segment('2') == 'packets'))) {
            $security_menu = 'menu-open';
            $security = 'active';
            $packets = 'active';
        } else if (($this->uri->segment('1') == 'Security') && (($this->uri->segment('2') == 'firewall') || ($this->uri->segment('2') == 'add_rule'))) {
            $security_menu = 'menu-open';
            $security = 'active';
            $firewall = 'active';
        } else if (($this->uri->segment('1') == 'Security') && (($this->uri->segment('2') == 'iplist') || ($this->uri->segment('2') == 'add_ip'))) {
            $security_menu = 'menu-open';
            $security = 'active';
            $iplist = 'active';
        } else if (($this->uri->segment('1') == 'Security') && ($this->uri->segment('2') == 'log_index')) {
            $security_menu = 'menu-open';
            $security = 'active';
            $log_index = 'active';
        } else if (($this->uri->segment('1') == 'Security') && ($this->uri->segment('2') == 'month_info')) {
            $security_menu = 'menu-open';
            $security = 'active';
            $log_index = 'active';
        } else if (($this->uri->segment('1') == 'Alerts') && ($this->uri->segment('2') == 'alert_config')) {
            $alert_menu = 'menu-open';
            $alerts = 'active';
            $alert_config = 'active';
        } else if (($this->uri->segment('1') == 'Alerts') && ($this->uri->segment('2') == 'update_alert_config')) {
            $alert_menu = 'menu-open';
            $alerts = 'active';
            $alert_config = 'active';
        } else if (($this->uri->segment('1') == 'Alerts') && ($this->uri->segment('2') == 'get_month_vice_alert_lst')) {
            $alert_menu = 'menu-open';
            $alerts = 'active';
            $alert_index = 'active';
        } else if (($this->uri->segment('1') == 'Alerts') && ($this->uri->segment('2') == 'alert_details')) {
            $alert_menu = 'menu-open';
            $alerts = 'active';
            $alert_index = 'active';
        } else if (($this->uri->segment('1') == 'Alerts')) {
            $alert_menu = 'menu-open';
            $alerts = 'active';
            $alert_index = 'active';
        } else if (($this->uri->segment('1') == 'Ims')) {
            $ims = 'active';
        } else if (($this->uri->segment('1') == 'Network') && ($this->uri->segment('2') == 'uplink')) {
            $network_menu = 'menu-open';
            $networks = 'active';
            $uplink = 'active';
        } else if (($this->uri->segment('1') == 'Network') && ($this->uri->segment('2') == 'console')) {
            $network_menu = 'menu-open';
            $networks = 'active';
            $console = 'active';
        } else if (($this->uri->segment('1') == 'Engineering') && ($this->uri->segment('2') == 'jobs')) {
            $engineering_menu = 'menu-open';
            $engineering = 'active';
            $jobs = 'active';
        } else if (($this->uri->segment('1') == 'Notifications')) {
            $notifications = 'active';
        }

        ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo base_url('Welcome/dashboard') ?>" class="nav-link <?= $dashboard ? $dashboard : '' ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('User') ?>" class="nav-link  <?= $user ? $user : '' ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Customers') ?>" class="nav-link <?= $customers ? $customers : '' ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?php //echo base_url('Gateway'); ?>" class="nav-link <?php //$gateway ? $gateway : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Gateway
                        </p>
                    </a>
                </li> -->

                <li class="nav-item <?= $gateway_menu ? $gateway_menu : '' ?>">
                    <a href="#" class="nav-link <?= $gateway ? $gateway : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                        Gateway
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?php echo base_url('Gateway/sdwan_server'); ?>" class="nav-link <?= $sdwan_server ? $sdwan_server : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>sdwan server</p>
                            </a>
                        </li>

                    </ul>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?php echo base_url('Gateway/circuit_sumary'); ?>" class="nav-link <?= $circuit_sumary ? $circuit_sumary : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>circuit sumary</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item <?= $edge_menu ?>">
                    <a href="#" class="nav-link <?= $edge; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Edge
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Edge'); ?>" class="nav-link <?= $devices_menu ? $devices_menu : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Devices</p>
                            </a>
                        </li>
                        <?php if (($this->uri->segment('1') == 'Edge') && (($this->uri->segment('2') == 'update_edge') ||  ($this->uri->segment('2') == 'status') ||  ($this->uri->segment('2') == 'ztp_dev_lan') ||  ($this->uri->segment('2') == 'port_status')  ||  ($this->uri->segment('2') == 'ztp_dev_wireless') ||  ($this->uri->segment('2') == 'ztp_dev_lte')  ||  ($this->uri->segment('2') == 'ztp_dev_sdwan')  ||  ($this->uri->segment('2') == 'ztp_dev_qos')  ||  ($this->uri->segment('2') == 'ztp_dev_qos_app_prio')  ||  ($this->uri->segment('2') == 'ztp_dev_agg')  ||  ($this->uri->segment('2') == 'ztp_dev_firmware')  ||  ($this->uri->segment('2') == 'ztp_dev_config') ||  ($this->uri->segment('2') == 'add_ztp_dev_config') ||  ($this->uri->segment('2') == 'ztp_dev_firewall_log') ||  ($this->uri->segment('2') == 'ztp_dev_consolidated_log')  ||  ($this->uri->segment('2') == 'ztp_dev_consolidated_report_index')  ||  ($this->uri->segment('2') == 'ztp_dev_debug_jobs'))) { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/update_edge/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $home_menu ? $home_menu : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Home</p>
                                </a>

                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/status/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $status ? $status : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Status</p>
                                </a>
                            </li>
                            <?php if (sm_get_device_port_branching_by_serialnumber('LAN')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_lan/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_lan ? $ztp_dev_lan : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LAN</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('WAN')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/port_status/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/wan/config'); ?>" class="nav-link<?php echo ' ' . $wan1; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>WAN1</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('WAN2')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/port_status/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/wan2/config'); ?>" class="nav-link<?php echo ' ' . $wan2; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>WAN2</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('WAN3')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/port_status/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/wan3/config'); ?>" class="nav-link<?php echo ' ' . $wan3; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>WAN3</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('WIRELESS')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_wireless/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_wireless ? $ztp_dev_wireless : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Wireless</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('LTE1')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_lte/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/lte1'); ?>" class="nav-link<?php echo ' ' . $lte1 ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LTE1</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('LTE2')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_lte/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/lte2'); ?>" class="nav-link<?php echo ' ' . $lte2 ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LTE2</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('LTE3')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_lte/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') . '/lte3'); ?>" class="nav-link<?php echo ' ' . $lte3 ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>LTE3</p>
                                    </a>
                                </li>
                            <?php }
                            if (sm_get_device_port_branching_by_serialnumber('LAN') && ($this->session->userdata('accesslevel') == 'root')) { ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('Edge/ztp_dev_sdwan/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_sdwan ? $ztp_dev_sdwan : '' ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SD-WAN</p>
                                    </a>
                                </li>
                            <?php }  ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_qos/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_qos ? $ztp_dev_qos : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>QoS</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_qos_app_prio/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_qos_app_prio ? $ztp_dev_qos_app_prio : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>App Prioritization</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_agg/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_agg ? $ztp_dev_agg : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Link Aggregation</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_firmware/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_firmware ? $ztp_dev_firmware : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Firmware</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_config/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link  <?= $ztp_dev_config ? $ztp_dev_config : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Device Config</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_firewall_log/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link  <?= $ztp_dev_firewall_log ? $ztp_dev_firewall_log : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Firewall Log</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_consolidated_log/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_consolidated_log ? $ztp_dev_consolidated_log : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Logs</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_consolidated_report_index/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_consolidated_report_index ? $ztp_dev_consolidated_report_index : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reports</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="<?php echo base_url('Edge/ztp_dev_debug_jobs/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>" class="nav-link <?= $ztp_dev_debug_jobs ? $ztp_dev_debug_jobs : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jobs</p>
                                </a>
                            </li>
                        <?php }  ?>
                        <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) { ?>
                            <li class="nav-item ">
                                <a href="<?php echo base_url('Edge/update_firmware_server'); ?>" class="nav-link <?= $update_firmware_server ? $update_firmware_server : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Firmware Server</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Edge/dev_config_templates'); ?>" class="nav-link <?= $dev_config_templates ? $dev_config_templates : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Config Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Edge/jitter_tracking'); ?>" class="nav-link <?= $jitter_tracking ? $jitter_tracking : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jitter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Edge/latency_tracking'); ?>" class="nav-link <?= $latency_tracking ? $latency_tracking : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Latency</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?= $security_menu ? $security_menu : '' ?>">
                    <a href="#" class="nav-link <?= $security ? $security : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                            Security
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Security/packets'); ?>" class="nav-link <?= $packets ? $packets : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dropped Packets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Security/firewall'); ?>" class="nav-link <?= $firewall ? $firewall : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Firewall Rules</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Security/iplist'); ?>" class="nav-link <?= $iplist ? $iplist : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>IP List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Security/log_index'); ?>" class="nav-link <?= $log_index ? $log_index : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Firewall Log</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= $alert_menu ? $alert_menu : '' ?>">
                    <a href="#" class="nav-link  <?= $alerts ? $alerts : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                            Alerts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('Alerts/alert_config'); ?>" class="nav-link <?= $alert_config ? $alert_config : '' ?>">
                                <i class="nav-icon far fa-bell"></i>
                                <p>Alert Config</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Alerts'); ?>" class="nav-link <?= $alert_index ? $alert_index : '' ?>">
                                <i class="nav-icon far fa-bell"></i>
                                <p>Historical Log</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php //if ($this->session->userdata('accesslevel') == 'root') { 
                ?>
                <li class="nav-item ">
                    <a href="<?php echo base_url('Ims'); ?>" class="nav-link <?= $ims ? $ims : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            IMS
                        </p>
                    </a>
                </li>

                <li class="nav-item <?= $network_menu ? $network_menu : '' ?>">
                    <a href="#" class="nav-link <?= $networks ? $networks : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                            Network
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="<?php echo base_url('Network/uplink'); ?>" class="nav-link <?= $uplink ? $uplink : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Uplink</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('Network/console'); ?>" class="nav-link <?= $console ? $console : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Console</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?= $engineering_menu ? $engineering_menu : '' ?>">
                    <a href="#" class="nav-link <?= $engineering ? $engineering : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                            ENGG DEBUG
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?php echo base_url('Engineering/jobs'); ?>" class="nav-link <?= $jobs ? $jobs : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>jobs</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <?php //} 
                ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('Notifications'); ?>" class="nav-link <?= $notifications ? $notifications : '' ?>">
                        <i class="nav-icon far fa-bell"></i>
                        <p>
                            Notifications
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<?php
function sm_get_device_port_branching_by_serialnumber($port)
{
    $model = get_session_model_data();
    $model_variant = get_session_model_variant_data();
    // echo $model.' test '.$model_variant;
    if ($port == "WAN") {    //wan1 port is there for all variants
        return true;
    } elseif ($port == "WAN2") {
        if (($model == 'vm' && $model_variant == "l2") || ($model == 'vm' && $model_variant == "l3") ||
            ($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") ||
            ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3") ||
            ($model == 'beetle' && $model_variant == "l2") || ($model == 'beetle' && $model_variant == "l3") ||
            ($model == 'bumblebee' && $model_variant == "l2") || ($model == 'bumblebee' && $model_variant == "l3")
        )
            return true;
    } elseif ($port == "WAN3") {
        if (($model == 'spider2' && $model_variant == "l3"))
            return true;
    } elseif ($port == "LTE1") {
        if (($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") || ($model == 'spider' && $model_variant == "l2w1l2") ||
            ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3") ||
            ($model == 'beetle' && $model_variant == "l2") || ($model == 'beetle' && $model_variant == "l3") ||
            ($model == 'bumblebee' && $model_variant == "l2") || ($model == 'bumblebee' && $model_variant == "l3")
        )
            return true;
    } elseif ($port == "LTE2") {
        if (($model == 'spider' && $model_variant == "l2") || ($model == 'spider' && $model_variant == "l3") || ($model == 'spider' && $model_variant == "l2w1l2") ||
            ($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3")
        )
            return true;
    } elseif ($port == "LTE3") {
        if (($model == 'spider2' && $model_variant == "l2") || ($model == 'spider2' && $model_variant == "l3"))
            return true;
    } elseif ($port == "LAN") {    //lan port is there for all variants
        return true;
    } elseif ($port == "WIRELESS") {    //wifi port is there for all variants
        return true;
    } elseif ($port == "SD-WAN") {    //sdwan port is there for all variants
        return true;
    }

    return false;
} /* sm_get_device_port_branching_by_serialnumber */

?>
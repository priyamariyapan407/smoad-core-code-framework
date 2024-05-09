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
                            <h5><b>Security - Firewall IP List</b></h5>
                        </div>
                    </div>

                    <div class="col-lg-1">
                        <a href="<?php echo base_url('Security/log_index') ?>">
                            <input type="button" class="btn btn-block btn-success" value="Back"></a>
                    </div>

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
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <div>
                                            <h6><b>Security - Firewall Log:</b></h6>
                                        </div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Rule ID </th>
                                                    <th>Packet-Count</th>
                                                    <th>Port</th>
                                                    <th>Source-MAC</th>
                                                    <th>Destination-MAC</th>
                                                    <th>Source-IP</th>
                                                    <th>Destination-IP</th>
                                                    <th>Protocol</th>
                                                    <th>Source-Port</th>
                                                    <th>Destination-Port</th>
                                                    <th>Action</th>
                                                    <th>Reason</th>
                                                    <th>Timestamp</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($month_info as $info) {


                                                    if ($info->type == "user") {
                                                        $user_type = '<span><i class="fa fa-user"></i></span>';
                                                    } else if ($info->type == "ips") {
                                                        $user_type = '<span><i class="fa-solid fa-microchip-ai"></i></span>';
                                                    } else {
                                                        $user_type = '<span><i class="fa fa-times"></i></span>';
                                                    }


                                                    if ($info->action == "allow") {
                                                        $_action = "ALLOW";
                                                        $bg_style = "color:#2981e4;font-weight:bold;\"";
                                                    } else if ($info->action == "monitor") {
                                                        $_action = "MONITOR";
                                                        $bg_style = "color:#4d916a;font-weight:bold;\"";
                                                    } else if ($info->action == "drop") {
                                                        $_action = "DROP";
                                                        $bg_style = "color:#D84430;font-weight:bold;\"";
                                                    }

                                                    if ($info->proto == 1) $proto = "ICMP";
                                                    elseif ($info->proto == 6) $proto = "TCP";
                                                    elseif ($info->proto == 17) $proto = "UDP";

                                                    if (($info->src_port == "0050") || ($info->dst_port == "0050")) {
                                                        $src_port = "HTTP";
                                                        $dst_port = "HTTP";
                                                    } else if (($info->src_port == "0c38") || ($info->dst_port == "0c38")) {
                                                        $src_port = "HTTP2";
                                                        $dst_port = "HTTP2";
                                                    } else if (($info->src_port == "1f98") || ($info->dst_port == "1f98")) {
                                                        $src_port = "HTTP3";
                                                        $dst_port = "HTTP3";
                                                    } else if (($info->src_port == "1f90") || ($info->dst_port == "1f90")) {
                                                        $src_port = "HTTP4";
                                                        $dst_port = "HTTP4";
                                                    } else if (($info->src_port == "0015") || ($info->dst_port == "0015")) {
                                                        $src_port = "FTP";
                                                        $dst_port = "FTP";
                                                    } else if (($info->src_port == "0801") || ($info->dst_port == "0801")) {
                                                        $src_port = "NFS";
                                                        $dst_port = "NFS";
                                                    } else if (($info->src_port == "0cea") || ($info->dst_port == "0cea")) {
                                                        $src_port = "MYSQL";
                                                        $dst_port = "MYSQL";
                                                    } else if (($info->src_port == "1538") || ($info->dst_port == "1538")) {
                                                        $src_port = "PGSQL";
                                                        $dst_port = "PGSQL";
                                                    } else if (($info->src_port == "0016") || ($info->dst_port == "0016")) {
                                                        $src_port = "SSH";
                                                        $dst_port = "SSH";
                                                    } else if (($info->src_port == "0019") || ($info->dst_port == "0019")) {
                                                        $src_port = "SMTP";
                                                        $dst_port = "SMTP";
                                                    } else if (($info->src_port == "01bb") || ($info->dst_port == "01bb")) {
                                                        $src_port = "SSL";
                                                        $dst_port = "SSL";
                                                    } else if (($info->src_port == "006e") || ($info->dst_port == "006e")) {
                                                        $src_port = "POP";
                                                        $dst_port = "POP";
                                                    } else if (($info->src_port == "0035") || ($info->dst_port == "0035")) {
                                                        $src_port = "DNS";
                                                        $dst_port = "DNS";
                                                    } else if (($info->src_port == "14eb") || ($info->dst_port == "14eb")) {
                                                        $src_port = "LLMNR";
                                                        $dst_port = "LLMNR";
                                                    } else if (($info->src_port == "076c") || ($info->dst_port == "076c")) {
                                                        $src_port = "SSDP";
                                                        $dst_port = "SSDP";
                                                    } else if (($info->src_port == "0017") || ($info->dst_port == "0017")) {
                                                        $src_port = "TELNET";
                                                        $dst_port = "TELNET";
                                                    } else if (($info->src_port == "008f") || ($info->dst_port == "008f")) {
                                                        $src_port = "IMAP";
                                                        $dst_port = "IMAP";
                                                    } else if (($info->src_port == "03e1") || ($info->dst_port == "03e1")) {
                                                        $src_port = "IMAPS";
                                                        $dst_port = "IMAPS";
                                                    } else if (($info->src_port == "0185") || ($info->dst_port == "0185")) {
                                                        $src_port = "LDAP";
                                                        $dst_port = "LDAP";
                                                    } else if (($info->src_port == "0058") || ($info->dst_port == "0058")) {
                                                        $src_port = "KRB";
                                                        $dst_port = "KRB";
                                                    } else if (($info->src_port == "13c4") || ($info->dst_port == "13c4")) {
                                                        $src_port = "SIP";
                                                        $dst_port = "SIP";
                                                    } else if (($info->src_port == "13e2") || ($info->dst_port == "13e2")) {
                                                        $src_port = "SIP2";
                                                        $dst_port = "SIP2";
                                                    } else if (($info->src_port == "1f40") || ($info->dst_port == "1f40")) {
                                                        $src_port = "RTP";
                                                        $dst_port = "RTP";
                                                    } else if (($info->src_port == "1f42") || ($info->dst_port == "1f42")) {
                                                        $src_port = "RTP2";
                                                        $dst_port = "RTP2";
                                                    } else if (($info->src_port == "1392") || ($info->dst_port == "1392")) {
                                                        $src_port = "RTP3";
                                                        $dst_port = "RTP3";
                                                    } else if (($info->src_port == "1394") || ($info->dst_port == "1394")) {
                                                        $src_port = "RTP4";
                                                        $dst_port = "RTP4";
                                                    } else if (($info->src_port == "1f41") || ($info->dst_port == "1f41")) {
                                                        $src_port = "RTCP";
                                                        $dst_port = "RTCP";
                                                    } else if (($info->src_port == "1f43") || ($info->dst_port == "1f43")) {
                                                        $src_port = "RTCP2";
                                                        $dst_port = "RTCP2";
                                                    } else if (($info->src_port == "1393") || ($info->dst_port == "1393")) {
                                                        $src_port = "RTCP3";
                                                        $dst_port = "RTCP3";
                                                    } else if (($info->src_port == "1395") || ($info->dst_port == "1395")) {
                                                        $src_port = "RTCP4";
                                                        $dst_port = "RTCP4";
                                                    } else if (($info->src_port == "0d3d") || ($info->dst_port == "0d3d")) {
                                                        $src_port = "RDP";
                                                        $dst_port = "RDP";
                                                    } else if (($info->src_port == "170d") || ($info->dst_port == "170d")) {
                                                        $src_port = "VNC";
                                                        $dst_port = "VNC";
                                                    } else if (($info->src_port == "170e") || ($info->dst_port == "170e")) {
                                                        $src_port = "VNC2";
                                                        $dst_port = "VNC2";
                                                    } else if (($info->src_port == "170f") || ($info->dst_port == "170f")) {
                                                        $src_port = "VNC3";
                                                        $dst_port = "VNC3";
                                                    } else if (($info->src_port == "1710") || ($info->dst_port == "1710")) {
                                                        $src_port = "VNC4";
                                                        $dst_port = "VNC4";
                                                    } else if (($info->src_port == "c8d5") || ($info->dst_port == "c8d5")) {
                                                        $src_port = "TORRENT";
                                                        $dst_port = "TORRENT";
                                                    } else {
                                                        $src_port = "0x";
                                                        $dst_port = "0x";
                                                    }



                                                ?>
                                                    <tr>

                                                        <td> <?php echo $info->id ?> </td>
                                                        <td> <?php echo $user_type ?> </td>
                                                        <td> <?php echo $info->rule_id ?> </td>
                                                        <td> <?php echo $info->pkt_count ?> </td>
                                                        <td> <?php echo $info->port ?> </td>
                                                        <td> <?php echo $info->src_mac ?> </td>
                                                        <td> <?php echo $info->dst_mac ?> </td>
                                                        <td> <?php echo $info->src_ip ?> </td>
                                                        <td> <?php echo $info->dst_ip ?> </td>
                                                        <td> <?php echo $proto ?> </td>
                                                        <td> <?php echo $src_port; ?> </td>
                                                        <td> <?php echo $dst_port; ?> </td>
                                                        <td style=" <?php echo $bg_style ?>"> <?php echo $_action ?></td>
                                                        <td> <?php echo $info->reason ?> </td>
                                                        <td> <?php echo $info->log_timestamp ?> </td>


                                                        <td>
                                                            <?php
                                                            if ($this->session->userdata('accesslevel') == 'root' || $this->session->userdata('accesslevel') == 'admin' || $this->session->userdata('accesslevel') == 'customer') { ?>

                                                                <span class="fa_view" style="margin: 2%;">
                                                                    <a style="color:#000 !important" href="<?php echo base_url('Security/delete_month_lst/' . $info->id . '/' . $date) ?>">
                                                                        <span class='fa fa-trash'></span>
                                                                    </a>
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
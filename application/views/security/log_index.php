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
                            <h5><b>Security - Firewall Log Index</b></h5>
                        </div>
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
                                            <h6><b>Historical raw logs</b></h6>
                                        </div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <!-- <thead>
                                                    <tr>
                                                        
                                                        <th>ID</th>
                                                        <th>Type</th>
                                                        <th>Source IP-Address</th>
                                                        <th>Description</th>
                                                        <th></th>
                                                    </tr>
                                                </thead> -->
                                            <tbody class="contest_lst">
                                                <?php foreach ($log_index_info as $log) {
                                                    // $unique_month_info = array();
                                                    // $unique_month_info = array_unique($log['month_info']);
                                                    // echo "<pre>"; print_r($unique_month_info);
                                                ?>
                                                    <tr>

                                                        <td><?php echo $log['year']; ?></td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Jan') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Feb') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Mar') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Apr') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'May') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Jun') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Jul') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Aug') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Sep') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Oct') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Nov') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach ($log['month_info'] as $info) {
                                                                if ($info['month_name'] == 'Dec') { ?>
                                                                    <a href="<?php echo base_url('Security/month_info/' . $info['current_date']) ?>">
                                                                        <div><?php echo $info['month_name']; ?></div>
                                                                    </a>
                                                            <?php break;
                                                                }
                                                            } ?>
                                                        </td>

                                                    <?php } ?>

                                                    </tr>

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
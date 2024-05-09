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
            <div class="row heading">
              <div class="col-lg-11">
                <!-- <div><h5><b>SMOAD CORE - SD-WAN orchestrator</b></h5></div> -->
                <?php foreach ($server_info as $info) { ?>
                  <div>
                    <h5><b>Gateway ZTP - Circuits - <?php echo $info->serialnumber . ' - ' . $info->details  ?></b></h5>
                  </div>
                <?php } ?>
              </div>

            </div>
            <div class="row">

              <div class="col-lg-12">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>

                      <th>ID</th>
                      <th>ID Peer</th>
                      <th>Details</th>
                      <th>Serial Number</th>
                      <th>Public Key</th>
                      <th>Allowed IPs</th>
                      <th>VLAN-ID</th>
                      <th>VXLAN-ID</th>
                      <th>Tunnel Status</th>
                      <th>Link Status</th>
                      <th>Link Up Count</th>
                      <th>Last Link Up Timestamp</th>
                      <th>Data Transfer</th>
                      <th>Handshake</th>
                      <th>Timestamp</th>
                      <th>Soft-client Config</th>
                    </tr>
                  </thead>
                  <tbody class="contest_lst">
                    <?php foreach ($orchestrators as $orchestrator) { ?>

                      <tr>
                        <td> <?php echo $orchestrator->id; ?> </td>
                        <td> <?php echo $orchestrator->id_peer; ?></td>
                        <td> <?php echo $orchestrator->details; ?></td>
                        <td> <?php echo $orchestrator->device_serialnumber; ?></td>
                        <td> <?php echo $orchestrator->prikey; ?></td>
                        <td> <?php echo $orchestrator->allowedipsubnet; ?> </td>
                        <td> <?php echo $orchestrator->vlan_id; ?></td>
                        <td> <?php echo $orchestrator->vxlan_id; ?></td>

                        <?php

                        if ($orchestrator->status == "UP") {
                          $status = '<div class="status"><i class="fa fa-arrow-up status_up" aria-hidden="true"></i></div>';
                        } else if ($orchestrator->status == "DOWN") {
                          $status = '<div class="status"><i class="fa fa-arrow-down status_down" aria-hidden="true"></i></div>';
                        } else if ($orchestrator->status == "UP_WAITING") {
                          $status = '<div class="status"><i class="fa fa-arrow-up status_waiting" aria-hidden="true"></i></div>';
                        }

                        ?>

                        <td> <?php echo $status; ?></td>
                        <td> <?php echo $orchestrator->sdwan_link_status == "UP" ? '<div class="status"><i class="fa fa-arrow-up status_up" aria-hidden="true"></i></div>' : '<div class="status"><i class="fa fa-arrow-down status_down" aria-hidden="true"></i></div>'; ?></td>
                        <td> <?php echo $orchestrator->sdwan_link_status_up_count; ?></td>
                        <td> <?php echo $orchestrator->sdwan_link_status_last_up_timestamp; ?></td>
                        <td> <?php echo $orchestrator->data_transfer; ?></td>
                        <td> <?php echo $orchestrator->handshake; ?></td>
                        <td> <?php echo $orchestrator->updated; ?></td>
                        <td><span style="margin: 2%;">
                            <a style="color:#000 !important" href="<?php echo base_url('Gateway/softclient_config/' . $server_id . '/' . $serialnumber . '/' . $orchestrator->id) ?>">
                              <span class="fa fa-tasks"></span>
                            </a>
                          </span>
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
        <div class="row card">
          <div class="card-body col-12">

            <div class="row">

              <div class="col-lg-12">
                <div class="row">
                  <div class="col-lg-6">
                    <h5><b>Gateway ZTP - VLAN Settings</b></h5>
                  </div>
                  <div class="col-lg-6">
                    <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin')) {  ?>
                      <div class="col-lg-1 txt-end">
                        <div style="margin-bottom: 15px;"><a href="<?php echo base_url('Gateway/add_vlan' . '/' . $server_id . '/' . $serialnumber) ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                      </div>
                    <?php } ?>
                  </div>
                </div>


                <table id="vlan_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Details</th>
                      <th>VLAN-ID </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="contest_lst">
                    <?php foreach ($vlan_info as $info) { ?>
                      <tr>

                        <td>
                          <?php echo $info->id; ?>
                        </td>
                        <td>
                          <?php echo $info->details; ?>
                        </td>
                        <td>
                          <?php echo $info->vlan_id; ?>
                        </td>

                        <td>

                          <span class="fa_edit" style="margin: 2%;">
                            <a style="color:#000 !important" href="<?php echo base_url('Gateway/update_vlan/' . $info->id . '/' . $server_id . '/' . $serialnumber) ?>"><span class='fas fa-edit'></span></a>
                          </span>
                          <?php if ((($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin') || ($this->session->userdata('accesslevel') == 'customer'))) { ?>
                            <span class="fa_delete" style="margin: 2%;">
                              <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deleteid('<?php echo $info->id ?>')">
                                <span class="fa fa-trash"></span></span>
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
                    <button type="button" class="btn btn-block btn-primary btn-sm" fdprocessedid="qjv3e">Delete
                      Selected</button>
                  </div>

                </div>

              </div>
              <!-- /.card -->

            </div>
            <!-- /.row -->
          </div>
        </div>


        <!-- circuit table startes here -->


        <div class="row card" style="margin-top: 1%;">
          <div class="card-body col-12">

            <div class="row heading">
              <div class="col-lg-11">
                <div>
                  <h5><b>Circuit Summary</b></h5>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-lg-12">
                <table id="circuit_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Total Circuits</th>
                      <th>Link Status Up</th>
                      <th>Link Status Down</th>
                    </tr>
                  </thead>
                  <tbody class="contest_lst">

                    <?php
                    foreach ($circuit_summary as $info) { ?>
                      <tr>
                        <td>
                          <span class="badge bg-primary"><?php echo $info->total_circuits; ?></span>
                        </td>
                        <td>
                          <span class="badge bg-success"> <?php echo $info->up_count; ?></span>
                        </td>
                        <td>
                          <span class="badge bg-danger"> <?php echo $info->down_count; ?></span>
                        </td>

                      </tr>
                    <?php } ?>
                  </tbody>

                  </tfoot>
                </table>


              </div>
            </div>
          </div>
        </div>
        <!-- circuit table ends here -->
      </div>
      <div class="col-lg-1">
        <a href="<?php echo base_url('Gateway/index'); ?>">
          <input type="button" class="btn btn-block btn-success" value="Back">
        </a>
      </div>
      <!-- /.container-fluid -->
  </section>

  <!-- /.content -->
</div>

<script>
  function deleteid(id) {

    $.ajax({
      'url': '<?php echo base_url('Gateway/delete_vlan') ?>',
      'method': 'post',
      'data': {
        'vlan_id': id
      },
      'success': function(data) {
        window.location = '<?php echo base_url() . '/Gateway/gateway_network/' . $this->uri->segment('3') . '/' . $this->uri->segment('4') ?>';
      }
    })

  }
</script>
<script>
  $(function() {

    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#vlan_table").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    }).buttons().container().appendTo('#vlan_table_wrapper .col-md-6:eq(0)');

    $("#circuit_table").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    }).buttons().container().appendTo('#circuit_table_wrapper .col-md-6:eq(0)');


  });
</script>

</html>
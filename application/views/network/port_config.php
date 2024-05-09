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
              <h5><b>Port Config</b></h5>
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
                <div class="form-group">
                  <form action="<?php echo base_url('Network/update_info') ?>" method="post">
                    <?php foreach ($port_config_info as $info) { //echo "<pre>"; print_r($info); 
                    ?>


                      <div class="row lables">
                        <div class="col-lg-3">
                          Type
                        </div>
                        <div class="col-lg-3">
                          <?php echo $port_config . ' Port' ?>
                          <input type="hidden" class="form-control" value="<?php echo $info->id; ?>" name="id">
                          <input type="hidden" class="gateway_value" value="<?php echo $info->proto ?>">
                          <input type="hidden" name="port_config" value="<?php echo $port_config ?>">
                        </div>
                      </div>

                      <div class="row lables mrgn_top">
                        <div class="col-lg-3">
                          Port
                        </div>
                        <div class="col-lg-3">
                          <?php echo $info->port; ?>
                          <input type="hidden" class="form-control" name="port" value="<?php echo $info->port; ?>">
                        </div>
                      </div>
                      <div class="row lables mrgn_top">
                        <?php $mac_id = chop(shell_exec("ifconfig $info->port | grep -w ether | awk '{print $2}'")); ?>
                        <div class="col-lg-3">
                          MAC ID
                        </div>
                        <div class="col-lg-3">
                          <?php echo $mac_id; ?>
                        </div>
                      </div>
                      <div class="row lables mrgn_top">
                        <div class="col-lg-3">
                          Connection Type
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <select class="form-control select2 " id="proto_selector" style="width: 100%;" name="proto" onchange="proto()">
                              <option value="dhcp" <?php echo $info->proto == 'dhcp' ? 'selected' : '';  ?>>DHCP</option>
                              <option value="static" <?php echo $info->proto == 'static' ? 'selected' : '';  ?>>Static</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row lables mrgn_top">
                        <div class="col-lg-3">
                          IP Address
                        </div>
                        <?php
                        $ipaddr = $info->ipaddr;
                        $netmask = $info->netmask;
                        if ($info->proto == 'dhcp') {
                          $ipaddr = chop(shell_exec("ifconfig $info->port | grep -w inet | awk '{print $2}' | cut -d ':' -f 2"));
                          $netmask = chop(shell_exec("ifconfig $info->port | grep -w inet | awk '{print $4}' | cut -d ':' -f 2"));
                          if ($ipaddr == "") {
                            $ipaddr = "retrieving data ...";
                          }
                          if ($netmask == "") {
                            $netmask = "retrieving data ...";
                          }
                        }
                        if ($info->proto == 'dhcp') {
                          $readonly = 'readonly';
                        } else {
                          $readonly = '';
                        } ?>
                        <input type="hidden" class="ip_address_hidden_val" value="<?php echo $ipaddr; ?>">
                        <input type="hidden" class="netmask_hidden_val" value="<?php echo $netmask; ?>">
                        <div class="col-lg-3">
                          <?php //if($readonly == 'readonly'){ echo $ipaddr;} else {  
                          ?>
                          <input type="text" class="form-control ipaddr" name="ipaddr" value="<?php echo $ipaddr; ?>" placeholder="Enter ipaddr" <?= $readonly ?>>
                          <?php // } 
                          ?>

                        </div>
                      </div>

                      <div class="row lables mrgn_top">
                        <div class="col-lg-3">
                          Netmask
                        </div>
                        <div class="col-lg-3">
                          <?php // if($readonly == 'readonly'){ echo $netmask; } else {  
                          ?>
                          <input type="text" class="form-control netmask" name="netmask" placeholder="Enter netmask" value="<?php echo $netmask; ?>" <?= $readonly ?>>
                          <?php // } 
                          ?>

                        </div>
                      </div>

                      <div class="row lables mrgn_top parent_gateway">
                        <div class="col-lg-3">
                          Gateway
                        </div>
                        <div class="col-lg-3">
                          <?php //if($readonly == 'readonly'){ echo $info->gateway; } else {  
                          ?>
                          <input type="text" class="form-control gateway" name="gateway" placeholder="Enter gateway" value="<?php echo $info->gateway; ?>" <?= $readonly ?>>
                          <?php //} 
                          ?>

                        </div>
                      </div>

                      <div class="row lables mrgn_top">

                        <div class="col-lg-1">
                          <a>
                            <input type="submit" class="btn btn-block btn-success" value="Update">
                          </a>
                        </div>

                      </div>


                    <?php } ?>
                  </form>
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

    if ($('.gateway_value').val() == 'static') {
      $('.parent_gateway').show();
    } else {
      $('.parent_gateway').hide();
    }

    $('#proto_selector').change(function() {
      var proto = document.getElementById('proto_selector').value;
      if (proto == 'dhcp') {
        $('.ipaddr').attr('readonly', 'readonly');
        $('.netmask').attr('readonly', 'readonly');
        $('.gateway').attr('readonly', 'readonly');
        $('.parent_gateway').hide();
        var ip_address_hidden_val = $('.ip_address_hidden_val').val();
        var netmask_hidden_val = $('.netmask_hidden_val').val();
        if (ip_address_hidden_val == '') {
          $('.ipaddr').val(ip_address_hidden_val);
        }
        if (netmask_hidden_val == '') {
          $('.netmask').val(netmask_hidden_val);
        }
      } else if (proto == 'static') {
        $('.ipaddr').removeAttr('readonly');
        $('.netmask').removeAttr('readonly');
        $('.gateway').removeAttr('readonly');
        $('.ipaddr').val('0.0.0.0');
        $('.netmask').val('0.0.0.0');
        $('.gateway').val('0.0.0.0');
        $('.parent_gateway').show();
      }
    })

  })
</script>



<!-- <script>
$(function() {

   var dataTable = $('#users_table').DataTable();


});
</script> -->

</html>
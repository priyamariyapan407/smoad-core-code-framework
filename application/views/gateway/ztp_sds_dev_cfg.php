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
          <div class="col-lg-9">
            <?php foreach ($vlan_info['device_info'] as $info) { ?>
              <div>
                <h5><b>Gateway ZTP - Device Settings - <?= $info->serialnumber ?> - <?= $info->details ?> ...</b></h5>
              </div>
            <?php }
            if ($this->session->flashdata('error_msgs')) { ?>
              <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                <?= $this->session->flashdata('error_msgs'); ?>
              </div>
            <?php } ?>

            <?php if ($this->session->flashdata('success_msg')) { ?>
              <div class='col-lg-6 bg-success-msg' role="alert">
                <?= $this->session->flashdata('success_msg'); ?>
              </div>
            <?php } ?>
          </div>
          <div class="col-lg-2">


          </div>
        </div>


        <form action="<?php echo base_url('Gateway/save_ztp_sds_dev_cfg/' . $conf_id) ?>" method="post">

          <div class="form-group">
            <?php foreach ($vlan_info['device_info_with_sdwan_id'] as $info) {
              $id                  = $info->id;
              $vlan_id             = $info->vlan_id;
              $sdwan_enable        = $info->sdwan_enable;
              $device_serialnumber = $info->serialnumber;
              if ($sdwan_enable == 'TRUE') {
                $disabled = 'disabled';
                $checked                             = "checked";
              } else {
                $disabled = '';
                $checked                              = "";
              }
              if ($vlan_id == 0) {
                $selected = "selected";
              } else {
                $selected = "";
              }
            ?>

              <?php
              $G_sds_type = '';
              foreach ($vlan_info['sdwan_server_info'] as $server_info) {
                $G_sds_type = $server_info->type;
              }
              if ($G_sds_type != "l3_stand_alone" || $G_sds_type == "l3_dc") { ?>
                <div class="row lables">
                  <div class="col-lg-3">
                    VLAN-ID
                  </div>

                  <div class="col-lg-3">
                    <input type="hidden" name="vlan_id_before" value="<?php echo $vlan_id; ?>">
                    <input type="hidden" name="sdwan_enable_before" value="<?php echo $sdwan_enable; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="device_serialnumber" value="<?php echo $device_serialnumber; ?>">
                    <input type="hidden" name="gateway_sno" value="<?php echo $gateway_sno; ?>">

                    <select class="form-control select2 table_menus select" <?= $disabled ?> style="width: 100%;" name="vlan_id">
                      <option value="0" <?= $selected ?>>Disable</option>
                      <?php foreach ($vlan_info['vlan_info'] as $inf) {

                        $vlan_details2 = $inf->details;
                        $vlan_id2      = $inf->vlan_id;
                        if ($vlan_id == $vlan_id2) {
                          $selected = "selected";
                        } else {
                          $selected = "";
                        } ?>
                        <option value="<?= $vlan_id2 ?>" <?= $selected ?>><?= $vlan_id2 . ' - ' . $vlan_details2 ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              <?php }
              if ($G_sds_type == "l2") {
                //dont allow enable button if this is a vlan based sdwan server !
                if ($vlan_id == 0) {
                  $disabled = 'disabled';
                } else {
                  $disabled = '';
                }
              } ?>
              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Enable
                </div>
                <div class="col-lg-3">
                  <input type="checkbox" name="sdwan_enable" <?php echo $checked . ' ' . $disabled; ?>>
                </div>
              </div>


              <div class="row lables mrgn_top">
                <?php if (($this->session->userdata('accesslevel') == 'root') || ($this->session->userdata('accesslevel') == 'admin') || ($this->session->userdata('accesslevel') == 'customer')) { ?>
                  <div class="col-lg-1">
                    <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                  </div>
                <?php } ?>
                <div class="col-lg-1">
                  <a href="<?php echo base_url('Gateway/gateway_devices/' . $conf_id . '/' . $gateway_sno . '/gateway') ?>">
                    <input type="button" class="btn btn-block btn-success" value="Back">
                  </a>
                </div>

              </div>

            <?php } ?>
          </div>

        </form>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


</html>
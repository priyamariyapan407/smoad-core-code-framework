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
            <div>
              <h5><b>Edit Customer</b></h5>
            </div>
            <?php if ($this->session->flashdata('error_msgs')) { ?>
              <div class='alert_msg alert_msg-danger error_msg' role="alert">
                <?= $this->session->flashdata('error_msgs'); ?> </div>
            <?php } ?>
          </div>
          <div class="col-lg-2">


          </div>
        </div>


        <form action="<?php echo base_url('Gateway/save_edited_vlan_info/' . $sdwan_id . '/' . $sdwan_serial_number) ?>" method="post">

          <div class="form-group">
            <?php foreach ($vlan_info as $info) { ?>


              <div class="row lables">
                <div class="col-lg-3">
                  details
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" value="<?php echo $info->details; ?>" name="details" placeholder="Enter Details">
                  <input type="hidden" class="form-control" value="<?php echo $info->id; ?>" name="id">
                </div>
              </div>

              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  vlan_id
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="vlan_id" value="<?php echo $info->vlan_id; ?>" placeholder="Enter vlan_id">
                </div>
              </div>


              <div class="row lables mrgn_top">

                <div class="col-lg-1">
                  <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                </div>
                <div class="col-lg-1">
                  <a href="<?php echo base_url('Gateway/gateway_network/' . $sdwan_id . '/' . $sdwan_serial_number) ?>">
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
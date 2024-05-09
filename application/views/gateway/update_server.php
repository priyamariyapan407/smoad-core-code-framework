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
            <?php foreach ($server_info as $info) { ?>
              <div>
                <h5><b>Gateway ZTP - Home - <?= $info->serialnumber ?> - <?= $info->details ?> ...</b></h5>
              </div>
            <?php }
            if ($this->session->flashdata('error_msgs')) { ?>
              <div class='alert_msg alert_msg-danger error_msg' role="alert">
                <?= $this->session->flashdata('error_msgs'); ?> </div>
            <?php } ?>
          </div>
          <div class="col-lg-2">


          </div>
        </div>


        <form action="<?php echo base_url('Gateway/save_edited_info') ?>" method="post">

          <div class="form-group">
            <?php foreach ($server_info as $info) {

              $type = $info->type;
              if ($type == "l2") {
                $_type = "L2 SD-WAN";
              } else if ($type == "l3") {
                $_type = "L3 SD-WAN";
              } else if ($type == "mptcp") {
                $_type = "MPTCP";
              }

            ?>


              <div class="row lables">
                <div class="col-lg-3">
                  Details
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" value="<?php echo $info->details; ?>" name="details" placeholder="Enter details">
                  <input type="hidden" class="form-control" value="<?php echo $info->id; ?>" name="id">
                </div>
              </div>

              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  License
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="license" value="<?php echo $info->license; ?>" placeholder="Enter license">
                </div>
              </div>
              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Serialnumber
                </div>
                <div class="col-lg-3">
                  <?php echo $info->serialnumber; ?>
                </div>
              </div>
              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Ip Address
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="ipaddr" value="<?php echo $info->ipaddr; ?>" placeholder="Enter ip Address">
                </div>
              </div>


              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Area
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="area" placeholder="Enter area" value="<?php echo $info->area; ?>">
                </div>
              </div>
              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Mtu
                </div>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="mtu" placeholder="Enter mtu">
                </div>
              </div>

              <div class="row lables mrgn_top">
                <div class="col-lg-3">
                  Type
                </div>
                <div class="col-lg-3">
                  <?php echo $_type; ?>
                </div>
              </div>

              <div class="row lables mrgn_top">

                <div class="col-lg-1">
                  <input type="submit" class="btn btn-block btn-success" value="Update"></button>
                </div>
                <div class="col-lg-1">
                  <a href="<?php echo base_url('Gateway/index') ?>">
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
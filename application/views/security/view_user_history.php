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
              <h5><b>SMOAD User Device Access Log</b></h5>
            </div>
          </div>

        </div>
        <div class="row card">
          <div class="card-body col-12">

            <div class="row">

              <div class="col-lg-12">

                <table id="log_table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Device Serial Number</th>
                      <th>Auth Status</th>
                      <th>Access Type</th>
                      <th>Timestamp</th>
                    </tr>
                  </thead>
                  <tbody class="contest_lst">
                    <?php foreach ($user_history as $history) { ?>
                      <tr>
                        <td> <?php echo $history->id ?> </td>
                        <td> <?php echo $history->device_serialnumber ?></td>
                        <td> <?php echo $history->auth_status ?></td>
                        <td> <?php echo $history->access_type ?></td>
                        <td> <?php echo $history->access_timestamp ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>

                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row lables mrgn_top">

          <div class="col-lg-1">
            <a href="<?php echo base_url('User/index') ?>"><input type="button" class="btn btn-block btn-success" value="Back"></a>
          </div>
        </div>
      </div>


      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>



<script>
  $(function() {
    var dataTable = $('#log_table').DataTable({
      "lengthMenu": [
        [20, 50],
        [20, 50]
      ]
    });
  })
</script>

</html>
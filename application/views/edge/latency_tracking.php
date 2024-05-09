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
                    <div class="col-lg-12">
                        <div>
                            <h5><b>EDGE SD-WAN Latency Tracking (past 1 hour)</b></h5>
                        </div>
                    

                    </div>

                </div>


                <div class="row card">
                    <div class="card-body col-12">

                    <div class="row">
      <div class="col-lg-12">


        
          <!-- /.card-header -->
          <div class="card-body">
            <table id="sd_wan_latency" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Details</th>
                  <th>Serial Number</th>
                  <th>Model</th>
                  <th>Area</th>
                  <th>Latency</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($latency as $summary) { ?>
                  <tr>
                    <td>
                      <?php echo $summary['id']; ?>
                    </td>
                    <td>
                      <?php echo $summary['details']; ?>
                    </td>
                    <td>
                      <?php echo $summary['serialnumber']; ?>
                    </td>
                    <td>
                      <?php echo $summary['model']; ?>
                    </td>
                    <td>
                      <?php echo $summary['area']; ?>
                    </td>
                    <td>
                      <?php echo $summary['latency'] . ' ms'; ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
              <!-- <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Details</th>
                      <th>Serial Number</th>
                      <th>Model</th>
                      <th>Area</th>
                      <th>Latency</th>
                    </tr>
                  </tfoot> -->
            </table>
          </div>
          <!-- /.card-body -->
        </div>

      </div>
   
    </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
      
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



<script>
    $(function() {

        var dataTable = $('#sd_wan_latency').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });


    });
</script>

</html>
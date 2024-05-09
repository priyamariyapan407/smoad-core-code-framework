<!DOCTYPE html>
<html lang="en">
<?php $path = APPPATH . 'views/header.php';
include("$path"); ?>
<?php $path = APPPATH . 'views/sidebar.php';
include("$path");  $login_type = $this->session->userdata('accesslevel');?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="edge_device">
            <div class="row heading">
                    <div class="col-lg-11">
                        <div>
                            <h5><b>Circuit summary</b></h5>
                        </div>
                    </div>
            </div>
        <div class="row">
        <div class="col-lg-12">
        <?php if ($login_type == 'root' || $login_type == 'admin' || $login_type == 'limited') { ?>
          
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Gateway</th>
                    <th>Total Circuits</th>
                    <th>Link Status Up</th>
                    <th>Link Status Down</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($circuit_summary as $circuit) { ?>
                    <tr>
                      <td>
                        <?php echo $circuit['details'] ? $circuit['details'] : '0' ?>
                      </td>
                      <td>
                        <span class="badge badge_size bg-primary">
                          <?php echo $circuit['total_cnt'] ? $circuit['total_cnt'] : '0' ?>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge_size bg-success">
                          <?php echo $circuit['up_count'] ? $circuit['up_count'] : '0' ?>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge_size bg-danger">
                          <?php echo $circuit['down_count'] ? $circuit['down_count'] : '0' ?>
                        </span>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
                <!-- <tfoot>
                    <tr>
                      <th>Gateway</th>
                      <th>Total Circuits</th>
                      <th>Link Status Up</th>
                      <th>Link Status Down</th>
                    </tr>
                  </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        <?php } ?>
      </div>
        </div>
                <!-- /.row -->
           
           </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



<script>
    function deleteid(id) {

        $.ajax({
            'url': '<?php echo base_url('Gateway/delete_server') ?>',
            'method': 'post',
            'data': {
                'server_id': id
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/Gateway' ?>';
            }
        })

    }
</script>



<script>
    $(function() {
        $('#example1').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
    });
</script>

</html>
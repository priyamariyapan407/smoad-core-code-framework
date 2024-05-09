<!DOCTYPE html>
<html lang="en">
<?php $path = APPPATH . 'views/header.php';
include("$path"); ?>

<?php $path = APPPATH . 'views/sidebar.php';
include("$path"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="edge_device">
            <div class="container-fluid">
                <h5 class="mb-2">Info Box</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/status/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')) ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Status</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/ztp_dev_lan/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')); ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">LAN</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/port_status/' . $this->uri->segment('4') . '/' . $this->uri->segment('3') . '/wan/config'); ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">WAN1</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/port_status/' . $this->uri->segment('4') . '/' . $this->uri->segment('3') . '/wan2/config'); ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">WAN2</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>


                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/ztp_dev_wireless/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')) ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Wireless</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="<?php echo base_url('Edge/ztp_dev_sdwan/' . $this->uri->segment('3') . '/' . $this->uri->segment('4')) ?>">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">SD-WAN</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Qos</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </section>
</div>

<!-- /.content -->



<script>
    $(function() {
        $('#unassigned_devices_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
        $('#assigned_devices_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });
    });
</script>

</html>
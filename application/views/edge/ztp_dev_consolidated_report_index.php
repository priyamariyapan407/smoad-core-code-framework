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

            <div class="row heading">
                <div class="col-lg-12">
                    <h5><b>Edge ZTP - <span class="log_name"> Consolidated Report </span> -
                            <?php echo $sno . ' - ';
                            foreach ($device_info as $info) {
                                echo $info->details;
                            } ?>
                        </b></h5>
                </div>
            </div>

            <div class="row card">
                <div class="card-body col-12">

                    <div class="row">

                        <div class="col-lg-12">
                            <div>

                                <!-- /.card-header -->
                                <div>
                                    <table id="example1" class="table table-bordered table-hover">

                                        <?php

                                        for ($i = 0; $i < count($year_month_info); $i++) {
                                            echo "<tr><td>";
                                            echo $year_month_info[$i]['year'];
                                            echo "</td>";
                                            for ($j = 0; $j < count($year_month_info[$i]['months']); $j++) {
                                                if ($year_month_info[$i]['months'][$j]['enable_link'] == 'true') {
                                                    $datecurrent = $year_month_info[$i]['year'] . "-" . $year_month_info[$i]['months'][$j]['month'] . "-01";
                                        ?>
                                                    <td> <a href="<?php echo base_url('Edge/content_ztp_dev_fpdf_generation/' . $sno . '/' . $datecurrent) ?>" target="_blank">
                                                            <?php echo $year_month_info[$i]['months'][$j]['name']; ?>
                                                        </a> </td>
                                        <?php
                                                } else {
                                                    echo "<td> - </td>";
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                        ?>

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


</div>

</html>
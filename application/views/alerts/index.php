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
                        <h4><b>Alerts - Index </b></h4>

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

                                            for ($i = 1; $i <= count($year_month); $i++) {
                                                echo "<tr><td>";
                                                echo $year_month[$i]['year'];
                                                echo "</td>";
                                                for ($j = 1; $j < count($year_month[$i]['months']); $j++) {
                                                    echo "<td>";
                                                    $datecurrent = $year_month[$i]['year'] . "-" . $year_month[$i]['months'][$j] . "-01";
                                            ?>
                                                    <a href="<?php echo base_url('Alerts/get_month_vice_alert_lst/' . $datecurrent) ?>">
                                                        <?php echo $year_month[$i]['months'][$j] ?>
                                                    </a>
                                            <?php
                                                    echo "</td>";
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






    </html>
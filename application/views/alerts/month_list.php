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
                    <h4><b>Alerts</b></h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <!-- /.form-group -->
                    <div class="form-group">
                        <select class="form-control select2 table_menus" style="width: 100%;">
                            <option value="historical_log" selected="selected">Historical Log</option>
                            <option value="user_login">User Login</option>
                            <option value="edge">Edge</option>
                            <option value="gw">Gateway</option>
                            <option value="fw">Security</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="row card">
                <div class="card-body col-12">

                    <div class="row">

                        <div class="col-lg-12">
                            <div>
                                <?php $this->session->set_userdata('date_info', $this->uri->segment('3')); ?>
                                <!-- /.card-header -->
                                <div>
                                    <table id="example1" class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="check-all"></th>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Title</th>
                                                <th>Timestamp</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                            foreach ($alert_list as $list) {

                                                if ($list->status == 'new') {
                                                    $bg_color = 'red';
                                                } else {
                                                    $bg_color = 'gray';
                                                }

                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" class="row-checkbox"></td>
                                                    <td>
                                                        <?php echo $list->id; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list->status; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list->title; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list->log_timestamp; ?>
                                                    </td>

                                                    <td>
                                                        <div align="center">
                                                            <a href="<?php echo base_url("Alerts/alert_details/" . $list->id) ?>">
                                                                <i class="far fa-file-alt" style="font-size:24px">&#xf233;</i>
                                                            </a>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <div align="center">
                                                            <i onclick="change_status('<?php echo $list->id ?>','<?php echo $list->status; ?>')" class="fa fa-close" style="font-size:24px;cursor:pointer;color:<?php echo $bg_color; ?>"></i>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div align="center">
                                                            <i onclick="deleteid(<?php echo $list->id; ?>)" class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;cursor:pointer;"></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>

                                    <div class="col-lg-2">
                                        <div id="delete-selected">
                                            <button type="button" class="btn btn-block btn-primary btn-sm" fdprocessedid="qjv3e">Delete Selected</button>
                                        </div>
                                    </div>

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


<script>
    function deleteid(id) {
        $.ajax({
            url: '<?php echo base_url() . '/Alerts/delete_single_list' ?>',
            method: 'post',
            data: {
                'alert_id': id
            },
            success: function(data) {
                console.log(data);
                window.location = '<?php echo base_url() . '/Alerts/get_month_vice_alert_lst/' . $this->session->userdata('date_info'); ?>';
            }
        })
    }

    function change_status(id, status) {
        console.log(id, status);
        $.ajax({
            url: '<?php echo base_url() . '/Alerts/change_status' ?>',
            method: 'post',
            data: {
                'alert_id': id,
                'status': status
            },
            success: function(data) {
                console.log(data);
                window.location = '<?php echo base_url() . '/Alerts/get_month_vice_alert_lst/' . $this->session->userdata('date_info'); ?>';
            }
        })
    }
</script>

<script>
    $(function() {

        var dataTable = $('#example1').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });

        // Check/uncheck all checkboxes when the "Check All" checkbox is clicked
        $('#check-all').on('change', function() {
            $('.row-checkbox').prop('checked', this.checked);
            $('#delete-selected').show();
        });

        // Handle individual row checkbox changes
        $('.row-checkbox').on('change', function() {
            if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                $('#delete-selected').show();
                $('#check-all').prop('checked', true);
            } else {
                $('#delete-selected').show();
                $('#check-all').prop('checked', false);
            }
        });

        // Handle the delete selected button click
        $('#delete-selected').on('click', function() {
            var selectedIds = $('.row-checkbox:checked').map(function() {
                return $(this).closest('tr').find('td:eq(1)').text(); // Assuming ID is in the second column
            }).get();

            $.ajax({
                url: '<?php echo base_url() . '/Alerts/delete_list' ?>',
                method: 'post',
                data: {
                    'alert_ids': selectedIds
                },
                success: function(data) {
                    console.log(data);
                    window.location = '<?php echo base_url() . '/Alerts/get_month_vice_alert_lst/' . $this->session->userdata('date_info'); ?>';
                }
            })
            dataTable.rows('.selected').remove().draw(false);
        });

        $('.table_menus').change(function() {
            var menu_type = $(this).val();
            $.ajax({
                url: '<?php echo base_url() . '/Alerts/get_menu_details' ?>',
                method: 'post',
                data: {
                    'menu_type': menu_type
                },
                success: function(data) {
                    if (data == 'redirect to current page') {
                        window.location = '<?php echo base_url() . '/Alerts/get_month_vice_alert_lst/' . $this->session->userdata('date_info'); ?>';
                    } else {
                        $('.list').html(data);
                    }

                }

            })
        })


    });
</script>
<!-- Script -->
</div>

</html>
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
                    <div class="col-lg-11">
                        <div>
                            <h5><b>Smoad Users</b></h5>
                        </div>
                    </div>
                    <div class="col-lg-1 txt-end">
                        <div><a href="<?php echo base_url('User/add_user') ?>"><input type="button" class="btn btn-block btn-success" value="Add"></a></div>
                    </div>
                </div>

                <?php if ($this->session->flashdata('error_msgs')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('error_msgs'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_failure')) { ?>
                    <div class='col-lg-6 alert_msg alert_msg-danger error_msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_failure'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('success_msg')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('success_msg'); ?> </div>
                <?php } ?>

                <?php if ($this->session->flashdata('delete_msg_success')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('delete_msg_success'); ?> </div>
                <?php } ?>
                <?php if ($this->session->flashdata('update_msgs')) { ?>
                    <div class='col-lg-6 bg-success-msg' role="alert">
                        <?= $this->session->flashdata('update_msgs'); ?> </div>
                <?php } ?>

                <div class="row card">
                    <div class="card-body col-12">

                        <div class="row">

                            <div class="col-lg-12">
                                <div>

                                    <!-- /.card-header -->
                                    <div>
                                        <table id="users_table" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Area</th>
                                                    <th>Access</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="contest_lst">
                                                <?php foreach ($users as $user) { ?>
                                                    <tr>

                                                        <td> <?php echo $user->id ?> </td>
                                                        <td> <?php echo $user->name ?></td>
                                                        <td> <?php echo $user->username ?></td>
                                                        <td> <?php echo $user->area ?></td>
                                                        <td> <?php echo $user->access_level ?></td>
                                                        <td>

                                                            <span class="fa_edit" style="margin: 2%;">
                                                                <a style="color:#000 !important" href="<?php echo base_url('User/update_user/' . $user->id) ?>"><span class='fas fa-edit'></span></a>
                                                            </span>
                                                            <?php if ($user->access_level != 'root') { ?>
                                                                <span class="fa_delete" style="margin: 2%;">
                                                                    <span style="cursor:pointer;" data-bs-toggle="modal" onclick="deleteid('<?php echo  $user->id ?>')">
                                                                        <span class="fa fa-trash"></span></span>
                                                                </span>
                                                            <?php } ?>
                                                            <span style="margin: 2%;">
                                                                <a style="color:#000 !important" href="<?php echo base_url('User/view_history/' . $user->id) ?>"><span class='fas fa-history'></span></a>
                                                            </span>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                            </tfoot>
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



<script>
    function deleteid(id) {

        $.ajax({
            'url': '<?php echo base_url('User/delete_user') ?>',
            'method': 'post',
            'data': {
                'user_id': id
            },
            'success': function(data) {
                window.location = '<?php echo base_url() . '/User' ?>';
            }
        })

    }
</script>



<script>
    $(function() {

        var dataTable = $('#users_table').DataTable({
            "lengthMenu": [
                [20, 50],
                [20, 50]
            ]
        });


    });
</script>

</html>
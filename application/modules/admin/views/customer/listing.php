<!doctype html>
<html class="no-js " lang="en">

<head>
    <!-- Title -->
    <?php $data['title'] = 'Customer'; ?>

    <!-- Style CSS -->
    <?php $this->load->view("common/stylesheet", $data); ?>

</head>

<body class="<?php echo THEME_COLOR; ?>">

    <!-- Page Loader -->
    <?php $this->load->view("common/page_loader"); ?>

    <!-- Top-bar -->
    <?php $this->load->view("common/top_bar"); ?>

    <!-- Left Sidebar -->
    <?php $this->load->view("common/left_menu"); ?>

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 class="fadeInDown animated">Customer </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/dashboard"><i class="zmdi zmdi-home"></i> Dashboard </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a>Customer</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- View -->
        <div class="container-fluid fadeInUp animated">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <!-- Table -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="body">

                                    <?php if ($this->session->flashdata('success_msg')) { ?>
                                        <div class="alert alert-success alert-dismissable zoomIn animated">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button" style="color: red;">×</button><?php echo $this->session->flashdata('success_msg') ?><a class="alert-link" href="#"></a>.
                                        </div>
                                        <?php unset($_SESSION['success_msg']); ?>
                                    <?php } ?>

                                    <?php if ($this->session->flashdata('error_msg')) { ?>
                                        <div class="alert alert-danger alert-dismissable zoomIn animated">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><?php echo $this->session->flashdata('error_msg') ?><a class="alert-link" href="#"></a>.
                                        </div>
                                        <?php unset($_SESSION['error_msg']); ?>
                                    <?php } ?>

                                    <div class="table-responsive">

                                        <!-- Filter Process -->
                                        <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true" style="margin: 15px 15px 0 15px;">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" role="tab" id="headingOne_1">
                                                    <h4 class="panel-title" style="margin-bottom: 5px;">
                                                        <a role="button" style="color:var(--app1); font-weight:bold;" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1"> Filter </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                                    <div class="panel-body" style="padding:0px 20px !important;">

                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <label>Login Status</label>
                                                                <select class="form-control select2" name="user_login_status" onchange="set_session(this.value,'login_status')" ; id="user_login_status" value="<?php echo (!empty($this->session->userdata('customerloginstatus'))) ? $this->session->userdata('customerloginstatus') : ''; ?>">
                                                                    <option value="">Select Login Status</option>
                                                                    <option value="Online" <?php echo ($this->session->userdata('customerloginstatus') == "Online") ? 'selected' : ''; ?>>Online</option>
                                                                    <option value="Offline" <?php echo ($this->session->userdata('customerloginstatus') == "Offline") ? 'selected' : ''; ?>>Offline</option>

                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label>Status</label>
                                                                <select class="form-control select2" name="user_status" onchange="set_session(this.value,'customer_status')" ; id="user_status" value="<?php echo (!empty($this->session->userdata('customeractivestatus'))) ? $this->session->userdata('customeractivestatus') : ''; ?>">
                                                                    <option value="">Select Status</option>
                                                                    <option value="1" <?php echo ($this->session->userdata('customeractivestatus') == "1") ? 'selected' : ''; ?>>Unblocked</option>
                                                                    <option value="0" <?php echo ($this->session->userdata('customeractivestatus') == "0") ? 'selected' : ''; ?>>Blocked</option>

                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">

                                                                <label>Date Range</label>
                                                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 9px 10px; border: 1px solid #ccc; width: 100%">
                                                                    <i class="zmdi zmdi-calendar"></i>&nbsp;
                                                                    <b><span> <?php echo (!empty(($this->session->userdata('customerregisterstart_date'))) ? $this->common_model->dateConvertToTimezone($this->session->userdata('customerregisterstart_date'), 'F d, Y', $this->session->userdata(ADMIN_TIMEZONE)) . ' - ' . $this->common_model->dateConvertToTimezone($this->session->userdata('customerregisterend_date'), 'F d, Y', $this->session->userdata(ADMIN_TIMEZONE)) : 'Choose Time..') ?> </span></b> <i class="zmdi zmdi-caret-down float-right"></i>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <!-- Button -->
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-inline" style="margin-bottom: 16px;">
                                                                    <a href="<?php echo site_url(); ?>admin/customer/reset" class="btn btn-warning waves-effect btn-file m-t-20">
                                                                        <i class="zmdi zmdi-replay"></i> <span><b>Reset</b></span>
                                                                    </a> &nbsp;&nbsp;
                                                                    <a role="button" class="btn btn-danger waves-effect btn-file m-t-20" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                                                        <i class="zmdi zmdi-close-circle"></i> <span><b>Close</b></span>
                                                                    </a> &nbsp;&nbsp;

                                                                    <a href="<?php echo site_url(); ?>admin/customer/export" class="btn btn-success waves-effect btn-file m-t-20">
                                                                        <i class="zmdi zmdi-download"></i> <span><b>Export</b></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                        <table class="table table-bordered dataTable js-exportable text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">
                                                        <button type="button" id="select-all" value="0" class="select_all">Select all</button>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Customer ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Login Status</th>
                                                    <th>Registration Date</th>
                                                    <th>Status</th>
                                                    <th style="width: 100px">Local Resident Status</th>
                                                    <th style="width: 57px">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('common/footer'); ?>

    </section>

    <!-- JQuery Core JS -->
    <?php $this->load->view("common/script"); ?>

    <script type="text/javascript">
        // Fatch Data 
        var table = $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            // autoWidth: false,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100, 500, -1],
                ['10 rows', '25 rows', '50 rows', '100 rows', '500 rows', 'Show all']
            ],
            iDisplayLength: 10, //stateSave: true,
            "fnDrawCallback": function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: true,
                    fixedContentPos: true,
                    image: {
                        verticalFit: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300
                    },
                });
            },
            ajax: {
                url: SITE_URL + "admin/customer/ajax_list",
                type: 'POST',
                data: function(data) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    return {
                        data: data,
                        [csrfName]: csrfHash // CSRF Token
                    };
                },
                dataSrc: function(data) {

                    // Update token hash
                    $('.txt_csrfname').val(data.token);

                    // Datatable data
                    return data.data;
                    // console.log('Error - ' + errorMessage);
                },
            },
            buttons: [{
                    extend: 'colvis',
                    text: '<i class="zmdi zmdi-format-list-bulleted"></i>',
                    className: 'btn-mute',
                },
                {
                    extend: 'pageLength',
                    className: 'btn-mute'
                },
                {
                    text: 'Actions',
                    className: 'btn-mute action_button van',
                    init: function(api, node, config) {
                        // Create the dropdown menu
                        var dropdown = $('<div class="dropdown-menu" id="action_drop_down" aria-expanded="true" aria-labelledby="dropdownMenuButton" ></div>');
                        // Add items to the dropdown
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`active`);"  class="activerow" id="activerow"><i class="material-icons">visibility</i> Unblocked</a></li>');
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`inactive`);"  class="inactiverow" id="inactiverow"><i class="material-icons">visibility_off</i> Blocked</a></li>');
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`remove`);"  class="deleterow" id="deleterow"><i class="material-icons">delete_forever</i> Delete</a></li>');
                        // Attach the dropdown to the button
                        $(node).append(dropdown);
                    },
                    action: function(e, dt, node, config) {
                        // Toggle the dropdown when the button is clicked
                        $(node).find('.dropdown-menu').toggle();
                    }
                }
            ],
            columns: [{
                    "data": "check_box",
                    "orderable": false
                }, {
                    "data": "id",
                    "orderable": true
                },
                {
                    "data": "unique_id",
                    "orderable": false
                },
                {
                    "data": "name",
                    "orderable": false
                },
                {
                    "data": "email",
                    "orderable": false
                },
                {
                    "data": "contact_number",
                    "orderable": false
                },
                {
                    "data": "login_status",
                    "orderable": false
                },
                {
                    "data": "insert_datetime",
                    "orderable": false
                },
                {
                    "data": "status",
                    "orderable": false
                },
                {
                    "data": "change_order_status",
                    "orderable": false
                },
                {
                    "data": "action",
                    "orderable": false
                }
            ]
        }).on('draw.dt', function() {
            $('.action_button').addClass('disabled');
            $('#select-all').text('Select all')
            $('#action_drop_down').css('display', 'none')
        });


        //For Listing Pagination
        $('#pagination').change(function() {
            table.page.len(this.value).draw();
        });

        /*
         ** Function for Searching
         */
        table.columns().every(function() {
            var table = this;
            $('input', this.header()).on('keyup change', function() {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
        });

        /*
         ** Function for blocked or unblocked
         */
        $(document).on('click', '.changeBlocked', function() {

            let user_id = $(this).data('id');
            let status = $(this).data('status');
            // alert(id)
            // alert(status)
            if (status == '0') {
                swal({
                    title: "Block Reason!",
                    text: "Why Do You Want It To Be Blocked?",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something"
                }, function(inputValue) {

                    if (inputValue == '') {
                        swal.showInputError("You need to write something!");
                        return false;
                    }

                    if (inputValue) {
                        $.ajax({
                            url: SITE_URL + "admin/user/change_state/" + user_id + "/" + status,
                            type: "GET",
                            data: {
                                'input_val': inputValue
                            },
                            dataType: 'json',
                            success: function(data) {
                                swal('Done!', data.message, "success");
                                table.ajax.reload(null, false); // paging is not reset on reload
                            },
                            error: function(jqXHR, textStatus, errorThrown) {},
                            complete: function() {}
                        }); // END OF AJAX CALL
                    }
                });
            } else {
                swal({
                    title: "Are you sure?",
                    text: (status == '1') ? "You want to unblock!" : "You want to block!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "<?php echo APP_COLOR ?>",
                    confirmButtonText: "Confirm",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: SITE_URL + "admin/user/change_state/" + user_id + "/" + status,
                            type: "GET",
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Done!',
                                    text: data.message
                                });
                                table.ajax.reload(null, false); // paging is not reset on reload
                            },
                            error: function(jqXHR, textStatus, errorThrown) {},
                            complete: function() {}
                        }); // END OF AJAX CALL
                    }
                });
            }
        });

        $(document).on('click', '.changeRequestStatus', function() {

            let id = $(this).data('id');
            let status = $(this).data('status');

            if (status == 'Revoke') {
                swal({
                    title: "Revoke Reason!",
                    text: "Why do you want it revoked?",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something"
                }, function(inputValue) {
                    if (inputValue == '') {
                        swal.showInputError("You need to write something!");
                        return false;
                    }
                    if (inputValue) {
                        $.ajax({
                            url: SITE_URL + "admin/customer/request_status/" + id + "/" + status,
                            type: "GET",
                            data: {
                                'input_val': inputValue
                            },
                            success: function(data) {
                                table.ajax.reload(null, false);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {},
                            complete: function() {}
                        }); // END OF AJAX CALL
                    }
                    swal("Success!", "Local authority request has been revoked successfully.!", "success");
                });
            }

            if (status == 'Reject') {
                swal({
                    title: "Reject Reason!",
                    text: "Why do you want it to be rejected?",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something"
                }, function(inputValue) {
                    if (inputValue == '') {
                        swal.showInputError("You need to write something!");
                        return false;
                    }
                    if (inputValue) {
                        $.ajax({
                            url: SITE_URL + "admin/customer/request_status/" + id + "/" + status,
                            type: "GET",
                            data: {
                                'input_val': inputValue
                            },
                            dataType: 'json',
                            success: function(data) {
                                table.ajax.reload(null, false);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {},
                            complete: function() {}
                        }); // END OF AJAX CALL
                    }
                    swal("Success!", "Local authority request has been rejected successfully.!", "success");
                });
            }

            if (status == 'Approve') {
                swal({
                    title: "Are you sure?",
                    text: "You want to " + status + "!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "<?php echo APP_COLOR ?>",
                    confirmButtonText: "Confirm",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: SITE_URL + "admin/customer/request_status/" + id + "/" + status,
                            type: "GET",
                            dataType: 'json',
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Done!',
                                    text: data.message
                                });
                                table.ajax.reload(null, false);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {},
                            complete: function() {}
                        }); // END OF AJAX CALL
                    }
                });
            }
        });

        // $(document).on('click', '.changeRequestStatus', function() {
        //     let id = $(this).data('id');
        //     let status = $(this).data('status');

        //     function showDialog(title, text, successText, successMessage, url) {
        //         swal({
        //             title: title,
        //             text: text,
        //             type: "input",
        //             showCancelButton: true,
        //             closeOnConfirm: false,
        //             animation: "slide-from-top",
        //             inputPlaceholder: "Write something"
        //         }, function(inputValue) {
        //             if (inputValue == '') {
        //                 swal.showInputError("You need to write something!");
        //                 return false;
        //             }
        //             if (inputValue) {
        //                 $.ajax({
        //                     url: url,
        //                     type: "GET",
        //                     data: {
        //                         'input_val': inputValue
        //                     },
        //                     dataType: 'json',
        //                     success: function(data) {
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Done!',
        //                             text: data.message
        //                         });
        //                         table.ajax.reload(null, false);
        //                     }
        //                 });
        //             }
        //         });
        //     }

        //     if (status == 'Revoke') {
        //         showDialog("Revoke Reason!", "Why do you want it revoked?", "Success!", "Revoked was cancelled successfully.",
        //             SITE_URL + "admin/customer/request_status/" + id + "/" + status);
        //     }

        //     if (status == 'Reject') {
        //         showDialog("Reject Reason!", "Why do you want it to be rejected?", "Success!", "Order was cancelled successfully.",
        //             SITE_URL + "admin/customer/request_status/" + id + "/" + status);
        //     }

        //     if (status == 'Approve') {
        //         swal({
        //             title: "Are you sure?",
        //             text: "You want to " + status + "!",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "<?php echo APP_COLOR ?>",
        //             confirmButtonText: "Confirm",
        //             closeOnConfirm: true,
        //             closeOnCancel: true
        //         }, function(isConfirm) {
        //             if (isConfirm) {
        //                 $.ajax({
        //                     url: SITE_URL + "admin/customer/request_status/" + id + "/" + status,
        //                     type: "GET",
        //                     dataType: 'json',
        //                     success: function(data) {
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Done!',
        //                             text: data.message
        //                         });
        //                         table.ajax.reload(null, false);
        //                     }
        //                 });
        //             }
        //         });
        //     }
        // });


        /*
         ** Function for Change Status
         */
        function change_state(customer_id, status) {
            swal({
                title: "Are you sure?",
                text: (status == '1') ? "You want to unblock!" : "You want to block!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "<?php echo APP_COLOR ?>",
                confirmButtonText: "Confirm",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: SITE_URL + "admin/customer/change_state/" + customer_id + "/" + status,
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {

                            if (data.code == 0) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning!',
                                    text: data.message
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Done!',
                                    text: data.message
                                });
                                table.ajax.reload(null, false); // paging is not reset on reload
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {},
                        complete: function() {}
                    }); // END OF AJAX CALL
                }
            });
        }

        /*
         ** Function for delete details
         */
        function remove(user_id) {
            swal({
                title: "Delete Customer",
                text: "Are you sure you want to delete customer?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "<?php echo APP_COLOR ?>",
                confirmButtonText: "Confirm",
                closeOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: SITE_URL + "admin/customer/delete/" + user_id,
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Done!',
                                text: data.message
                            });
                            table.ajax.reload(null, false); // paging is not reset on reload
                        },
                        error: function(jqXHR, textStatus, errorThrown) {},
                        complete: function() {}
                    }); // END OF AJAX CALL
                }
            })
        }
    </script>

    <script type="text/javascript">
       

        function set_session(value, type) {

            // console.log(type);
            // console.log(value);

            $.ajax({
                url: SITE_URL + "admin/user/filter",
                type: "GET",
                data: {
                    value: value,
                    type: type
                },
                success: function(data) {
                    table.ajax.reload(null, false); // paging is not reset on reload
                },
                error: function(jqXHR, textStatus, errorThrown) {},
                complete: function() {}
            })
        }
    </script>
</body>

</html>
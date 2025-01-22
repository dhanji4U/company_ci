<!doctype html>
<html class="no-js " lang="en">

<head>
    <!-- Title -->
    <?php $data['title'] = 'Countries'; ?>

    <!-- Style CSS -->
    <?php $this->load->view("common/stylesheet", $data); ?>

</head>

<body class="<?php echo THEME_COLOR; ?>">

    <!-- Page Loader -->
    <?php $this->load->view("common/page_loader"); ?>

    <!-- Top-bar -->
    <?php $this->load->view('common/top_bar'); ?>

    <!-- Left Sidebar -->
    <?php $this->load->view('common/left_menu'); ?>

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 class="fadeInUp animated">Countries</h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/dashboard"><i class="zmdi zmdi-home"></i> Dashboard </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a>Countries</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- View -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
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

                                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

                                        <table class="table table-bordered dataTable js-exportable text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">
                                                        <button type="button" id="select-all" value="0" class="select_all">Select all</button>
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Flag</th>
                                                    <th>Country Name</th>
                                                    <th>Nationality</th>
                                                    <th>Sortname</th>
                                                    <th>Country Code</th>
                                                    <th>Currency Code</th>
                                                    <th>Currency Name</th>
                                                    <th>Currency Symbol</th>
                                                    <th>Status</th>
                                                    <th style="width: 57px;">Action</th>
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
                url: SITE_URL + "admin/countries/ajax_list",
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
                }
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
                        var dropdown = $('<div class="dropdown-menu fadeInUp animated" id="action_drop_down" aria-expanded="true" aria-labelledby="dropdownMenuButton"></div>');
                   
                        // Add items to the dropdown
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`active`);"  class="activerow" id="activerow"><i class="material-icons">visibility</i> Active</a></li>');
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`inactive`);"  class="inactiverow" id="inactiverow"><i class="material-icons">visibility_off</i> Inactive</a></li>');
                        dropdown.append('<li><a href="javascript:void(0);" onclick="change_select_dropdown(`remove`);"  class="deleterow" id="deleterow"><i class="material-icons">delete_forever</i> Delete</a></li>');
                      
                        // Attach the dropdown to the button
                        $(node).append(dropdown);
                    },
                    action: function(e, dt, node, config) {
                        // Toggle the dropdown when the button is clicked
                        $(node).find('.dropdown-menu').toggle();
                    }
                },
                {
                    text: "Add",
                    className: "btn-mute",
                    action: function(e, dt, node, config) {
                        window.location.href = SITE_URL + "admin/countries/add";
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
                    "data": "flag",
                    "orderable": false
                },
                {
                    "data": "name",
                    "orderable": true
                },
                {
                    "data": "nationality",
                    "orderable": true
                },
                {
                    "data": "sortname",
                    "orderable": true
                },
                {
                    "data": "calling_code",
                    "orderable": false
                },
                {
                    "data": "currency_code",
                    "orderable": true
                },
                {
                    "data": "currency_name",
                    "orderable": true
                },
                {
                    "data": "currency_symbol",
                    "orderable": false
                },
                {
                    "data": "status",
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
         ** Function for Change Status
         */
        function change_state(country_id, status) {
            swal({
                title: "Are you sure?",
                text: "You want to change status!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "<?php echo APP_COLOR ?>",
                confirmButtonText: "Confirm",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: SITE_URL + "admin/countries/change_state/" + country_id + "/" + status,
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
        function remove(country_id) {
            swal({
                title: "Delete Country ",
                text: "Are you sure you want to delete country?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "<?php echo APP_COLOR ?>",
                confirmButtonText: "Confirm",
                closeOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: SITE_URL + "admin/countries/delete/" + country_id,
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
</body>

</html>
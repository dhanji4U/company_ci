<!doctype html>
<html class="no-js " lang="en">

<head>
    <style>
        .fixTableHead {
            overflow-y: auto;
            height: 250px;
        }

        .fixTableHead thead th {
            position: sticky;
            top: 0;
            background: var(--white);
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
        }
    </style>

    <!-- Title -->
    <?php $data['title'] = 'View Customer'; ?>

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
                    <h2 class="fadeInDown animated">Customer Details </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/dashboard"><i class="zmdi zmdi-home"></i> Dashboard </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/customer">Customer</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a>Customer Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid fadeInUp animated">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <!-- View -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="card member-card">

                                <!-- Top -->
                                <div class="header" style="background: var(--app1)">
                                    <div class="col-md-1 text-left">
                                        <a href="javascript:void(0)" onclick="history.go(-1)" class="btn btn-custom-cut waves-effect waves-float waves-red text-left">
                                            <i class="zmdi zmdi-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="clearfix" style="margin-bottom: 101px;"> </div>
                                </div>

                                <div class="body">
                                    <div class="col-12">
                                        <ul class="list-inline">
                                            <li style="margin-top: 20px;">
                                                <h4 class="m-t-5"><?php echo $result['name']; ?> </h4>
                                            </li>
                                            <li>
                                                <?php if ($result['is_active'] != '0') { ?>
                                                    <a href="javascript:void(0)" onclick="remove('<?php echo $result['id']; ?>')" class="btn btn-custom waves-effect waves-float waves-red"><i class="zmdi zmdi-delete"></i></a>
                                                <?php } ?>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <div class="row text-left" style="margin: 0 1px -15px 3px;">
                                            <div class="col-md-6">
                                                <h4 class=""><b style="margin-left: -6px;">Personal Information</b></h4>
                                                <hr style="margin-left: -18px;">
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class=""><b style="margin-left: 10px;">Location Information</b></h4>
                                                <hr style="margin-left: 2px; margin-right: -16px;">
                                            </div>
                                        </div>
                                        <div class="row" style="text-align: justify; text-justify: inter-word;">
                                            <div class="col-md-6">

                                                <!-- Personal Information -->
                                                <div class="card-box m-t-20 text-left m-l-10">
                                                    <div class="p-20">
                                                        <div class="about-info-p">
                                                            <strong>Unique ID</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($result['unique_id'])) ? '<b class="text-danger">Not Defined</b>' : $result['unique_id']; ?>
                                                            </p>
                                                        </div>

                                                        <div class="about-info-p">
                                                            <strong>Email</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($result['email'])) ? '<b class="text-danger">Not Defined</b>' : $result['email']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Mobile</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($result['phone'])) ? '<b class="text-danger">Not Defined</b>' : $result['country_code'] . ' ' . $result['phone']; ?>
                                                            </p>
                                                        </div>

                                                        <div class="about-info-p">
                                                            <strong>Login Status</strong>
                                                            <br>
                                                            <?php
                                                            if ($result['login_status'] == 'Online')
                                                                echo '<b><p class="text-success">Online</p></b>';
                                                            else
                                                                echo '<b><p class="text-danger">Offline</p></b>';
                                                            ?>

                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Status</strong>
                                                            <br>
                                                            <?php
                                                            if ($result['is_active'] == '1')
                                                                echo '<b><p class="text-success">Active</p></b>';
                                                            else
                                                                echo '<b><p class="text-danger">Inactive</p></b>';
                                                            ?>
                                                        </div>

                                                        <div class="about-info-p">
                                                            <strong>Last Login</strong>
                                                            <br>

                                                            <p class="text-muted">
                                                                <?php if ($result['last_login'] == '0000-00-00 00:00:00') {
                                                                    echo '<b class="text-danger">Not Defined</b>';
                                                                } else {
                                                                    echo $this->common_model->dateConvertToTimezone($result['last_login'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE));
                                                                } ?>
                                                            </p>
                                                        </div>

                                                        <div class="about-info-p">
                                                            <strong>Registration Date</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo $this->common_model->dateConvertToTimezone($result['insert_datetime'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE)); ?>
                                                            </p>
                                                        </div>

                                                        <br>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Location Information -->
                                                <div>
                                                    <div class="card-box m-t-20 text-left m-l-10">
                                                        <div class="p-20">
                                                            <div class="about-info-p">
                                                                <strong>Address</strong>
                                                                <br>
                                                                <p class="text-muted">
                                                                    <?php echo (empty($result['address'])) ? '<b class="text-danger">Not Defined</b>' : $result['address']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="about-info-p">
                                                                <strong>Latitude</strong>
                                                                <br>
                                                                <p class="text-muted">
                                                                    <?php if ($result['latitude'] == "0.0" || $result['latitude'] == "") {
                                                                        echo '<b class="text-danger">Not Defined</b>';
                                                                    } else {
                                                                        echo $result['latitude'];
                                                                    } ?>
                                                                </p>
                                                            </div>
                                                            <div class="about-info-p">
                                                                <strong>Longitude</strong>
                                                                <br>
                                                                <p class="text-muted">
                                                                    <?php if ($result['longitude'] == "0.0" || $result['longitude'] == "") {
                                                                        echo '<b class="text-danger">Not Defined</b>';
                                                                    } else {
                                                                        echo $result['longitude'];
                                                                    } ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Device Information -->
                                                <div>
                                                    <hr style="margin-left: 2px;">
                                                    <h4 class=""><b style="margin-left: 10px;">Device Information</b></h4>
                                                    <hr style="margin-left: 2px;">

                                                    <div class="card-box m-t-20 text-left m-l-10">
                                                        <div class="about-info-p">
                                                            <strong>Token</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($device['token'])) ? '<b class="text-danger">Not Defined</b>' : $device['token']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Device Type</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php if ($device['device_type'] == "I") {
                                                                    echo "iOS";
                                                                } elseif ($device['device_type'] == "A") {
                                                                    echo "Android";
                                                                } else {
                                                                    echo '<b class="text-danger">Not Defined</b>';
                                                                } ?></p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Device Model</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($device['device_model'])) ? '<b class="text-danger">Not Defined</b>' : $device['device_model']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Device Token</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo (empty($device['device_token'])) ? '<b class="text-danger">Not Defined</b>' : $device['device_token']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Registration Date</strong>
                                                            <br>
                                                            <p class="text-muted">
                                                                <?php echo $this->common_model->dateConvertToTimezone($device['insert_datetime'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE)); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- User Address List -->
                                            <div class="col-md-12">

                                                <div class="card">
                                                    <div class="row text-left">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div>
                                                                    <hr>

                                                                    <h4 class="text-center"><b>User Address List</b></h4>

                                                                    <hr>
                                                                    <div class="custom-scroll">
                                                                        <fieldset>
                                                                            <div class="p-l-0 p-20">

                                                                                <div class="table-responsive fixTableHead">
                                                                                    <table class="table table-bordered custom-table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sr. No.</th>
                                                                                                <th>House number, Apartment</th>
                                                                                                <th>Near By, Street, Area</th>
                                                                                                <th>City</th>
                                                                                                <th>Pin Code</th>
                                                                                                <th>Default</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody style="text-align: center;">
                                                                                            <?php if (!empty($address)) {
                                                                                                foreach ($address as $key => $value) : ?>

                                                                                                    <tr>
                                                                                                        <td><?php echo $key + 1; ?></td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['apartment']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['street']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['city']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['pincode']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php if ($value['is_defaulted'] == '1') { ?>
                                                                                                                <span class="col-green"><b> Yes </b></span>
                                                                                                            <?php } else { ?>
                                                                                                                <span class="col-red"><b> No </b></span>
                                                                                                            <?php  } ?>
                                                                                                        </td>

                                                                                                    </tr>
                                                                                                <?php endforeach;
                                                                                            } else { ?>
                                                                                                <tr class="gradeX odd">
                                                                                                    <td colspan="7">No Data Found</td>
                                                                                                </tr>
                                                                                            <?php } ?>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- User Booking List -->
                                            <div class="col-md-12">

                                                <div class="card">
                                                    <div class="row text-left">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div>
                                                                    <hr>

                                                                    <h4 class="text-center"><b>User Booking List</b></h4>

                                                                    <hr>
                                                                    <div class="custom-scroll">
                                                                        <fieldset>
                                                                            <div class="p-l-0 p-20">

                                                                                <div class="table-responsive fixTableHead">
                                                                                    <table class="table table-bordered custom-table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Sr. No.</th>
                                                                                                <th>Booking No.</th>
                                                                                                <th>Parking Area</th>
                                                                                                <th>Local Authority</th>
                                                                                                <th>Parking Spot</th>
                                                                                                <th>In Time</th>
                                                                                                <th>Out Time</th>
                                                                                                <th>Sub Total</th>
                                                                                                <th>Tax</th>
                                                                                                <th>Local Resident Discount</th>
                                                                                                <th>Total Amount</th>
                                                                                                <th>Status</th>
                                                                                                <th>Admin Earning</th>
                                                                                                <th>Local Authority Earning</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody style="text-align: center;">
                                                                                            <?php if (!empty($booking)) {
                                                                                                foreach ($booking as $key => $value) : ?>

                                                                                                    <tr>
                                                                                                        <td><?php echo $key + 1; ?></td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['booking_id']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['parking_area_name']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['local_authority_name']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['parking_spot']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($this->common_model->dateConvertToTimezone($value['park_in_time'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE))); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($this->common_model->dateConvertToTimezone($value['extended_park_out_time'], ADMIN_LONGDATE, $this->session->userdata(ADMIN_TIMEZONE))); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['sub_total']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['tax']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['local_resident_discount']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['total_amount']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['status']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['admin_earning']); ?>
                                                                                                        </td>

                                                                                                        <td>
                                                                                                            <?php echo ($value['localauthority_earning']); ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                <?php endforeach;
                                                                                            } else { ?>
                                                                                                <tr class="gradeX odd">
                                                                                                    <td colspan="19">No Data Found</td>
                                                                                                </tr>
                                                                                            <?php } ?>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End View -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('common/footer'); ?>
    </section>

    <!-- JQuery Core JS-->
    <?php $this->load->view("common/script"); ?>

    <script>
        /*
         ** Function for delete details
         */
        function remove(customer_id) {
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
                        url: SITE_URL + "admin/customer/delete/" + customer_id,
                        type: "GET",
                        success: function(data) {
                            window.location.href = SITE_URL + "admin/customer ";
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
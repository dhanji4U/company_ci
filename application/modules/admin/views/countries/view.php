<!doctype html>
<html class="no-js " lang="en">

<head>
    <!-- Title -->
    <?php $data['title'] = 'View Country'; ?>

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
                    <h2 class="fadeInUp animated">Country Details

                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/dashboard"><i class="zmdi zmdi-home"></i> Dashboard </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url(); ?>admin/countries">Countries</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a>Country Details</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
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

                                <!-- Image -->
                                <div class="bg-custom bg-profile  button-color-css">
                                    <div class="member-img" style="margin-top: -63px">
                                        <?php if ($result['flag']) { ?>
                                            <img src="<?php echo "" . S3_BUCKET_ROOT . COUNTRIES_IMAGE . "" . $result['flag'] ?>" alt="Country-Flag" class="rounded-circle" style="width: 120px; height: 120px;" />
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() ?>assets/images/profileupload.jpg" alt="Country-Flag" class="rounded-circle" style="width: 120px; height: 120px;" />
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="body">
                                    <div class="col-12">
                                        <ul class="list-inline">
                                            <li style="margin-top: 20px;">
                                                <h4 class="m-t-5"><?php echo $result['name']; ?></h4>
                                            </li>
                                            <?php if ($result['is_active'] != '0') { ?>

                                                <a href="<?php echo site_url('admin/countries/edit/') . base64_encode($result['id']); ?>" class="btn btn-custom waves-effect waves-float waves-red"><i class="zmdi zmdi-edit"></i></a>

                                                <a href="javascript:void(0)" onclick="remove('<?php echo $result['id']; ?>')" class="btn btn-custom waves-effect waves-float waves-red"><i class="zmdi zmdi-delete"></i></a>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="row text-left" style="margin: 0 1px -9px 3px;">
                                            <div class="col-md-12 text-center">
                                                <h4>Country Information</h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row" style="text-align: justify; text-justify: inter-word; margin-top: -17px;">
                                            <div class="col-md-6">
                                                <div class="card-box m-t-20 text-left m-l-10">
                                                    <div class="p-20">
                                                        <div class="about-info-p">
                                                            <strong>Nationality</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo $result['nationality']; ?></p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Sort Name</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['sortname'])) ? '<b class="text-danger">Not Defined</b>' : $result['sortname']; ?></p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Language</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['language'])) ? '<b class="text-danger">Not Defined</b>' : $result['language']; ?> </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Country Code</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['country_code'])) ? '<b class="text-danger">Not Defined</b>' : $result['country_code']; ?></p>
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
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card-box m-t-20 text-left m-l-10">
                                                    <div class="p-20">
                                                        <div class="about-info-p">
                                                            <strong>Currency Code</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['currency_code'])) ? '<b class="text-danger">Not Defined</b>' : $result['currency_code']; ?> </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Currency Name</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['currency_name'])) ? '<b class="text-danger">Not Defined</b>' : $result['currency_name']; ?> </p>
                                                        </div>
                                                        <div class="about-info-p">
                                                            <strong>Currency Symbol</strong>
                                                            <br>
                                                            <p class="text-muted"><?php echo (empty($result['currency_symbol'])) ? '<b class="text-danger">Not Defined</b>' : $result['currency_symbol']; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End View -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('common/footer'); ?>
    </section>

    <!-- JQuery Core JS -->
    <?php $this->load->view("common/script"); ?>

    <script>
        var SITE_URL = '<?php echo site_url(); ?>';
        /*
         ** Function for delete details
         */
        function remove(id) {
            swal({
                title: "Delete Country",
                text: "Are you sure you want to delete country?",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "<?php echo APP_COLOR ?>",
                confirmButtonText: "Confirm",
                closeOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: SITE_URL + "admin/countries/delete/" + id,
                        type: "GET",
                        success: function(data) {
                            window.location.href = SITE_URL + "admin/countries ";
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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo PROJECT_NAME . " Admin Panel"; ?>">
    
    <title><?php echo PROJECT_NAME; ?></title>

    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url().LOGO_NAME; ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/color_skins.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/parsley/parsley.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate_page.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/authentication.css">
</head>

<body class="<?php echo THEME_COLOR; ?>">
    <div class="authentication">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header slideDown">
                            <div class="logo">
                                <img src="<?php echo base_url().LOGO_NAME; ?>" style="height: 100px; width:100px;" alt="<?php echo PROJECT_NAME; ?>">
                            </div>
                            <h1><?php echo PROJECT_NAME ?> </h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>

                    <?php if ($this->session->flashdata('success_msg')) { ?>
                        <div class="alert alert-success alert-dismissable zoomIn animated" style="margin-left: 24px;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button" style="color: red;">×</button><?php echo $this->session->flashdata('success_msg') ?><a class="alert-link" href="#"></a>.
                        </div>
                        <?php unset($_SESSION['success_msg']); ?>
                    <?php } ?>
                    <div class="clearfix"></div>

                    <?php if ($this->session->flashdata('error_msg')) { ?>
                        <div class="alert alert-danger alert-dismissable zoomIn animated" style="margin: 0px 7px 0px 7px;">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button" style="color: red;">×</button><?php echo $this->session->flashdata('error_msg') ?><a class="alert-link" href="#"></a>.
                        </div>
                        <?php unset($_SESSION['error_msg']); ?>
                    <?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bundles/libscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script> <!-- Parsley JS -->

</body>

</html>
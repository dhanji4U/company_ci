<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo PROJECT_NAME . " Admin Panel"; ?>">

    <title><?php echo PROJECT_NAME ?> | Forgot Password</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/authentication.css">

    <!-- Style CSS -->
    <?php $this->load->view("admin/common/stylesheet"); ?>

</head>

<body class="<?php echo THEME_COLOR; ?>">
    <div class="authentication">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header slideDown">
                            <div class="logo"><img src="<?php echo base_url().LOGO_NAME; ?>" alt="<?php echo PROJECT_NAME; ?>" style="height: 98px ! important; width: 118px ! important; border-radius: 5px;"></div>
                            <h1><?php echo PROJECT_NAME; ?> </h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <div class="alert alert-danger alert-dismissable zoomIn animated">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><?php echo $this->session->flashdata('error_msg') ?><a class="alert-link" href="#"></a>.
                            </div>
                            <?php unset($_SESSION['error_msg']); ?>
                        <?php } ?>
                    </div>

                    <?php echo form_open('home/changepassword', array('id' => 'forgot_password', 'name' => 'forgot_password', 'class' => 'col-lg-12 submit_name', 'method' => 'post', 'data-parsley-validate' => '')); ?>

                    <h5 class="title">Change Password</h5>

                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />

                    <input type="hidden" name="user_type" value="<?php echo $user_type ?>" />

                    <!-- Password -->
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" id="password" required data-parsley-trigger="keyup" data-parsley-minlength="08" data-parsley-maxlength="25" data-parsley-pattern="/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/" data-parsley-pattern-message="Enter the valid password: password must contain first uppercase, one lowercase, one digit, one special character and 8 character's long" data-parsley-required-message="Please enter a new password" data-parsley-errors-container=".password_error">
                                <label class="form-label">New Password</label>
                            </div>
                            <?php echo form_error('password'); ?>
                            <span class="password_error"></span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required data-parsley-trigger="keyup" data-parsley-equalto="#password" data-parsley-equalto-message="Please enter the same confirm password as the new password" data-parsley-required-message="Please enter a confirm password" data-parsley-errors-container=".confirm_password_error">
                                <label class="form-label">Confirm Password</label>
                            </div>
                            <?php echo form_error('confirm_password'); ?>
                            <span class="confirm_password_error"></span>
                        </div>
                    </div>

                    <div class="row clearfix"></div>

                    <div class="col-lg-12">
                        <button type="submit" name="submit" class="btn btn-custom waves-effect">Change Password</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery Core JS -->
    <script src="<?php echo base_url(); ?>assets/plugins/parsley/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->

    <script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script> <!-- Parsley JS -->

</body>

</html>
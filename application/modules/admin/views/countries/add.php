<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo PROJECT_NAME . " Admin Panel"; ?>">

    <title><?php echo PROJECT_NAME ?> | Add Countries</title>

    <!-- Style CSS -->
    <?php $this->load->view("common/stylesheet"); ?>

</head>

<body class="<?php echo THEME_COLOR; ?>">

    <!-- Page Loader -->
    <?php $this->load->view("common/page_loader"); ?>

    <!-- Top-bar -->
    <?php $this->load->view('common/top_bar'); ?>

    <!-- Left Sidebar -->
    <?php $this->load->view('common/left_menu'); ?>

    <section class="content blog-page">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 class="fadeInUp animated">Add Country
                         
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
                            <a>Add Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!-- View -->
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="card member-card">

                                <?php echo form_open('admin/countries/add', array('id' => 'add_country', 'name' => 'add_country', 'class' => 'form-horizontal group-border-dashed', 'method' => 'post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '')); ?>

                                <!-- Image -->
                                <div class="form-group" style="margin-top: 110px;">
                                    <!-- Image Preview -->
                                    <div class="bg-custom bg-profile  button-color-css">
                                        <div class="member-img m-t-8">
                                            <img src="<?php echo base_url() ?>assets/images/profileupload.jpg" id="imagePreview" alt="Country-Flag" class="rounded-circle" style="width: 120px; height: 120px;" />
                                        </div>
                                    </div>
                                    <!-- Image Upload -->
                                    <div class="text-center m-b-10" style="margin-bottom: -25px;">
                                        <div class="form-group text-center">
                                            <div class="">
                                                <span class="btn btn-custom waves-effect m-b-15 btn-file">
                                                    <i class="zmdi zmdi-camera" alt="Choose File"></i><input type="file" id="flag" name="flag" class="filestyle" required data-parsley-required-message="Please select flag" data-parsley-pattern="[^.]+(.png|.jpg|.jpeg|.svg|.PNG|.JPG|.JPEG|.SVG)$" data-parsley-pattern-message="Please upload image with valid extension" data-parsley-trigger="change" data-parsley-errors-container=".flag_error" />
                                                </span>
                                            </div>
                                            <?php echo form_error('flag'); ?>
                                        </div>
                                        <span class="flag_error"></span>
                                    </div>
                                </div>

                                <div class="body text-left">
                                    <div class="row clearfix">

                                        <!-- Country Name-->
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('name')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" required data-parsley-trigger="change" data-parsley-required-message="Please enter country name" data-parsley-errors-container=".name_error">
                                                    <label class="form-label">Country Name</label>
                                                </div>
                                                <?php echo form_error('name'); ?>
                                            </div>
                                            <span class="name_error"></span>
                                        </div>

                                        <!-- Nationality -->
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('nationality')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="nationality" id="nationality" value="<?php echo set_value('nationality'); ?>" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-maxlength="50" data-parsley-required-message="Please enter nationality" data-parsley-errors-container=".nationality_error">
                                                    <label class="form-label">Nationality</label>
                                                </div>
                                                <?php echo form_error('nationality'); ?>
                                            </div>
                                            <span class="nationality_error"></span>
                                        </div>

                                        <!-- Sort Name-->
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('sortname')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="sortname" id="sortname" value="<?php echo set_value('sortname'); ?>" onkeypress="return lettersOnly(event)" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-maxlength="16" data-parsley-required-message="Please enter sortname" data-parsley-errors-container=".sortname_error">
                                                    <label class="form-label">Sort Name</label>
                                                </div>
                                                <?php echo form_error('sortname'); ?>
                                            </div>
                                            <span class="sortname_error"></span>
                                        </div>

                                        <!-- Language -->
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('language')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="language" id="language" value="<?php echo set_value('language'); ?>" required data-parsley-minlength="02" data-parsley-maxlength="50" data-parsley-trigger="change" data-parsley-required-message="Please enter language" data-parsley-errors-container=".language_error">
                                                    <label class="form-label">Language</label>
                                                </div>
                                                <?php echo form_error('language'); ?>
                                            </div>
                                            <span class="language_error"></span>
                                        </div>

                                        <!-- Country Code -->
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('calling_code')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="calling_code" id="calling_code" value="<?php echo set_value('calling_code'); ?>" onkeyup="return limitlength(this, 5)" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-maxlength="06" data-parsley-pattern="^([+]?\d{1,6})+$" data-parsley-pattern-message="Please write only in number like (+00)" data-parsley-required-message="Please enter country code" data-parsley-errors-container=".calling_code_error">
                                                    <label class="form-label">Country Code</label>
                                                </div>
                                                <?php echo form_error('calling_code'); ?>
                                            </div>
                                            <span class="calling_code_error"></span>
                                        </div>

                                        <!-- Currency Code -->
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('currency_code')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="currency_code" id="currency_code" value="<?php echo set_value('currency_code'); ?>" onkeypress="return lettersOnly(event)" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-maxlength="16" data-parsley-required-message="Please enter currency code" data-parsley-errors-container=".currency_code_error">
                                                    <label class="form-label">Currency Code</label>
                                                </div>
                                                <?php echo form_error('currency_code'); ?>
                                            </div>
                                            <span class="currency_code_error"></span>
                                        </div>

                                        <!-- Currency Name -->
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('currency_name')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="currency_name" id="currency_name" value="<?php echo set_value('currency_name'); ?>" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-maxlength="20" data-parsley-required-message="Please enter currency name" data-parsley-errors-container=".currency_name_error">
                                                    <label class="form-label">Currency Name</label>
                                                </div>
                                                <?php echo form_error('currency_name'); ?>
                                            </div>
                                            <span class="currency_name_error"></span>
                                        </div>

                                        <!-- Currency Symbol -->
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('currency_symbol')) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="currency_symbol" id="currency_symbol" value="<?php echo set_value('currency_symbol'); ?>" required data-parsley-trigger="change" data-parsley-required-message="Please enter currency symbol" data-parsley-errors-container=".currency_symbol_error">
                                                    <label class="form-label">Currency Symbol</label>
                                                </div>
                                                <?php echo form_error('currency_symbol'); ?>
                                            </div>
                                            <span class="currency_symbol_error"></span>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row clearfix">
                                        <div class="col-md-6 offset-md-3 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-custom waves-effect btn-file m-t-20">
                                                    <span>Add</span>
                                                </button>
                                                <a href="javascript:void(0)" onclick="history.go(-1)" class="btn btn-custom-cut waves-effect btn-file m-t-20">
                                                    <span>Cancel</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
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

    <!-- JQuery Core JS -->
    <?php $this->load->view("common/script"); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#flag").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
</body>

</html>
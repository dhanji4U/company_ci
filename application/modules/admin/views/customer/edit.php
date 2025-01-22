<!doctype html>
<html class="no-js " lang="en">

<head>
    <!-- Title -->
    <?php $data['title'] = 'Update Customer'; ?>

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

    <section class="content blog-page">
        <div class="block-header">

            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 class="fadeInDown animated">Update Customer</h2>
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
                            <a>Edit Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid fadeInUp animated">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <!-- View -->
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12"> -->
                            <div class="card member-card">

                                <?php echo form_open('admin/customer/edit/' . base64_encode($result['id']), array('id' => 'edit_customer', 'name' => 'edit_customer', 'class' => 'form-horizontal group-border-dashed', 'method' => 'post', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '')); ?>

                                <div class="body text-left">
                                    <div class="row clearfix">

                                        <input type="hidden" value="<?php echo set_value('id', $result['id']); ?>" name="user_id">

                                        <!-- Name -->
                                        <div class="col-md-10 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('name')) || !empty($result['name']) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name', $result['name']); ?>" required data-parsley-trigger="change" data-parsley-minlength="02" data-parsley-required-message="Please enter name" data-parsley-errors-container=".name_error">
                                                    <label class="form-label">Name</label>
                                                </div>
                                                <?php echo form_error('name'); ?>
                                            </div>
                                            <span class="name_error"></span>
                                        </div>

                                        <!-- Country Code -->
                                        <div class="col-md-3 offset-md-1">
                                            <div class="form-group">
                                                <div class="">
                                                    <?php $country = $this->common_model->getCountriesList(); ?>

                                                    <select class="form-control ms country_code" name="country_code" id="country_code" required data-parsley-trigger="change" data-parsley-required-message="Please select country code">

                                                        <option value="" disabled=""> Select Country </option>
                                                        <?php
                                                        if (!empty($country)) {
                                                            foreach ($country as $key => $value) {
                                                        ?>
                                                                <option value="<?php echo $value['calling_code']; ?>" data-flag="<?php echo $value['flag']; ?>" <?php echo ($result['country_code'] == $value['calling_code']) ? 'selected="selected"' : ''; ?>> <?php echo $value['name'] . " (" . $value['calling_code'] . ")"; ?></option>

                                                        <?php }
                                                        } ?>
                                                    </select>

                                                </div>
                                                <?php echo form_error('country_code'); ?>
                                            </div>
                                            <!-- <span class="country_code_err"></span> -->
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-7">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('phone')) || !empty($result['phone']) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone', $result['phone']); ?>" onkeypress="return numbersonly(event)" maxlength="10" required data-parsley-trigger="change" data-parsley-type="number" data-parsley-minlength="08" data-parsley-type-message="Please enter value in number" data-parsley-required-message="Please enter phone number" data-parsley-errors-container=".phone_error">
                                                    <label class="form-label">Phone Number</label>
                                                </div>
                                                <?php echo form_error('phone'); ?>
                                            </div>
                                            <span class="phone_error"></span>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-5 offset-md-1">
                                            <div class="form-group form-float">
                                                <div class="form-line <?php echo (!empty(set_value('email')) || !empty($result['email']) ? 'focused' : ''); ?>">
                                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email', $result['email']); ?>" required data-parsley-trigger="change" data-parsley-type="email" data-parsley-type-message="Please write proper email address" data-parsley-required-message="Please enter valid email address" data-parsley-errors-container=".email_error">
                                                    <label class="form-label">Email</label>
                                                </div>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                            <span class="email_error"></span>
                                        </div>

                                        <!-- For Change Password -->
                                        <div class="col-md-5">
                                            <div class="form-group form-float">
                                                <div class="form-line password">
                                                    <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                                                    <span id="togglePassword" data-id="1" class="zmdi zmdi-eye-off custom-icon"></span>
                                                    <label class="form-label">Change Password</label>
                                                </div>
                                                <?php echo form_error('password'); ?>
                                            </div>
                                            <span class="password_error"></span>
                                        </div>

                                        <!-- Language -->
                                        <div class="col-md-5 offset-md-1" style="margin-top: -5px;">
                                            <div class="form-group">
                                                <div class="">
                                                    <select class="form-control select2" name="language" id="language" required data-parsley-trigger="change" data-parsley-required-message="Please select language" data-parsley-errors-container=".language_err">
                                                        <option value="">Select Language</option>

                                                        <option value="French" <?php echo ($result['language'] == 'French') ? 'selected' : ''; ?>>French</option>
                                                        <option value="English" <?php echo ($result['language'] == 'English') ? 'selected' : ''; ?>>English</option>
                                                    </select>
                                                </div>
                                                <?php echo form_error('language'); ?>
                                            </div>
                                            <span class="language_err"></span>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row clearfix">
                                        <div class="col-md-6 offset-md-3 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-custom waves-effect btn-file m-t-20">
                                                    <span>Update</span>
                                                </button>
                                                <button class="btn btn-custom-cut waves-effect btn-file m-t-20" onclick="history.go(-1)" type="reset">
                                                    <span>Cancel</span>
                                                </button>
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

    <!-- Script JS -->
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('.country_code').select2({
                "width": "100%",
                templateResult: CountryTemplate,
                templateSelection: CountryTemplate
            });
        });

        var inputElement = document.getElementById('password').value;
        var formLineElement = document.querySelector('.password');

        // Add or remove class based on the input value
        if (inputElement.trim() !== '') {
            formLineElement.classList.add('focused');
        } else {
            formLineElement.classList.remove('focused');
        }

        // for hiding the password and show password
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function(e) {

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var new_id = ($(this).attr("data-id") == '0') ? '1' : '0';

            if ($(this).attr("data-id") != '1') {
                this.classList.remove("zmdi-eye")
                this.classList.add("zmdi-eye-off");
            } else {
                this.classList.add("zmdi-eye")
                this.classList.remove("zmdi-eye-off");
            }
            $(this).attr("data-id", new_id);

        });

        function CountryTemplate(selectboxdata) {
            if (!selectboxdata.id) {
                return selectboxdata.text;
            }
            var $selectboxdata = $(
                '<span><img src="' + $(selectboxdata.element).data('flag') + '" class="img-flag" style="width: 30px; height: 23px; margin-top: -4px;">' + selectboxdata.text + '</span>'
            );
            return $selectboxdata;
        };

        $(document).ready(function() {
            $("#profile_image").change(function() {
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
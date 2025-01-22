<style>
    .slimScrollBar {
        background: black none repeat scroll 0% 0% !important;
        width: 5px !important;
        opacity: 1 !important;
    }
</style>

<aside id="leftsidebar" class="sidebar">

    <?php $session_data = $this->session->userdata(ADMIN_SESSION_NAME); ?>

    <!-- User Info -->
    <div class="user-info pt-0">
        <div class="user-info">
            <div class="image">
                <?php if ($session_data['profile_image']) { ?>
                    <img src="<?php echo "" . S3_BUCKET_ROOT . ADMIN_IMAGE . "" . $session_data['profile_image'] ?>" alt="Admin" class="rounded-circle" style="width: 45px; height: 45px;" />
                <?php } else { ?>
                    <img src="<?php echo base_url() ?>assets/images/profileupload.jpg" alt="Admin" class="rounded-circle" style="width: 45px; height: 45px;" />
                <?php } ?>
            </div>
            <div class="info-container">

                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                    <?php
                    $name_length = strlen($session_data['name']);
                    if ($name_length > 13) {
                        echo substr($session_data['name'], 0, 13 - $name_length) . "...";
                    } else {
                        echo $session_data['name'];
                    }
                    ?>
                </div>

                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                    <ul class="dropdown-menu fadeInUp animated">
                        <li>
                            <a href="<?php echo base_url(); ?>admin/admin/profile"><i class="material-icons">person</i>Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin/admin/change_password"><i class="material-icons">vpn_key</i>Change Password</a>
                        </li>
                        <li>
                            <a href="javascript:;" onclick="logout();"><i class="material-icons">input</i>Sign Out</a>
                        </li>
                    </ul>
                </div>
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $email_length = strlen($session_data['email']);
                    if ($email_length > 16) {
                        echo substr($session_data['email'], 0, 16 - $email_length) . "...";
                    } else {
                        echo $session_data['email'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- #User Info -->

    <!-- Menu -->

    <body>

        <div class="menu navigation" style="background: var(--app1);">

            <ul class="list">

                <li class="<?php echo $this->common_model->get_menu('dashboard'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/dashboard">
                        <i class="zmdi zmdi-home"></i><span class="points">Dashboard</span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('local_authority'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/local_authority">
                        <i class="zmdi zmdi-nature-people"></i><span class="points">Local Authorities</span>
                        <span id="sidebar__local_authority" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('attendant'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/attendant">
                        <i class="zmdi zmdi-accounts"></i><span class="points">Attendants</span>
                        <span id="sidebar__attendant" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('customer'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/customer">
                        <i class="zmdi zmdi-accounts-alt"></i><span class="points">Customer</span>
                        <span id="sidebar__customer" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('parking_area'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/parking_area">
                        <i class="zmdi zmdi-tumblr"></i><span class="points">Parking Areas</span>
                        <span id="sidebar__parking_area" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>


                <li class="<?php echo $this->common_model->get_menu('countries'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/countries">
                        <i class="zmdi zmdi-globe"></i><span class="points">Country</span>
                        <span id="sidebar__countries" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('earning'); ?>">
                    <a href="<?php echo site_url("admin/earning"); ?>">
                        <i class="zmdi zmdi-money-box"></i>
                        <span class="points">Earning</span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('notification'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/notification">
                        <i class="zmdi zmdi-notifications-active"> </i><span class="points">Notification</span>
                        <span id="sidebar__notification" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('contactus'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/contactus">
                        <i class="zmdi zmdi-email"> </i><span class="points">Contact Us</span>
                        <span id="sidebar__contactus" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('faq'); ?> open">
                    <a href="<?php echo base_url(); ?>admin/faq">
                        <i class="zmdi zmdi-pin-help"> </i><span class="points">FAQ</span>
                        <span id="sidebar__faq" class="label label-app pull-right bounceInLeft animated">
                            0
                        </span>
                    </a>
                </li>

                <li class="<?php echo $this->common_model->get_menu('app_content'); ?> open">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="zmdi zmdi-format-list-bulleted zmdi-hc-fw"></i>
                        <span class="points">CMS Content</span>
                    </a>
                    <ul class="ml-menu ac_transperent">
                        <li class="<?php echo $this->common_model->get_submenu_list(array('customer_about_us', 'customer_terms_conditions', 'customer_privacy_policy')); ?> open">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Customer CMS</span>
                            </a>
                            <ul class="ml-menu ac_transperent">
                                <li class="<?php echo $this->common_model->get_submenu_list(array('customer_about_us')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/customer_about_us">
                                        <i class="zmdi zmdi-file-text"> </i><span class="points">About Us</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('customer_privacy_policy')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/customer_privacy_policy">
                                        <i class="zmdi zmdi-shield-security"> </i><span class="points">Privacy Policy</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('customer_terms_conditions')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/customer_terms_conditions">
                                        <i class="zmdi zmdi-check-all"> </i><span class="points">Terms & Conditions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo $this->common_model->get_submenu_list(array('attendant_about_us', 'attendant_terms_conditions', 'attendant_privacy_policy')); ?> open">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Attendant CMS</span>
                            </a>
                            <ul class="ml-menu ac_transperent">
                                <li class="<?php echo $this->common_model->get_submenu_list(array('attendant_about_us')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/attendant_about_us">
                                        <i class="zmdi zmdi-file-text"> </i><span class="points">About Us</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('attendant_privacy_policy')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/attendant_privacy_policy">
                                        <i class="zmdi zmdi-shield-security"> </i><span class="points">Privacy Policy</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('attendant_terms_conditions')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/attendant_terms_conditions">
                                        <i class="zmdi zmdi-check-all"> </i><span class="points">Terms & Conditions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo $this->common_model->get_submenu_list(array('localauthority_about_us', 'localauthority_terms_conditions', 'localauthority_privacy_policy')); ?> open">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Local Authority CMS</span>
                            </a>
                            <ul class="ml-menu ac_transperent">
                                <li class="<?php echo $this->common_model->get_submenu_list(array('localauthority_about_us')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/localauthority_about_us">
                                        <i class="zmdi zmdi-file-text"> </i><span class="points">About Us</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('localauthority_privacy_policy')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/localauthority_privacy_policy">
                                        <i class="zmdi zmdi-shield-security"> </i><span class="points">Privacy Policy</span>
                                    </a>
                                </li>
                                <li class="<?php echo $this->common_model->get_submenu_list(array('localauthority_terms_conditions')); ?>">
                                    <a href="<?php echo base_url(); ?>admin/app_content/localauthority_terms_conditions">
                                        <i class="zmdi zmdi-check-all"> </i><span class="points">Terms & Conditions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </body>

    <!-- #Menu -->

</aside>
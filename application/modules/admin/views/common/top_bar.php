<nav class="navbar">
    <div class="col-12">

        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <img src="<?php echo base_url() . LOGO_NAME; ?>" alt="<?php echo PROJECT_NAME; ?>" style="height: 25px !important; width: 26px !important;border-radius: 5px; margin: -25px 15px -2px 30px !important;">
            <a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard" style="text-transform: uppercase;"> <span><?php echo PROJECT_NAME; ?></span></a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="javascript:void(0);" class="ls-toggle-btn" data-close="true">
                    <i class="zmdi zmdi-swap"></i>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="<?php echo base_url(); ?>admin/dashboard" class="inbox-btn hidden-sm-down" data-close="true">
                    <i class="zmdi zmdi-home"></i>
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="javascript:;" onclick="logout();" class="mega-menu" data-close="true">
                    <i class="zmdi zmdi-power"></i>
                </a>
            </li>
        </ul>

        <!-- <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true">
                    <i class="zmdi zmdi-fullscreen"></i>
                </a>
            </li>
        </ul> -->

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="<?php echo base_url(); ?>admin/edit_setting" class="js-right-sidebar" data-close="true">
                    <i class="zmdi zmdi-settings"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- <script type="text/javascript">
    var SITE_URL = '<?php echo site_url(); ?>';

    function logout() {
        swal({
            title: "Are you sure?",
            text: "You want to Logout!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "<?php echo APP_COLOR ?>",
            confirmButtonText: "Yes, Logout!",
            cancelButtonText: "No, Wait",
            closeOnConfirm: true,
            // closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: SITE_URL + "admin/login/logout",
                    type: "GET",
                    success: function() {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {},
                    complete: function() {}
                });
            }

        });
    }
</script> -->
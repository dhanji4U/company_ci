<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo PROJECT_NAME . " Admin Portal"; ?>">
    <title><?php echo PROJECT_NAME; ?> - FAQ's</title>

	<!-- Favicon-->
	<link rel="icon" href="<?php echo base_url().LOGO_NAME; ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/color_skins.css">

    <style>
        .panel-group .panel {
            margin-bottom: 2px;
        }

        .panel-group .panel-default {
            background-color: #f6f6f7 !important;
            color: #000;
            font-weight: bold;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .panel>.panel-heading,
        .panel.panel-default>.panel-heading {
            background-color: #f6f6f7;
            border-radius: 6px;
            margin-bottom: -2px;
        }

        .panel-group .panel .panel-body {
            background: #f6f6f7 !important;
            border-radius: 6px;
            margin-top: -18px;
        }

        h4 {
            margin-bottom: 0.1rem !important;
        }

        #search_div {
            position: relative;
            box-shadow: 0 1px 6px 0 rgb(0 0 0 / 12%), 0 1px 6px 0 rgb(0 0 0 / 12%);
            margin-bottom: 20px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .panel-group .panel .panel-heading a {
            color: black !important;
        }

        #myInput {
            width: 100%;
        }

        .input-group {
            width: 100%;
            margin-bottom: 2px;
        }

        .form-control::placeholder {
            line-height: 2.429;
            background: white;
            font-size: 16px;
        }

        .form-control {
            height: 50px !important;
        }

        .input-group .input-group-btn {
            padding: 0 0px;
        }

        .zmdi-plus-square,
        .zmdi-minus-square {
            padding-right: 11px;
            padding-left: 3px;
        }

        .cursor_change:hover {
            cursor: pointer;
        }

        .zmdi-minus-square {
            color: <?php echo APP_COLOR ?>;
            /* margin-left: 67.5%; */
            /* display: none; */
        }

        .zmdi-plus-square {
            color: <?php echo APP_COLOR ?>;
            /* margin-left: 67.5%; */
        }


        .zmdi-search {
            font-size: 1.8em !important;
            color: #000;
            top: 8px !important;
        }

        .accordion {
            position: relative;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .accordion:after {
            content: '\002B';
            font-weight: bold;
            position: absolute;
            float: right;
            color: #1d84c5;
            margin-left: 5px;
            width: 20px;
            height: 20px;
            background: #95c3e1;
            border-radius: 5px;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            line-height: 18px;
            text-align: center;
            top: 29%;
            right: 3px;
        }

        .panel-group .panel .panel-body {
            color: #898E95;
            padding: 20px;
            background: #F6F6F7;
        }

        .input-group .form-control:not(:first-child):not(:last-child),
        .input-group-addon:not(:first-child):not(:last-child),
        .input-group-btn:not(:first-child):not(:last-child) {
            border-radius: 10px;
        }

        .active:after {
            display: none;
        }

        body {
            background-color: #ffffff !important;
            margin: none !important;
        }

        .panel {
            border-radius: 2px;
            border: 0;
            box-shadow: none;
        }

        .col-md-12 {
            padding-right: 20px !important;
            padding-left: 20px !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            max-width: 93%;
            border-top: 2px solid #707070;
        }

        .theme-blue {
            overflow: hidden !important;
        }
    </style>
</head>

<body class="theme-blue">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- <div class="card"> -->
            <div class="body" style="padding: 0.65rem; overflow-x:hidden; ">
                <div class="input-group bootstrap-touchspin" id="search_div" style="background-color:#FFF;">
                    <div class="input-group-btn" style="background: white; border-radius: 10px;">
                        <button class="btn btn-default bootstrap-touchspin-down" type="button" style="box-shadow: 0 0px 0px rgba(0, 0, 0, 0), 0 0px 0px rgba(0, 0, 0, 0);">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
                    <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
                    <input id="myInput" value="" placeholder="Search here..." name="demo3" class="form-control" style="display: block;" type="text" onkeyup="myFunction()">
                    <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;">
                    </span>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12 col-lg-12">
                        <div class="panel-group" id="accordion_10" role="tablist" aria-multiselectable="false">
                            <?php if (isset($result) && !empty($result)) {
                                foreach ($result as $key => $value) { ?>
                                    <?php
                                    if ($language == 'en') { ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne_<?php echo $key; ?>">
                                                <a role="button" class="accordion" data-toggle="collapse" data-parent="#accordion_<?php echo $key; ?>" href="#collapseOne_<?php echo $key; ?>" aria-expanded="true" aria-controls="collapseOne_<?php echo $key; ?>">
                                                    <?php echo $key + 1; ?>.
                                                    <?php echo $value['question']; ?>
                                                </a>
                                            </div>
                                            <div id="collapseOne_<?php echo $key; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_<?php echo $key; ?>">
                                                <hr>
                                                <div class="panel-body"> <?php echo $value['answer']; ?> </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- </div> -->
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/bundles/libscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/bundles/vendorscripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/bundles/mainscripts.bundle.js"></script>
    <script>
        // function collpse(id, ele) {
        //     $expand = $(ele).find("i");
        //     if ($expand.hasClass('zmdi zmdi-plus-square')) {
        //         $expand.removeClass('zmdi zmdi-plus-square').addClass('zmdi zmdi-minus-square');
        //     } else {
        //         $expand.removeClass('zmdi zmdi-minus-square').addClass('zmdi zmdi-plus-square');
        //     }
        // }

        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("accordion_10");
            tr = document.getElementsByClassName("panel");
            for (i = 0; i < tr.length; i++) {
                td = tr[i];
                // .getElementsByTagName("td")[0]
                console.log(td)
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $('input,textarea').focus(function() {
            $(this).data('placeholder', $(this).attr('placeholder'))
                .attr('placeholder', '');
        }).blur(function() {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                // alert(this.nextElementSibling)
                // var panel = this.nextElementSibling;
                // if (panel.style.maxHeight) {
                //     panel.style.maxHeight = null;
                // } else {
                //     panel.style.maxHeight = panel.scrollHeight + "px";
                // }
            });
        }
    </script>
</body>

</html>
<script src="<?php echo base_url(); ?>assets/plugins/parsley/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?php echo base_url(); ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?php echo base_url(); ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->

<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script> <!-- Parsley JS -->

<!-- Sweet Alert -->
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>

<!-- Moment Plugin JS -->
<script src="<?php echo base_url(); ?>assets/plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin JS -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/autosize/autosize.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/jquery-spinner/js/jquery.spinner.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script> <!-- Magnific Popup JS (Image Zoom) -->

<script type="text/javascript">
  var SITE_URL = '<?php echo site_url(); ?>';

  $(".select2").select2({
    "width": "100%"
  });

  // Initialize Parsley validation
  $('.select2').parsley();

  // Trigger validation on select2:select event
  $('.select2').on('select2:select', function() {
    $(this).parsley().validate();
  });

  autosize(document.querySelectorAll('textarea'));

  function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
      if (unicode < 48 || unicode > 57) //if not a number
        return false //disable key press
    }
  }

  function limitlength(obj, length) {
    var maxlength = length
    if (obj.value.length > maxlength)
      obj.value = obj.value.substring(0, maxlength)
  }

  function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
      ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) &&
      (charCode < 97 || charCode > 122)) {
      return false;
    }
    return true;
  }
</script>

<script type="text/javascript">
  /*Reset the count value on dashboard*/
  resetSidebarCounts('pageload');
  //For counter animation
  function CounterAnimation(counterid, x) {
    $('#' + counterid).addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
      $(this).removeClass(x + ' animated');
    });
  };
  //Set sidebar counts
  function resetSidebarCounts(calltype) {
    var url = '<?php echo site_url(); ?>admin/dashboard/getDashboardCounts';
    $.ajax({
      type: "GET",
      url: url,
      success: function(results) {
        var animation = 'hatch';
        var order_animation = 'zoomIn';
        var extra_animation = 'flip';
        counts = JSON.parse(results);
        // console.log(counts);return

        $.each(counts, function(key, value) {
          if (value > $("#sidebar__" + key).text()) {
            if (calltype != 'pageload') {
              CounterAnimation("sidebar__" + key, animation);
            }
          }
          $("#sidebar__" + key).html(value);
          if ("<?php echo $this->router->fetch_class(); ?>" == 'dashboard') {
            if (value > $("#" + key).text()) {
              if (calltype != 'pageload') {
                CounterAnimation(key, animation);
              }
            }
            $('#' + key).html(value);
          }
        });
      }
    });
  }
  /*Reset the count value on sidebar*/
  setInterval(function() {
    //Reset sidebar counts
    resetSidebarCounts('ajaxcall');
  }, 15000);
</script>

<script>
  $(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      },
      format: 'YYYY-MM-DD',

    }, function(start, end) {

      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      set_session(start.format('YYYY-MM-DD'), 'start_date');
      set_session(end.format('YYYY-MM-DD'), 'end_date');

    });
  });
</script>

<script>
  /*  ==============================================code for select all check box===================================  */

  $('#select-all').on('click', function() {

    var checked = this.value
    var new_value = (checked == 0) ? '1' : '0'
    var new_text = (checked == 0) ? 'Deselect all' : 'Select all'
    var rows = table.rows().nodes();

    if (checked == '0') {
      $('input[type="checkbox"]', rows).prop('checked', true);
    } else {
      $('input[type="checkbox"]', rows).prop('checked', false);
    }
    $(this).val(new_value)
    $(this).text(new_text)
    checkbox()
  });

  $('.action_button').addClass('disabled');
  var action_button = $('.action_button')

  function checkbox() {
    var action_button = $('.action_button')


    var checked_array = []

    table.$('input[type="checkbox"]').each(function(eb) {
      if (this.checked) {
        checked_array.push(this.value)
      }
    });

    const allEqual = arr => arr.some(v => v === arr[0]);

    if (allEqual(checked_array) == true) {
      action_button.removeClass('disabled');
    } else {
      action_button.addClass('disabled');
      $('#action_drop_down').css('display', 'none')
    }
  }



  function change_select_dropdown(type) {
    var action_button = $('.action_button');

    if (type == 'active') {

      change_state(getselected_id(), '1');
      action_button.addClass('disabled');
      $('#action_drop_down').css('display', 'none')

    } else if (type == 'inactive') {

      change_state(getselected_id(), '0');
      action_button.addClass('disabled');
      $('#action_drop_down').css('display', 'none')

    } else {

      remove(getselected_id());
      action_button.addClass('disabled');
      $('#action_drop_down').css('display', 'none')

    }

  }



  function getselected_id() {

    var checked_array = []
    // Iterate over all checkboxes in the table
    table.$('input[type="checkbox"]').each(function(eb) {
      if (this.checked) {
        checked_array.push(this.value)
      }
    });

    if (checked_array.length > 0) {
      return checked_array
    } else {
      return ['0']
    }
  }
</script>

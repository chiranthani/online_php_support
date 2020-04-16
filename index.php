<?php include 'config.php'; ?>
<?php include 'template_start.php'; ?>
<?php
$user_id = 0;
$query = "SELECT
users.contact_no
FROM `users`
WHERE
users.user_id = '1'
";

$sql = mysqli_query($con_main, $query);

$type = mysqli_fetch_array($sql);
$user_id = $type['contact_no'];

?>
<!-- Page content -->
<div id="page-content">
    <!-- Blank Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-podium"></i>Demo<br>
            </h1>
        </div>
    </div>
    <!--End Blank Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                <div class="block-title">
                    <ul class="nav nav-tabs">
                        <div class="col-md-4">
                            <li>Header</a></li>
                        </div>
                    </ul>
                </div>

                <form id="form-header" name="form-header" method="post" class="form-horizontal form-bordered">

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">Name</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control OnlyText" id="name" name="name" placeholder="Name" required>
                        </div>
                        <label class="col-md-1 control-label" for="address">Address</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="email">Email</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="date">Date</label>
                        <div class="col-md-2">
                            <input type="text" id="date" name="date" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="phone_no">Telphone No</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control OnlyNumber" id="phone_no" name="phone_no" placeholder="phone_no" required>
                        </div>
                        <label class="col-md-2 control-label" for="age">Age</label>
                        <div class="col-md-1">
                            <input type="number" class="form-control" id="age" name="age" min="18" max="100" placeholder="Age" required>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-4">
                            <input type="hidden" class="form-control" id="uniqe_id" name="uniqe_id" value="0">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="header_datails" class="btn btn-primary primary-btn pull-right"><i class="fa fa-plus-circle"></i> Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Page content -->
<!------ Footer -------->
<footer class="clearfix">
    <div class="pull-left">
        Online Support Lectures - PHP
    </div>
    <div class="pull-right">
        DTInnovations - 17/04/2020
    </div>
</footer>
<!---- END Footer ---->

<?php include 'template_scripts.php'; ?>
<?php include  'template_end.php'; ?>
<script src="js/jquery.alphanum-master/jquery.alphanum-master/jquery.alphanum.js" type="text/javascript"></script>

<script type="text/javascript">
    //----------- start date validation ----------
    $('#date').datepicker({
     //  endDate: new Date()
        startDate: new Date()
    });
    //-----------end date validation ----------

    //-------- start numbers only validation -------
    $(".OnlyNumber").numeric({
        allowMinus: false,
        allowSpace: false,
        maxDigits: 10
    });
    //-------- end numbers only validation -------

    //------------ start text only validation -------
    $(".OnlyText").alphanum({
        allowNumeric: false,
        allowOtherCharSets: false
    });
    //------------ end text only validation -------

    //-------- start insert function --------------
    $('#form-header').validate({
        errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
        errorElement: 'div',
        errorPlacement: function(error, e) {
            e.parents('.form-group > div').append(error);
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
            $(e).closest('.help-block').remove();
        },
        success: function(e) {
            e.closest('.form-group').removeClass('has-success has-error');
            e.closest('.help-block').remove();
        },
        submitHandler: function() {

            var formdata = $('#form-header').serializeArray();

            $.ajax({
                url: 'backend/backend.php',
                data: formdata,
                method: 'post',
                beforeSend: function() {
                    $('#header_datails').button('loading');
                    NProgress.start();
                },
                complete: function() {
                    $('#header_datails').button('reset');
                    NProgress.done();
                },
                error: function(r) {},
                success: function(r) {
                    if (r.result) {
                        alert('Insert Success, User ID : '+ r.data);
                        $('#form-header').trigger('reset');
                    } else {
                        alert('Error');

                    }
                }
            });
        }
    });
    //------------------------ END INSERT FUNCTION --------------------

    //-------------------- start Insert function -------------------------------------------
    // $('#header_datails').on('click', function(e) {
    //     console.log('testing');

    //     var formdata = $('#form-header').serializeArray();

    //     console.log(formdata);
    //     $.ajax({
    //         url: 'backend/backend.php',
    //         data: formdata,
    //         method: 'post',
    //         beforeSend: function() {
    //             $('#header_datails').button('loading');
    //             NProgress.start();
    //         },
    //         complete: function() {
    //             $('#header_datails').button('reset');
    //             NProgress.done();
    //         },
    //         error: function(r) {},
    //         success: function(r) {
    //             if (r.result) {
    //                 alert('Success');

    //             } else {
    //                 alert('Error');

    //             }
    //         }
    //     });
    // });

    //-------------------- end Insert function -------------------------------------------
</script>
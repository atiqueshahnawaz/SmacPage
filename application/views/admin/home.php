<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smacpage Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/admin/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <style>
        .loginform {padding: 33px 25px 0px;}
        .loginform .form-control{
            border-radius: 0px;
            box-shadow:none;
            border:#ddd 1px solid;
        }
        .loginform .control-label {
            padding-top: 7px;
            margin-bottom: 0;
            text-align: right;
            text-transform: uppercase;
            font-size: 12px;
        }
        .loginform-content .panel-heading{
            padding:15px 0;
        }
        .loginform-content .panel-footer {
            background:#676565;
            color: #fff;
            font-size:13px;
            letter-spacing:0.5px;
            padding: 12px 15px;
            border-radius:0;
        }
        .loginform-content .panel-footer a{ color:#fff}
        .loginform-content .panel{ 
            border:none;
            border-radius:0;
            background: rgba(255, 255, 255, 0.78);
        }
        .loginform-content .checkbox {
            min-height: 27px;
            margin-top: -10px;
        }
        .loginform a{ color:#000}
        .redbtn {
            background-color:#00afeb;
            color:#fff;
            display: inline-block;
            text-transform: uppercase;
            font-size: 14px;
            font-family: "Open Sans";
            font-weight: 600;
            margin-right:5px;
            border-width: 2px;
            border-style: solid;
            border-color: #00afeb;
            border-image: initial;
            padding: 6px 16px;
            transition: all 0.5s linear;
        }
        .blackbtn {
            background-color: #333;
            border: #333 2px solid;
            color: #fff;
            padding: 6px 16px;
            display: inline-block;
            text-transform: uppercase;
            transition: all linear 0.5s;
            font-size: 14px;
            font-family: 'Open Sans';
            font-weight: 600;
        }
        .redbtn:hover, .blackbtn:hover{ color:#EAEAEA} 
    </style>
    <body style="background:url(../assets/admin/img/loginbg.jpg) no-repeat; background-size:cover">
        <div class="container">
            <div class="row">
                <div class="col-md-6 loginform-content">
                    <div class="login">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                            <!-- <img src="<?php //echo base_url(); ?>assets/admin/img/login-logo.png" class="center-block">  -->
                            <h2>Logo</h2>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal loginform" role="form" name="loginform" id="loginform" method="post" action="<?php echo base_url('admin'); ?>" autocomplete="off">
                                    <?php echo $message; ?>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo set_value('email'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php echo set_value('password'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <div class="g-recaptcha" data-sitekey="6LdgMB4UAAAAANk0mfdHRj61GZx1tD-nWg4l5YTm"></div>
                                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                        </div>
                                    </div>

                                    <div class="form-group last">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn redbtn btn-sm" id="btnSignin" name="btnSignin">Sign in</button>
                                            <button type="reset" class="btn blackbtn btn-sm">Reset</button>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="">
                                                <label><a href="javascript:void(0);" class="forgot-p">Forgot password?</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <form class="form-horizontal" role="form" name="forgot_password" id="forgot_password" method="post">
                                    <div class="forgotpassword">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Enter Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="forgotemail" name="forgotemail" placeholder="Enter Email ID">
                                            </div>
                                        </div>

                                        <div class="form-group last">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <div id="msg-forgot"></div>
                                                <button type="submit" class="btn redbtn btn-sm">Submit</button>
                                                <button type="reset" class="btn blackbtn btn-sm btn-close">Close</button>
                                            </div>    
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js_validation/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js_validation/validation.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $(document).ready(function () {
            $(".forgotpassword").hide();
            $(".forgot-p").click(function () {
                $(".forgotpassword").slideDown("slow");
            });
            $(".btn-close").click(function () {
                $(".forgotpassword").slideUp("slow");
            });

            jQuery("#forgot_password").validate({
                rules: {
                    forgotemail: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    forgotemail: {
                        required: "Enter email id",
                        email: "Invalid email id"
                    }
                },
                submitHandler: function (form) {
                    var forgotemail = $("#forgotemail").val();
                    if (forgotemail != '')
                    {
                        jQuery('#msg-forgot').html('<div style="text-align:center"><i style="color:#377b9e" class="fa fa-spinner fa-spin fa-3x"></i> <span style="color:#377b9e">Processing...</span></div>');
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>admin/home/forgot_email/?forgotemail=" + forgotemail,
                            success: function (res) {
                                jQuery("#msg-forgot").html(res);
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert("Status: " + textStatus + "\n" + "Error: " + errorThrown);
                            }
                        });
                        return false;
                    }
                    return false;
                }
            });
        });
    </script>
</html>

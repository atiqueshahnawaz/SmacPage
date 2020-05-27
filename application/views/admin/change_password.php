<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php"); ?>

</head>
<body class="hold-transition sidebar-mini">

	<?php include("header.php"); ?>

	<?php include("sidemenu.php"); ?>

	<div class="content-wrapper">
		<section class="content-header">
	   <div class="header-icon">
		  <i class="fa fa-lock"></i>
	   </div>
	   <div class="header-title">
		  <h1>Change Password</h1>
		  <small>Change Password</small>
	   </div>
	</section>
	<!-- Main content -->
	<section class="content">
	   <div class="row">

	   <div class="col-sm-6">
	   <div  style="margin-bottom: 25px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
background-color:#fff; padding:25px;border-radius: 4px;">
	<form method="post" name="change_password" id="change_password">

	 <?php echo $message; ?>

	  <div class="form-group">
		<label>Email ID</label>
		<input type="text" class="form-control" name="uname" id="uname" value="<?php echo $this->session->userdata('useremail'); ?>" readonly="readonly">
	  </div>

	  <div class="form-group">
		<label>New Password</label>
		<input type="password" class="form-control" placeholder="Enter new password" name="new_pwd" id="new_pwd" maxlength="20">
	  </div>

	  <div class="form-group">
		<label>Confirm Password</label>
		<input type="password" class="form-control" placeholder="Enter confirm password" name="cnf_pwd" id="cnf_pwd" maxlength="20">
	  </div>

	  <div class="reset-button">                                   
		  <button type="submit" class="btn redbtn" name="btnSubmit" id="btnSubmit">Save</button>
		  <button type="reset" class="btn blackbtn">Reset</button>
	  </div>

	</form>

	</div>
</div>

<div class="clearfix"></div>

</div>      
	</section>
 </div>

	<?php include("footer.php"); ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js_validation/jquery.validate.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js_validation/validation.js"></script>
</body>
</html>
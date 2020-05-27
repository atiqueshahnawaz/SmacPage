<?php
if(isset($row) && !empty($row))
{
	foreach ($row as $rows)
	{
		$service_id = $rows['service_id'];
		$service_name = $rows['service_name'];
		$page_url = $rows['page_url'];
		$description = $rows['description'];
	}
}
?>
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
				<i class="fa fa-caret-square-o-up"></i>
			</div>
			<div class="header-title">
				<h1>Services</h1>
				<small>Edit Services</small>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-bd lobidrag">
						<div class="panel-heading">
							<div class="btn-group" id="buttonexport">
								<a href="<?php echo base_url(); ?>admin/services">
									<h4><i class="fa fa-plus-circle"></i> Manage Services</h4>
								</a>
							</div>
						</div>
						
						<div class="panel-body">
							
							<?php echo $message; ?>
							<form class="" name="form_services" id="form_services" method="post" enctype="multipart/form-data">
								
								<div class="row">
                                    
									<div class="col-md-6"> 
										<div class="form-group">
											<label> Service Name</label>
											<input type="text" class="form-control" placeholder="Enter Service Name" name="service_name" id="service_name" value="<?php echo set_value('service_name',$service_name); ?>">
										</div>
                                        <div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									
									<div class="col-md-6"> 
										<div class="form-group">
											<label> Page Url</label>
											<input type="text" class="form-control" placeholder="Enter Url" name="page_url" id="page_url" value="<?php echo set_value('page_url',$page_url); ?>">
										</div>
                                        <div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="">
                                                <textarea id="editor" name="editor"><?php echo set_value('editor',$description); ?></textarea>
                                                <div id="editorerrorloc"></div>
                                            </div>
                                        </div>
                                    </div>
									<div class="clearfix m-b-15"></div>
									
									<div class="col-md-6">
										<div class="reset-button"> 
											<input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id; ?>">
											<button class="btn redbtn" type="submit" name="btnSubmit" id="btnSubmit">Save</button>
											<button class="btn blackbtn" type="button" onClick="window.location = '<?php echo base_url(); ?>admin/services'">Back</button> 
										</div>
									</div>
                                    <div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

  
	<?php include("footer.php"); ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js_validation/jquery.validate.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js_validation/additional-methods.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/admin/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script>
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace( 'editor');
		CKEDITOR.add
		CKEDITOR.config.contentsCss = [ "<?php echo base_url(); ?>assets/css/bootstrap.min.css" , "<?php echo base_url(); ?>assets/style.css" , "<?php echo base_url(); ?>assets/css/font-awesome.min.css" ];
	</script>
</body>
</html>
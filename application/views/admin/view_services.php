<?php
if(isset($row) && !empty($row))
{
	foreach ($row as $rows)
	{
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
				<small>View Services</small>
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
			
		<div class="view-page-txt">
		<div class="row">

			<div class=" col-md-6"> 
			<div class="row"> 
			<div class="col-md-4"> <label> Service Name</label></div>
			<div class="col-md-8">  <?php echo $service_name; ?></div>
			</div>
			</div>
			
			
			<div class=" col-md-6"> 
			<div class="row"> 
			<div class="col-md-4"> <label> Page Url</label></div>
			<div class="col-md-8">  <?php echo $page_url; ?></div>
			</div>
			</div>
		</div>
		<div class="clearfix"></div>
			
        <div class="row"> 
            <div class="col-md-2"> <label> Description</label></div>
            <div class="col-md-10"> <?php if($description!='') { echo $description; } else echo '-'; ?></div>
        </div>
		<div class="clearfix"></div>

		<div class="col-md-12">
			<div class="reset-button text-right"> 
				<button class="btn blackbtn" type="button" onClick="window.location='<?php echo base_url(); ?>admin/services'">Back</button>
			</div>
		</div>			
			
		</div>                    
		</div>
		</div>
		</div>
		</div>
		</section>
	</div>



	<?php include("footer.php"); ?>
	
</body>
</html>
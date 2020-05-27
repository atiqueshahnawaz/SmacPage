<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php"); ?>

      <link href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
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
				<small>Manage Services</small>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-bd lobidrag">
						<div class="panel-heading">
							<div class="btn-group" id="buttonexport">
								<a href="<?php echo base_url(); ?>admin/services/add">
									<h4><i class="fa fa-plus-circle"></i> Add Services</h4>
								</a>
							</div>
							<div class="clearfix"></div>

						</div>

						<div class="panel-body">
							<?php echo $message; ?>
							<div class="table-responsive">
								<table id="example" class="table table-bordered table-striped table-hover">
									<thead>
										<tr class="info">
											<th>Sl#</th>
											<th>Service Name</th>
											<th>Page Url</th>
											<th width="34%">Description</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$cnt = 0;
										if( !empty($row) )
										{
											foreach ($row as $rows)
											{
												$cnt++;
												$service_id = $rows['service_id'];
												$service_name = $rows['service_name'];
												$page_url = $rows['page_url'];
												$description = $rows['description'];
												$status = $rows['status'];
										?>
										<tr>
											<td><?php echo $cnt; ?></td>
											<td><?php echo $service_name; ?></td>
											<td><?php echo $page_url; ?></td>
											<td><?php echo $this->Common_model->short_str($description, 140); ?></td>
											<td>
												<?php if($status==1) { ?>
													<span class="status" data-id="<?php echo "status-".$service_id; ?>"><a href="javascript:void(0)" title="Status is active. Click here to make it inactive."><span class="label-custom label label-success">Active</span></a></span>
												<?php } else { ?>
													<span class="status" data-id="<?php echo "status-".$service_id; ?>"><a href="javascript:void(0)" title="Status is inactive. Click here to make it active."><span class="label-custom label label-danger">Inactive</span></a></span>
												<?php } ?>
											</td>
											<td>
												<a href="<?php echo base_url().'admin/services/edit/'.$service_id; ?>"  class="btn btn-success btn-sm edit" title="Edit"> <i class="fa fa-pencil"></i></a>

												<a href="<?php echo base_url().'admin/services/view/'.$service_id; ?>"  class="btn btn-primary btn-sm view" title="View"><i class="fa fa-eye"></i></a>

												<a onclick="return confirm('Are you sure to delete this service?')" href="<?php echo base_url().'admin/services/delete/'.$service_id; ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
								<div class="clearfix"></div>
							
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
	</div>


	<?php include("footer.php"); ?>

	<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable();
	});
	</script>
	<script type="text/javascript">
	$(document).on('click', '.status', function(){
		if(confirm('Are you sure to change the status?'))
		{
			var val = $(this).data("id");
			var valsplit = val.split("-");
			var id = valsplit[1];
			jQuery('[data-id='+val+']').after('<div class="spinner" style="text-align:center;color:#377b9e;"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
			$.ajax({
				url: "<?php echo base_url(); ?>admin/services/changestatus/"+id,
				type: 'post',
				cache: false,
				processData: false,
				success: function (data) {
					jQuery('.spinner').remove();
					if(data == 1) //Inactive
					{
						jQuery('[data-id='+val+']').html('<a href="javascript:void(0)" title="Status is inactive. Click here to make it active."><span class="label-custom label label-danger">Inactive</span></a>');
					}
					else if(data == 0) //Active
					{
						jQuery('[data-id='+val+']').html('<a href="javascript:void(0)" title="Status is active. Click here to make it inactive."><span class="label-custom label label-success">Active</span></a>');
					}
					else
					{
						alert("Sorry! Unable to change status.");
					}
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					alert("Status: " + textStatus + "\n" + "Error: " + errorThrown);
				}
			});
		}
	});
	</script>
	
</body>
</html>
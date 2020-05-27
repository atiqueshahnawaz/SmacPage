<!DOCTYPE html>
<html lang="en">	
	<head>
  		<?php $this->load->view('admin/head');  ?>
  		 <link href="<?php echo base_url(); ?>assets/admin/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">			
   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
        
		  	<?php $this->load->view('admin/header');  ?>
		  
		  	<?php $this->load->view('admin/sidemenu');  ?>
		  
       		<div class="content-wrapper">
	            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="header-title">
                  <h1>Master Module</h1>
                  <small>City</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                             
               <div class="col-sm-4">
               <div  style="margin-bottom: 25px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
       background-color:#fff; padding:25px;border-radius: 4px;">
            <form name="form_city" id="form_city" method="post">
             <?php echo $message; ?>
              <div class="form-group">
                <label>Country</label>
					<select class="form-control" name="country" id="country">
						<option value="0">-Select Country-</option>
						<?php
							$selcountry = set_value('country');
							echo $this->Common_model->populate_select($selcountry,"countryid","country_name","tbl_country","","country_name ASC");
						?>
					</select>
              </div>
              <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" placeholder="Enter city name" name="city_name" id="city_name" value="<?php echo set_value('city_name'); ?>">
              </div>
              <div class="reset-button">                                   
                  <button type="submit" class="btn redbtn" name="btnSubmit" id="btnSubmit">Save</button>
				  <button type="reset" class="btn blackbtn">Reset</button>
                 </div>
            </form>
            </div></div>


        <div class="col-sm-8">
        <div style="margin-bottom: 25px;box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
       background-color:#fff; padding:25px;border-radius: 4px;">
          <div class="panel">
                 <div class="panel-body">   
					 
                            <?php echo $m_message; ?>
					 
                           <div class="table-responsive">
                              <table id="example" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       	<th width="10%">Sl #</th>
										<th>Country</th>
                                       	<th>City</th>
                                       	<th>Status</th>
                                       	<th width="17%">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
									<?php
                                    $cnt = isset($startfrom) ? $startfrom : 0;
                                    if( !empty($row) )
                                    {
										foreach ($row as $rows)
										{
											$cnt++;
											$cityid = $rows['cityid'];
											$countryid = $rows['countryid'];
											$city_name = $rows['city_name'];
											$status = $rows['status'];
                                    ?>
                                    <tr>
										<td><?php echo $cnt; ?></td>
										<td><?php echo $this->Common_model->showname_fromid("country_name","tbl_country","countryid='$countryid'") ?></td>
										<td><?php echo $city_name; ?></td>
										<td>
											<?php if($status==1) { ?>
												<span class="status" data-id="<?php echo "status-".$cityid; ?>"><a href="javascript:void(0)" title="Status is active. Click here to make it inactive."><span class="label-custom label label-success">Active</span></a></span>
											<?php } else { ?>
												<span class="status" data-id="<?php echo "status-".$cityid; ?>"><a href="javascript:void(0)" title="Status is inactive. Click here to make it active."><span class="label-custom label label-danger">Inactive</span></a></span>
                                            <?php } ?>
										</td>
										<td>
											<a href="javascript:void(0)" data-id="<?php echo $cityid; ?>" class="btn btn-success btn-sm edit" title="Edit"><i class="fa fa-pencil"></i></a>
											<a onClick="return confirm('Are you sure to delete this city?')" href="<?php echo base_url().'admin/city/delete/'.$cityid; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i> </a>
										</td>
									 </tr>
									 <?php
										}
                                    }
                                    else
                                    {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="5"> No data available in table </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                 </tbody>
                              </table>
							   
                           </div>
                        </div>
             </div></div></div><div class="clearfix"></div>
           
        </div>      
            </section>
         </div>
         <?php $this->load->view('admin/footer');  ?>
      </div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			</div>

		</div>
	</div>
	   
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js_validation/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js_validation/master_module.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
 <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>
<script type="text/javascript">
$(document).on('click', '.edit', function(){
	jQuery('#myModal .modal-content').html('<div style="text-align:center;margin-top:150px;margin-bottom:100px;color:#377b9e;"><i class="fa fa-spinner fa-spin fa-3x"></i> <span>Processing...</span></div>');
	var val = $(this).data("id");
	$.ajax({
		url: "<?php echo base_url(); ?>admin/city/edit_pop/"+val,
		type: 'post',
		cache: false,
		processData: false,
		success: function (modal_content) {
			jQuery('#myModal .modal-content').html(modal_content);
			// LOADING THE AJAX MODAL
			$('#myModal').modal('show');
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			alert("Status: " + textStatus + "\n" + "Error: " + errorThrown);
			$('#errMessage').html('<div class="errormsg"><i class="fa fa-times"></i> Your query could not executed. Please try again.</div>');
		}
	});
});
$(document).on('click', '.status', function(){
	if(confirm('Are you sure to change the status?'))
	{
		var val = $(this).data("id");
		var valsplit = val.split("-");
		var id = valsplit[1];
		jQuery('[data-id='+val+']').after('<div class="spinner" style="text-align:center;color:#377b9e;"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
		$.ajax({
			url: "<?php echo base_url(); ?>admin/city/changestatus/"+id,
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
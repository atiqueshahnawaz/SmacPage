<?php
$service_id = NULL;$service_name = NULL;$description = NULL;
if(isset($row) && !empty($row))
{
	foreach ($row as $rows)
	{
		$service_id = $rows['service_id'];
		$service_name = $rows['service_name'];
		$description = $rows['description'];
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php"); ?>
</head>
<body>
	
	<?php include("menu.php"); ?>
	
	
	<main id="main">
        <section id="about" class="about">
            <div class="container">
                <div class="row">
					<div class="col-md-12">
						<?php echo $description; ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
		<div class="clearfix"></div>

	</main>
	
	<?php include("footer.php"); ?>
	
</body>
</html>
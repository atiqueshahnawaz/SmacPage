<?php
$page_desc = $this->Common_model->showname_fromid("page_content","tbl_contents","content_id=7","");
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
						<?php echo $page_desc; ?>
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
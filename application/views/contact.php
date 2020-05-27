<?php
$page_desc = $this->Common_model->showname_fromid("page_content", "tbl_contents", "content_id=5", "");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("head.php"); ?>
</head>

<body>

	<?php include("menu.php"); ?>


	<section id="contact" class="contact section-bg">

		<div class="container" data-aos="fade-up">

			<div class="section-title">

				<h2>Contact</h2>

				<p>If you desire to know more about our business or have queries on a specific service or support, then feel free to reach us on the below given details. We will respond to you immediately. For details, you can visit our contact us page, to find more.</p>

			</div>



			<div class="row">

				<div class="col-lg-6">

					<div class="info-box mb-4">

						<i class="bx bx-map"></i>

						<h3>Our Address</h3>

						<p>Bankers Enclave, Lane No: 7, Plot No: BE 59, near Prachi Vihar, Palasuni, Bhubaneswar, Odisha 751010</p>

					</div>

				</div>



				<div class="col-lg-3 col-md-6">

					<div class="info-box  mb-4">

						<i class="bx bx-envelope"></i>

						<h3>Email Us</h3>

						<p>info@Smacpage.com</p>

					</div>

				</div>



				<div class="col-lg-3 col-md-6">

					<div class="info-box  mb-4">

						<i class="bx bx-phone-call"></i>

						<h3>Call Us</h3>

						<p>+91 7735013123</p>

					</div>

				</div>



			</div>



			<div class="row">



				<div class="col-lg-6 ">

					<iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d239486.6341958169!2d85.68036489068385!3d20.301150447781467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1909d2d5170aa5%3A0xfc580e2b68b33fa8!2sBhubaneswar%2C%20Odisha!5e0!3m2!1sen!2sin!4v1588852733900!5m2!1sen!2sin" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>



				</div>



				<div class="col-lg-6">

					<form action="forms/contact.php" method="post" role="form" class="php-email-form">

						<div class="form-row">

							<div class="col-md-6 form-group">

								<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />

								<div class="validate"></div>

							</div>

							<div class="col-md-6 form-group">

								<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />

								<div class="validate"></div>

							</div>

						</div>

						<div class="form-group">

							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />

							<div class="validate"></div>

						</div>

						<div class="form-group">

							<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>

							<div class="validate"></div>

						</div>

						<div class="mb-3">

							<div class="loading">Loading</div>

							<div class="error-message"></div>

							<div class="sent-message">Your message has been sent. Thank you!</div>

						</div>

						<div class="text-center"><button type="submit">Send Message</button></div>

					</form>

				</div>



			</div>



		</div>

	</section>
	
	<div style="margin-top: 20px;margin-bottom: 20px; clear:both;"></div>

	<?php include("footer.php"); ?>

</body>

</html>
    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Comments</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php include("bar.php"); ?>
  <!-- Begin Container -->
  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>Your Comments &amp; Views Are Valuable For Us</h1>
	
	</div>

</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container floated">

	<!-- Sidebar -->
	<div class="four floated  left">
		<aside class="sidebar padding-reset">

			<div class="widget">
				<h4>Information</h4>
				<a href="https://www.facebook.com/usindhexam"> <img src="facebook.jpg" ></a>
				</div>

			<div class="widget">
				<h4>General Inquiries</h4>

				<ul class="contact-informations">
					<li><span class="address">New Examination Building</span></li>
					<li><span class="address">University of Sindh, Allama I.I.Kazi Campus, Jamshoro-76080, Sindh, Pakistan.</span></li>
				</ul>

				<ul class="contact-informations second">
					<li><i class="halflings headphones"></i> <p>+92-31-23188231</p></li>
					<li><i class="halflings envelope"></i> <p>exam@usindh.edu.pk</p></li>
					<li><i class="halflings globe"></i> <p>exam.usindh.edu.pk</p></li>
				</ul>

			</div>

			<div class="widget">
				<h4>Business Hours</h4>
				<ul class="contact-informations hours">
					<li><i class="halflings time"></i>Monday - Friday <span class="hours">8 am to 4 pm</span></li>
					<li><i class="halflings time"></i>Saturday <span class="hours">Closed</span></li>
					<li><i class="halflings ban-circle"></i>Sunday <span class="hours">Closed</span></li>
				</ul>
			</div>

		</aside>
	</div>
	<!-- Sidebar / End -->

	<!-- Page Content -->
	<div class="eleven floated">
		<section class="page-content">



			

				<!-- Contact Form -->
				<section id="contact">

					<!-- Success Message -->
					<mark id="message"></mark>

					<!-- Form -->
					<form action="../save_comments.php" method="post" name="contactform" id="contactform">

						<fieldset>

							<div>
								<label for="option" accesskey="U">Select:</label>
									<select name="MessageType" ><option>Complain</option><option>Question &amp; Queries</option><option>Suggestions</option><option>Appreciation</option> </select></br>
								</div>

								<div>
								<label for="name" accesskey="U">Name:<span>*</span></label>
										<input name="UserName"  type="text" required placeholder="User Name"/></br>
	
							</div>
									

							<div>
								<label for="email" accesskey="E"> Email : <span></span></label>
								
	
								<input name="UserEmail" type="email" id="email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" />
							</div>
							
							<div>
								<label for="cell" accesskey="U">Cell No: <span></span></label>
								
	
										<input name="UserTel"  type="text" placeholder="User Contact No:"/>
							</div>
							<div>
								<label for="Subject" accesskey="U">Subject: <span></span></label>
								
	
									<input name="Subject"  type="text" required placeholder="subject"/>
							</div>

				
			

							<div>
								<label for="comments" accesskey="C">Message: <span>*</span></label>
								<textarea name="Comments" cols="40" rows="3" id="comments" spellcheck="true" placeholder="comment here.." required></textarea>
							</div>

						</fieldset>

						<input type="submit" class="submit" id="submit" value="Send Message" />
						<div class="clearfix"></div>

					</form>

				</section>
				<!-- Contact Form / End -->


		</section>
	</div>
	<!-- Page Content / End -->


</div>
<!-- 960 Container / End -->

</div>
<!-- Content / End -->

</div>
<!-- Wrapper / End -->
<?php
include("footer.php");

?>
<html>
	<head>
        <?php  ?>
		<title>Verify Email - BloodGrant.ph</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
		<script src="<?php echo base_url()?>assets/js/jqv1.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
		
	</head>
	<body>
        
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>						
					<a class="navbar-brand" href="<?php echo base_url(); ?>UsersController/unverifiedemail">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url();?>UsersController/unverifiedemail"><?php echo $_SESSION['user_fullname'];?></a></li>
						<li><a href="<?php echo base_url();?>UsersController/user_logout">Logout</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->

		<div class="container-fluid"><!-- container-fluid -->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<?php 
						if(isset($_SESSION['emailsuccess']))
						{
							echo '<div class="alert alert-success alert-dismissible" role="alert">';
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="close" id="close_notification"><span aria-hidden="true">&times;</span></button>';
							echo '<strong>Success!</strong> message verification is sent to your email';
							echo '</div>';
						}
					?>
				</div>
			</div>
		</div><!-- end container fluid-->


		<div class="container-fluid">
			<div class="jumbotron">
				<h1>
					Hello <?php echo $_SESSION['user_firstname'];?>!
				</h1>
				<p>
					It seems that your email address has not been verified yet. Click <a href="<?php echo base_url();?>UsersController/resend_email_verification">here</a> to resend the email verification
				</p>

			</div>
		</div>
        <div class="bg_load"></div>
        <div class="wrapper">
            <div class="inner text-danger">
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                
            </div>
        </div>


		<script>
			
			$(function() {
				$('#close_notification').click(function(){
					<?php unset($_SESSION['emailsuccess']); ?>
				});

		</script>
        
<script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
<html>
	<head>
		<title>Reset Password - Admin</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
		<script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
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
					<a class="navbar-brand" href="<?php echo base_url(); ?>AdminController">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url();?>AdminController/login">Login</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->

		<form action="<?php echo base_url();?>AdminController/send_password_reset" method="POST">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h2>Password Reset <strong><small>Admin</small></strong>
					<hr class="colorgraph"/>
				</div>
				<div class="col-md-2"></div>
			</div><!-- end row-->
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<p class="text-info">
						<strong>Reset your password through email</strong>
					</p>
				</div>
				<div class="col-md-3"></div>
			</div><!-- end row -->
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<input type="radio" name="sendMessage" value="checkedSend" checked/> Send a message to <?php echo $account->admin_email;?>
						</div>
						<div class="col-md-6 text-center">
							<?php echo $account->admin_firstname.' '.$account->admin_lastname;?>
						</div>
					</div><!-- end row -->
				</div>
				<div class="col-md-3"></div>
			</div><!-- end row -->
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<input type="email" class="hidden" name="adminEmail" value="<?php echo $account->admin_email?>">
				</div>
				<div class="col-md-3"></div>
			</div><!-- end row -->
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<hr class="colorgraph"/>
				</div>
				<div class="col-md-2"></div>
			</div><!-- end row -->
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="form-control btn btn-primary">Continue</button>
						</div>
						<div class="col-md-6">
							<a class="form-control btn btn-default" href="<?php echo base_url();?>AdminController/not_me">Not you?</a> 
						</div>
					</div><!-- end row -->
				</div>
				<div class="col-md-3"></div>
			</div><!-- end row -->
		</div><!-- end container-fluid -->
		</form>

	</body>
</html>
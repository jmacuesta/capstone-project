<html>
	<head>
		<title>Reset Password - BloodGrant.ph</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css".>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css".>
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

		<div class="container-fluid">
			<form action="<?php echo base_url();?>AdminController/reset_password" method="POST">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<h2>Reset your password</h2>
						<hr class="colorgraph"/>
					</div>
					<div class="col-md-2"></div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alert alert-info" role="alert">
							<?php
								echo $admininfo['0']->admin_firstname.' '.$admininfo['0']->admin_lastname;
							?>
						</div>
					</div>
					<div class="col-md-3"></div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<input type="email" class="form-control hidden" name="adminEmail" placeholder="Email" value="<?php echo $admininfo['0']->admin_email?>">
					</div>
					<div class="col-md-3"></div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="row">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label for="adminPassword"><strong>Type your new password</strong></label>
										<input type="password" name="adminPassword" class="form-control" placeholder="New Password" value="<?php echo set_value('adminPassword');?>">
										<?php echo form_error('adminPassword');?>
									</div><!-- end 12 col -->
								</div><!-- end row -->
							</div><!-- end from group -->

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label for="adminConfirmPassword"><strong>Type your new password one more time</strong></label>
										<input type="password" name="adminConfirmPassword" class="form-control" placeholder="Confirm New Password" value="<?php echo set_value('adminConfirmPassword');?>">
										<?php echo form_error('adminConfirmPassword');?>
									</div><!-- end 12 columns -->
								</div><!--end row -->
							</div><!-- end form group -->
						</div><!-- end row -->
					</div><!-- end 6 col -->
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
					<div class="col-md-3">
						<button type="submit" class="form-control btn btn-primary">
							Submit
						</button>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-3"></div>
				</div>
			</form>
		</div><!-- end container fluid -->
	</body>
</html>
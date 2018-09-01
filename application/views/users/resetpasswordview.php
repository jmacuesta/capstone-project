<html>
	<head>
		<title>Reset Password - BloodGrant.ph</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css".>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css".>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
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
					<a class="navbar-brand" href="<?php echo base_url(); ?>">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url();?>UsersController/register">Register</a></li>
						<li><a href="<?php echo base_url();?>UsersController/login">Login</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
		<div class="container-fluid">
			<form action="<?php echo base_url();?>UsersController/reset_user_password" method="POST">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h2>Reset your password</h2>
						<hr class="colorgraph"/>
					</div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="alert alert-info" role="alert">
							<?php
								echo $userinfo->users_firstname.' '.$userinfo->users_lastname;
							?>
						</div>
					</div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="row">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label for="usersPassword"><strong>Type your new password</strong></label>
										<input type="password" name="usersPassword" class="form-control" placeholder="New Password" value="<?php echo set_value('usersPassword');?>">
										<?php echo form_error('usersPassword');?>
									</div><!-- end 12 col -->
								</div><!-- end row -->
							</div><!-- end from group -->

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label for="usersConfirmPassword"><strong>Type your new password one more time</strong></label>
										<input type="password" name="usersConfirmPassword" class="form-control" placeholder="Confirm New Password" value="<?php echo set_value('usersConfirmPassword');?>">
										<?php echo form_error('usersConfirmPassword');?>
									</div><!-- end 12 columns -->
								</div><!--end row -->
							</div><!-- end form group -->
						</div><!-- end row -->
					</div><!-- end 6 col -->
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<hr class="colorgraph"/>
					</div>
				</div><!-- end row -->
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<button type="submit" class="form-control btn btn-primary">
							Submit
						</button>
					</div>
				</div>
			</form>
		</div><!-- end container fluid -->
        <div class="bg_load"></div>
        <div class="wrapper">
            <div class="inner text-danger">
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                
            </div>
        </div>


<script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
	
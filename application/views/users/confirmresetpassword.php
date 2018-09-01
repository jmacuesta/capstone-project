<html>
	<head>
		<title>Recover Password - BloodGrant.ph</title>
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
			<div class="row">
				<form action="<?php echo base_url();?>UsersController/reset_email_sent" method="POST">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
						<h2><small>Reset your password</small></h2>
						<hr class="colorgraph"/>
						</div>
					</div>
                    
					<div class="row">
						<div class="col-md-4 col-md-offset-3">
							<p class="text-info"><strong>Reset your password through email</strong></p>
						</div>
					</div><!-- end row -->

					<div class="row">
						<div class="col-md-4 col-md-offset-3">
							<input type="radio" name="sendMessage" value="checkedSend" checked/> Send a message to <?php echo $userinfo->users_email;?>
							<?php echo form_error('sendMessage');?>
						</div>
						<div class="col-md-2">
							<?php
								echo $userinfo->users_firstname.' '.$userinfo->users_lastname;
							?>
						</div>
					</div><!-- end row -->					

					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<hr class="colorgraph"/>
						</div>
					</div><!-- end row -->

					<div class="row">
						
						<div class="col-md-3 col-md-offset-3">
							
							<button type="submit" class="form-control btn btn-primary">
								Continue
							</button>
						</div>
						<div class="col-md-3">
							<a class="form-control btn btn-default" href="<?php echo base_url();?>UsersController/not_me" role="button">
								Not you?
							</a>
						</div>
                        
					</div><!-- end row -->
				</form><!-- end form -->
			</div><!-- end row -->
		</div><!--end container-fluied -->
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
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
				<form action="<?php echo base_url();?>UsersController/send_password_reset" method="POST">
					<div class="row">
						
						<div class="col-md-8 col-md-offset-2">
						<h2>Find your account<small> Password Reset</small></h2>
						<hr class="colorgraph"/>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group">
								<?php echo form_error('emailtoken');?>
								<?php
									$line1='<div class="alert alert-danger alert-dismissible" role="alert">';
									$line2='<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>';
									$line3='<span class="glyphicon glyphicon-exclamation-sign"></span>';
									$line4='</div>';
									if(isset($noemail))
									{
										echo $line1;
										echo $line2;
										echo $line3;
										echo $message;
										echo $line4;
									}
								?>
								<p class="text-info">Enter your email</p>
								<div class="input-group">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</span>
									<input type="email" class="form-control" name="emailtoken"placeholder="E-Mail" value="<?php echo set_value('emailtoken');?>"/>
								</div><!-- end input group -->

							</div><!-- end form-group -->
						</div>
					</div><!-- end row -->

					<div class="row">
						
						<div class="col-md-8 col-md-offset-2">
							<hr class="colorgraph"/>
						</div>
					</div><!-- end row -->

					<div class="row">
						
						<div class="col-md-3 col-md-offset-3">
							<button type="submit" class="form-control btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
								Search
							</button>
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
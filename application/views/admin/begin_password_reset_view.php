<html>
	<head>
		<title>Reset password - Admin</title>
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

		<div class="container-fluid">
			<div class="row">
				<form action="<?php echo base_url();?>AdminController/send_password_reset_view" method="POST">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<h2>Password reset <strong><small>Admin</small></strong></h2>
							<hr class="colorgraph"/>
						</div>
						<div class="col-md-2"></div>
					</div><!--end row -->
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<?php 
								$line1='<div class="alert alert-danger alert-dismissible" role="alert">';
								$line2='<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>';
								$line3='<span class="glyphicon glyphicon-exclamation-sign"></span>';
								$line4='</div>';
								if(isset($invalidemail)){
									echo $line1;
									echo $line2;
									echo $line3;
									echo $message;
									echo $line4;
								}
							?>
						</div>
						<div class="col-md-3"></div>
					</div>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<?php echo form_error('adminEmail');?>
									</div>
								</div><!-- end row -->
								<div class="row">
									<div class="col-md-12">
										<label for="adminEmail">Enter your email address</label>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-envelope"></span>
											</span>
											<input type="email" name="adminEmail" class="form-control" placeholder="E-Mail Address" value="<?php echo set_value('adminEmail');?>"/>
										</div><!-- end input group -->
									</div>
								</div><!--end row-->
							</div><!-- end form-group -->
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
									<button type="submit" class="form-control btn btn-default">
										<span class="glyphicon glyphicon-search"></span> Search
									</button>
								</div>
							</div><!-- end row -->
						</div>
						<div class="col-md-3"></div>
					</div><!-- end row -->
				</form><!-- end form -->
			</div><!-- end row -->
		</div><!-- end container fluid -->
	</body>
</html>
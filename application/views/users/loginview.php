<html>
	<head>
		<title>Login - BloodGrant.ph</title>
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
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?php echo base_url();?>UsersController/aboutview">About</a></li>
                        <li><a href="<?php echo base_url();?>FaqsController">FAQs</a></li>
                    </ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url();?>UsersController/register">Register</a></li>
						<li class="active"><a href="<?php echo base_url();?>UsersController/login">Login</a></li>
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
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>';
							echo '<strong>Success!</strong> message verification is sent to your email';
							echo '</div>';
                            unset($_SESSION['emailsuccess']);
						}
                        if($this->session->flashdata('verified')){
                            echo $this->session->flashdata('limiter');
                            echo $this->session->flashdata('message');
                            echo $this->session->flashdata('delimiter');
                        }
                    ?>
				</div>
			</div>
		</div><!-- end container fluid-->

		<div class="container-fluid"><!-- container-fluid -->
			<div class="row"><!-- start outer row -->
				<form action="<?php echo base_url();?>UsersController/login_user" method="POST"><!-- form open -->
				<div class="row"><!-- start inner row 1 -->
					
					<div class="col-md-4 col-md-offset-4"><!-- 8 columns -->
						<h2>Please Login to BloodGrant.ph</h2>
						<hr class="colorgraph"/>
					</div><!-- end 8 columns -->
				</div><!-- end inner row 1 -->
                    
				<div class="row"><!-- start inner row 2 -->
					
					<div class="col-md-4 col-md-offset-4"><!-- start 6 columns -->
						<div class="form-group"><!-- email form field -->
							<label for="usersEmail">E-Mail Address</label>
							<div class="row"><!-- start row 1 inside inner row 2 -->
								<div class="col-md-12"><!-- 12 columns -->
									<input type="email" class="form-control" name="usersEmail" placeholder="E-Mail Address" value="<?php echo set_value('usersEmail')?>"> 
									<?php echo form_error('usersEmail');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 1 inside inner row 2 -->
						</div><!-- end email form field -->
                        
						<div class="form-group"><!-- password form field -->
							<label for="usersPassword">Password</label>
							<div class="row"><!-- start row 2 inside inner row 2 -->
								<div class="col-md-12"><!-- 12 columns -->
									<input type="password" class="form-control" name="usersPassword" placeholder="Password" value="<?php echo set_value('usersPassword')?>">
									<?php echo form_error('usersPassword');?>
                                    <p class="text-right">
                                        <a href="<?php echo base_url();?>UsersController/begin_password_reset" class="nounderline">
                                            Forgot your password?
                                        </a>
                                    </p>
								</div><!-- end 12 columns -->
							</div><!-- end row 2 inside inner row 2 -->
						</div><!-- end password form field -->
					</div><!-- end 6 columns -->
				</div><!-- end inner row 2 -->

				

				<div class="row">
					
					<div class="col-md-4 col-md-offset-4">
						<?php
							$line1='<div class="alert alert-warning alert-dismissible" role="alert">';
							$line0='<div class="alert alert-success alert-dismissible" role="alert">';
							$line2='<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>';
							$line3='<span class="glyphicon glyphicon-exclamation-sign"></span>';
							$line4='</div>';
							if(isset($noemail)){
								echo $line1;
								echo $line2;
								echo $line3;
								echo $message;
								echo $line4;
							}
							elseif(isset($wrongpassword)){
								echo $line1;
								echo $line2;
								echo $line3;
								echo $message;
								echo $line4;
							}elseif(isset($success)){
								echo $line0;
								echo $line2;
								echo $line3;
								echo $msg;
								echo $line4;
							}	
						?>
					</div> <!-- messages -->
				</div>

				<div class="row"><!-- start inner row 3 -->
					
					<div class="col-md-4 col-md-offset-4"><!-- start 8 columns -->
						<hr class="colorgraph"/>
					</div><!-- end 8 columns -->
					
				</div><!-- end inner row 3 -->
                    
				<div class="row"><!-- start inner row 4 -->
					
					<div class="col-md-6 col-md-offset-3"><!-- start 6 columns -->
						<div class="row"><!-- start row 1 inside inner row 4 -->
							<div class="col-md-4 col-md-offset-4"><!-- start 6 columns -->
								<div class="form-group"><!-- start form group -->
									<button type="submit" class="form-control btn btn-primary" id="submit">
									<span class="glyphicon glyphicon-ok"></span> Login
									</button>
								</div><!-- end form group -->
							</div><!-- end 6 columns -->
                            
							
						</div><!-- end row 1 inside inner row 4 -->
					</div><!-- end 6 columns -->
                    
				</div><!-- end inner row 4 -->
				</form><!-- end form -->
			</div><!-- end outer row -->
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
        

<script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
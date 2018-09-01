<html>
	<head>
		<title>Registration - BloodGrant.ph</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jqui/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
		<script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
		<script src="<?php echo base_url();?>assets/js/jqv2.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>	
		<script src="<?php echo base_url();?>assets/jqui/jquery-ui.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
		
		<script>
			
			$(function() {
				$('#buttondatepicker').click(function(){
					$("#datepicker").datepicker("show");
				});
				$( "#datepicker" ).datepicker({
					showAnim: "fadeIn",
					changeMonth: true,
					changeYear: true,
					dateFormat: "yy-mm-dd",
					showButtonPanel: true,
                    yearRange: "-70:+0"

				});
			});
		</script>
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
						<li class="active"><a href="<?php echo base_url();?>UsersController/register">Register</a></li>
						<li><a href="<?php echo base_url();?>UsersController/login">Login</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->

		<div class="container-fluid"><!--start container fluid-->
			<div class="row"><!-- start outer row -->
				<form action="<?php echo base_url();?>UsersController/register_user" method="POST"><!--start form-->
				<div class="row"><!-- start inner row 1 -->
					<div class="col-md-10 col-md-offset-1"><!-- start 8 columns -->
						<h2>Please Sign up to BloodGrant.ph <small>It's Free!</small></h2>
						<hr class="colorgraph"/>
					</div><!-- end 8 columns -->
				</div><!-- end inner row 1 -->
				<div class="row"><!-- start inner row 2 -->
					<div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
							<p class="text-danger">fields with <span class="glyphicon glyphicon-asterisk"></span> are required</p>
						</div>
                    </div>
                    <div class="col-md-1"></div>
					<div class="col-md-5 col-md-offset-1"><!-- start 6 columns -->	
                        <div class="well">
                            <div class="form-group"><!-- start email form field -->
							<label for="usersEmail">E-Mail Address <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- row 1 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<input type="email" class="form-control" name="usersEmail" placeholder="E-Mail" value="<?php echo set_value('usersEmail');?>">
									<?php echo form_error('usersEmail');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 1 inside inner row 2 -->
						</div><!-- end email form field -->

						<div class="form-group"><!-- start password form field -->
							<label for="usersPassword">Password <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 2 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<input type="password" class="form-control" name="usersPassword" placeholder="Password" value="<?php echo set_value('usersPassword');?>">
									<?php echo form_error('usersPassword');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 2 inside inner row 2 -->
						</div><!-- end password form field -->

						<div class="form-group"><!-- start confirm password form field -->
							<label for="usersConfirmPassword">Confirm Password <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 3 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<input type="password" class="form-control" name="usersConfirmPassword" placeholder="Confirm Password" value="<?php echo set_value('usersConfirmPassword');?>">
									<?php echo form_error('usersConfirmPassword');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 3 inside inner row 2 -->
						</div><!-- end confirm password form field -->

						<div class="form-group"><!-- start name form field -->
							<label for="usersName">Name <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 4 inside inner row 2 -->
								<div class="col-md-6"><!-- start 6 columns -->
									<input type="text" class="form-control" name="usersFirstName" placeholder="First Name" value="<?php echo set_value('usersFirstName');?>">
									<?php echo form_error('usersFirstName');?>
								</div><!-- end 6 columns -->
								<div class="col-md-6"><!-- start 6 columns -->
									<input type="text" class="form-control" name="usersLastName" placeholder="Last Name" value="<?php echo set_value('usersLastName');?>"?>
									<?php echo form_error('usersLastName');?>
								</div><!-- end 6 columns -->
							</div><!-- end row 4 inside inner row 2 -->
						</div><!-- end name form field -->

						<div class="form-group"><!-- start gender form field -->
							<label for="usersGender">Sex <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 5 inside inner row 2 -->
								<div class="col-md-6"><!-- start 6 columns-->
									<div class="input-group"><!-- start input group -->										
										<span class="input-group-addon"><!-- add radio button to male -->
											<input type="radio" name="usersGender" value="Male" <?php echo set_radio('usersGender','Male');?>>
										</span><!-- end span> -->
										<input type="text" class="form-control" value="Male" readonly/>
									</div><!-- end input group -->
								</div><!-- end 6 columns-->
								<div class="col-md-6"><!-- start 6 columns-->
									<div class="input-group"><!-- start input group -->
										<span class="input-group-addon"><!-- add radio button to female -->
											<input type="radio" name="usersGender" value="Female" <?php echo set_radio('usersGender','Female');?>>
										</span>
										<input type="text" class="form-control" value="Female" readonly/>
									</div><!-- end input group -->
								</div><!-- end 6 columns-->
								<div class="col-md-12"><!-- start 12 columns -->
									<?php echo form_error('usersGender');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 5 inside inner row 2 -->
						</div><!-- end gender form field -->
                        </div>
				    </div><!-- end 6 columns -->
                    <div class="col-md-5"><!-- start 6 columns -->	
						<div class="well">
                            <div class="form-group"><!-- start contact number form field -->
							<label for="usersPhoneNumber">Mobile Contact Number <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 6 inside inner row 2 -->
								<div class="col-md-12"> <!-- start 12 columns -->
									<div class="input-group"><!-- start add on group-->
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
											+63
										</span>
										<input type="text" class="form-control" name="usersContactNumber" placeholder="XXXXXXXXXX" value="<?php echo set_value('usersContactNumber');?>">
									</div><!-- end add on group -->
									<p class="help-block">e.g. +63(9123456780)</p>
									<?php echo form_error('usersContactNumber');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 6 inside inner row 2 -->
						</div><!-- end contact number form field -->

						<div class="form-group"><!-- start date of birth form field -->
							<label for="usersDoB">Birthday <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 7 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<div class="input-group">
										<span class="input-group-addon">
											<button type="button" id="buttondatepicker" role="button">
												<span class="glyphicon glyphicon-calendar"></span>
											</button>
										</span>
										<input type="text" class="form-control" id="datepicker" name="usersDOB" readonly placeholder="YYYY-MM-DD" value="<?php echo set_value('usersDOB');?>"/>
									</div>
									<p class="help-block">Click on the button to show the calendar</p>
									<?php echo form_error('usersDOB');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 7 inside inner row 2 -->
						</div><!-- end date of birth form field -->

						<div class="form-group"><!-- start area form field-->
							<label for="usersArea">Area <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 8 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<select class="form-control" name="usersArea" placeholder="Select your area" value="<?php echo set_value('usersArea');?>">
										<option value="" selected disabled>Please select</option>
										<?php
											foreach($regionlist as $regionlistrow)
											{
												echo'<option value="" disabled>----'.$regionlistrow->region_name.'----</option>';
												foreach($arealist as $arealistrow)
												{
													if($arealistrow->area_regionshorthand===$regionlistrow->region_shorthand)
													{
														echo '<option value="'.$arealistrow->area_name.'" '.set_select('usersArea',$arealistrow->area_name).'>'.$arealistrow->area_name.'</option>';
													}
												}
											}
										?>
									</select>
									<?php echo form_error('usersArea');?>
								</div><!-- end  12 columns -->
							</div><!-- end row 8 inside inner row 2 -->
						</div><!-- end area form field -->

						<div class="form-group"><!-- start bloodtype form field -->
							<label for="usersBloodType">Blood Type <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
							<div class="row"><!-- start row 9 inside inner row 2 -->
								<div class="col-md-12"><!-- start 12 columns -->
									<select class="form-control" name="usersBloodType" placeholder="Select your blood type" value="<?php echo set_value('usersBloodType');?>">
										<option value="" selected disabled>Please select</option>
										<?php
											foreach($bloodtypeslist as $row)
											{
												echo '<option value="'.$row->name.'" '.set_select('usersBloodType',$row->name).'>'.$row->name.'</option>';
											}
										?>
										<option value="UNK" <?php echo set_select('usersBloodType','UNK')?> >I do not know, but I will update when I find out</option>
									</select>
									<?php echo form_error('usersBloodType'); ?>
								</div><!-- end 12 columns -->
							</div><!-- end row 9 inside inner row 2 -->
						</div><!-- end bloodtype form field -->
                        </div>

					</div><!-- end 6 columns -->
                    
				</div><!-- end inner row 2 -->
				<div class="row"><!-- start inner row 3 -->
					
					<div class="col-md-10 col-md-offset-1"><!-- start 8 columns -->
                        <div class="form-group"><!-- start terms and conditions form field -->
							
							<div class="row"><!-- start row 10 inside inner row 2 -->
								<div class="col-md-8 col-md-offset-2"><!-- start 12 columns -->
									<div class="input-group"><!-- start input group-->
										<span class="input-group-addon">
											<input type="checkbox" name="usersAgreeTaC" value="AgreeTaC" <?php echo set_checkbox('usersAgreeTaC','AgreeTaC');?>> I Agree
										</span>
										<p class="form-control" readonly>I agree with the <a href="#" data-toggle="modal" data-target="#t_and_c_m">terms and conditions</a></p>										
									</div><!-- end input group-->
									<?php echo form_error('usersAgreeTaC');?>
								</div><!-- end 12 columns -->
							</div><!-- end row 10 inside inner row 2 -->
                        </div><!-- end terms and conditions form fields -->
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="form-group">
                                        <?= $this->recaptcha->render();?>
                                    </div>
                                </div>
                            </div>
						
						<hr class="colorgraph"/>
					</div><!-- end 8 columns -->
					
				</div><!-- end inner row 3 -->
				<div class="row"><!-- start inner row 4 -->
					
					<div class="col-md-6 col-md-offset-3"><!-- start 6 columns -->
						<div class="row"><!-- start row 1 inside inner row 4 -->
							<div class="col-md-8 col-md-offset-2"><!-- start 6 columns -->
								<div class="form-group"><!-- start submit button field -->
									<button name="submit" type="submit" class="form-control btn btn-primary" id="submit">
										<span class="glyphicon glyphicon-ok"></span> Register
									</button>
								</div><!-- end submit button field -->
								<p class="help-block">You must agree to the terms and conditions of this site to register.</p>
							</div><!-- end 6 columns -->
							
						</div><!-- end row 1 inside inner row 4 -->
					</div><!-- end 6 columns -->
				</div><!-- end inner row 4 -->
				</form><!-- end form -->
			</div><!-- end outer row -->
		</div><!--end container fluid-->
        
		<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Terms &amp; Conditions</h4>
					</div>
					<div class="modal-body">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
        
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

	
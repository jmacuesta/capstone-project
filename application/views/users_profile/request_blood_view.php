<!DOCTYPE html>
<html>
    <head>
        <title>Request Blood - BloodGrant.ph</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jqui/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/jqui/jquery-ui.js"></script>
    </head>
    <body>
        <style>
            .btn span.glyphicon {    			
                opacity: 0;				
            }
            .btn.active span.glyphicon {				
                opacity: 1;				
            }
            .well{
                background-color: transparent;
            }
        </style>
        <nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>						
					<a class="navbar-brand" href="<?php echo base_url();?>">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?=base_url();?>UsersProfileController/user_profile_view/<?=$_SESSION['user_id'];?>">Profile</a></li>
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dugong Bayani <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a href="<?php echo base_url();?>BloodController/request_blood_view">Request Blood</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="<?php echo base_url();?>UsersProfileController/user_home_view">
                                <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:17px;height:17px;">
                                <?php echo $_SESSION['user_fullname']; ?>
                            </a>
                        </li>
						<li><a href="<?php echo base_url();?>UsersController/user_logout">Logout</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <a href="#" class="btn btn-link" role="button"><!-- profile view replace in href -->
                        <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:16px; height:16px"/>    
                        <?php echo $_SESSION['user_fullname'];?>
                    </a>
                </div>
                <div class="col-md-7">
                    <form action="<?php echo base_url();?>BloodController/request_blood" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><strong>Request for Blood</strong></h3>
                                <hr class="colorgraph"/>
                            </div>
                        </div><!-- end row 1 level 2 -->
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1">
                                <div class="form-group text-danger">
                                    <span class="glyphicon glyphicon-asterisk"></span> fields  are required
                                </div>
                                <div class="form-group">
                                    <label for="neededBloodType">Blood Type Needed <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    <select class="form-control" name="neededBloodType" placeholder="What blood type is needed?">
                                        <option value="" selected disabled <?php echo set_select('neededBloodType', '');?> >Please Select</option>
                                        <option value="A+" <?php echo set_select('neededBloodType', 'A+');?> >A+</option>
                                        <option value="A" <?php echo set_select('neededBloodType', 'AB-');?> >A</option>
                                        <option value="A-" <?php echo set_select('neededBloodType', 'A-');?> >A-</option>
                                        <option value="B+" <?php echo set_select('neededBloodType', 'B+');?> >B+</option>
                                        <option value="B" <?php echo set_select('neededBloodType', 'AB-');?> >B</option>
                                        <option value="B-" <?php echo set_select('neededBloodType', 'B-');?> >B-</option>
                                        <option value="O+" <?php echo set_select('neededBloodType', 'O+');?> >O+</option>
                                        <option value="O" <?php echo set_select('neededBloodType', 'AB-');?> >O</option>
                                        <option value="O-" <?php echo set_select('neededBloodType', 'O-');?> >O-</option>
                                        <option value="AB+" <?php echo set_select('neededBloodType', 'AB+');?> >AB+</option>
                                        <option value="AB" <?php echo set_select('neededBloodType', 'AB-');?> >AB</option>
                                        <option value="AB-" <?php echo set_select('neededBloodType', 'AB-');?> >AB-</option>
                                        <option value="ANY" <?php echo set_select('neededBloodType', 'ANY');?> >Any (to be used as replacement)</option>
                                    </select>
                                    <?php echo form_error('neededBloodType');?>
                                </div><!-- end form-group needed blood tyep -->
                                <div class="form-group">
                                    <label for="neededBloodComponent">Blood Component Needed <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    
                                    <div class="well">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                
                                                <input type="radio" name="neededBloodComponent" value="Whole Blood" id="other_1" <?= set_radio('neededBloodComponent','Whole Blood');?>>
                                            </span>
                                            <input type="text" class="form-control" value="Whole Blood" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="neededBloodComponent" value="Blood Platelets" id="other_2" <?= set_radio('neededBloodComponent', 'Blood Platelets');?> >
                                            </span>
                                            <input type="text" class="form-control" value="Blood Platelets" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="neededBloodComponent" value="Blood Plasma" id="other_3" <?= set_radio('neededBloodComponent', 'Blood Plasma');?> >
                                            </span>
                                            <input type="text" class="form-control" value="Blood Plasma" readonly>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="neededBloodComponent" value="" id="other_4" <?= set_radio('neededBloodComponent','');?>>
                                            </span>
                                            <input type="text" name="otherBloodComponent" class="form-control" id="textOther" placeholder="Other" value="<?= set_value('otherBloodComponent');?>" readonly>
                                        </div>
                                    </div>
                                    
                                    <?php echo form_error('neededBloodComponent');?>
                                </div><!-- end form-group needed component -->
                                <div class="form-group">
                                    <label for="patientName">Name of Patient <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control "type="text" name="patientFName" placeholder="First Name" value="<?php echo set_value('patientFName');?>">
                                            <?php echo form_error('patientFName');?>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control "type="text" name="patientLName" placeholder="Last Name" value="<?php echo set_value('patientLName');?>">
                                            <?php echo form_error('patientLName');?>
                                        </div>
                                    </div><!-- end row 1 level 3 -->
                                </div><!-- end form-group patient name -->
                                <div class="form-group">
                                    <label for="patientAge">Patient's Age</label>
                                    <input type="text" class="form-control" name="patientAge" placeholder="Age" value="<?php echo set_value('patientAge');?>">
                                    <?php echo form_error('patientAge');?>
                                </div><!-- end form-group patient age -->
                                <div class="form-group">
                                    <label for="patientMedicalCondition">Patient's Medical Condition </label>
                                    
                                    <textarea name="patientCondition" class="form-control" placeholder="Medical Condition" style="resize: none; width:100%;" rows="3"></textarea>
                                    <?php echo form_error('patientCondition');?>
                                </div><!-- end form group medical condition -->
                                <div class="form-group">
                                    <label for="patientExactLocation">Room Number, Hospital &amp; Hospital Address</label>
                                    <div class="well">
                                        <div class="form-group">
                                            <label for="patientRoomNumber">Room Number <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                            <input class="form-control" type="text" name="patientRoomNumber" placeholder="Room Number" value="<?php echo set_value('patientRoomNumber');?>">
                                            <?php echo form_error('patientRoomNumber');?>
                                        </div><!-- end form-group room number-->
                                        <div class="form-group">
                                            <label for="patientHospital">Hospital <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                            <input class="form-control" type="text" name="patientHospital" placeholder="Hospital" value="<?php echo set_value('patientHospital');?>">
                                            <?php echo form_error('patientHospital');?>
                                        </div><!-- end form-group hospital -->
                                        <div class="form-group">
                                            <label for="hospitalLocation">Hospital Street Address <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                            <input type="text" class="form-control" name="patientHospitalAddress" placeholder="Address" value="<?php echo set_value('patientHospitalAddress');?>">
                                            <?php echo form_error('patientHospitalAddress');?>
                                        </div><!-- end form-group hospital address-->
                                    </div><!-- end well -->
                                </div><!-- end form-group exact location -->
<!--                                 <span class="glyphicon glyphicon-asterisk text-danger"></span>-->
                                <div class="form-group">
                                    <label for="hospitalArea">Hospital Location <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    <select name="hospitalArea" placeholder="Area" class="form-control">
                                        <option value="" selected disabled <?= set_select('hospitalArea','');?> >Select Area</option>
                                        <option value="Area1" <?= set_select('hospitalArea','Area1');?> >Area1</option>
                                        <option value="Area2" <?= set_select('hospitalArea','Area2');?> >Area2</option>
                                    </select>
                                    <?php echo form_error('hospitalArea');?>
                                </div><!-- end form-group hospital area -->
                                <div class="form-group">
                                    <label>Blood Request Details</label>
                                    <div class="well">
                                        <div class="form-group">
                                            <label for="Number of blood units">Number of blood units <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                            <input type="number" class="form-control" name="bloodUnits" placeholder="Number of units" value="<?php echo set_value('bloodUnits');?>">
                                            <?php echo form_error('bloodUnits');?>
                                        </div><!-- end form-group request units blood-->
                                        <div class="form-group">
                                            <label for="latest date needed">Latest Date Needed <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <button type="button" id="buttondatepicker" role="button">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </button>
                                                </span>
                                                <input type="text" class="form-control" id="datepicker" name="dateNeeded" placeholder="Date Needed" value="<?php echo set_value('dateNeeded');?>" readonly>
                                            </div><!-- end input group -->
                                            <?php echo form_error('dateNeeded');?>
                                        </div>
                                        <div class="form-group">
                                            <label for="otherInfo">Other Pertinent Information</label>
                                            <textarea style="resize: vertical;" name="otherInfo" class="form-control" rows="3" ><?php echo set_value('otherInfo');?></textarea>
                                            <?php echo form_error('otherInfo');?>
                                        </div><!-- end form group other info-->
                                    </div><!-- end well -->
                                </div><!-- end request details -->
                                <div class="form-group">
                                    <label for="relativeName">Guardian's or Relative's Name <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="relativeFName" placeholder="Guardian's or Relative's First Name" value="<?php echo set_value('relativeFName');?>">
                                            <?php echo form_error('relativeFName');?>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="relativeLName" placeholder="Guardian's or Relative's Last Name" value="<?php echo set_value('relativeLName');?>">
                                            <?php echo form_error('relativeLName');?>
                                        </div>
                                    </div><!-- end row 2 level 3 -->
                                </div><!-- end form-group guardian name -->
                                <div class="form-group">
                                    <label for="Guardian's or Relative's Contact Number">Guardian's or Relative's Contact Number <span class="glyphicon glyphicon-asterisk text-danger"></span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>+63
                                        </span>
                                        <input type="text" class="form-control" name="relativeContactNumber" placeholder="Guardian's or Relative's Contact Number" value="<?php echo set_value('relativeContactNumber');?>">
                                    </div><!-- end input group -->
                                    <p class="help-block">e.g. +63(9123456780)</p>
                                    <?php echo form_error('relativeContactNumber');?>
                                </div><!-- end form-group guardian contact number -->
                                <div class="form-group">
                                    <label for="relativeEmail">Guardian's or Relative's Email </label>
                                    <input type="email" class="form-control" name="relativeEmail" placeholder="Guardian's or Relative's Email" value="<?php echo set_value('relativeEmail');?>">
                                    <?php echo form_error('relativeEmail');?>
                                </div><!-- end form guardian email address -->
                            </div>
                        </div><!-- end row 2 level 2 -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="colorgraph"/>
                            </div>
                            <div class="col-md-11 col-md-offset-1">
                                <button type="submit" class="btn btn-danger form-control">
                                    Request
                                </button>
                            </div>
                        </div><!-- end row 3 level 2-->
                    </form>
                </div><!-- end col-md-7 -->
            </div><!-- end row 1 level 1 -->
        </div><!-- end container-fluid-->
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
            
           
            
            $('#other_1').click(function(){
                $('#textOther').attr('readonly',true);
                //$('#textOther').val('');
            });
            $('#other_2').click(function(){
                $('#textOther').attr('readonly',true);
                //$('#textOther').val('');
            });
            $('#other_3').click(function(){
                $('#textOther').attr('readonly',true);
                //$('#textOther').val('');
            });
            $('#other_4').click(function(){
                $('#textOther').attr('readonly',false);
                $('#other_4').val("Other: "+$('#textOther').val());
            });
            
			$(function() {
				$('#buttondatepicker').click(function(){
					$("#datepicker").datepicker("show");
				});
				$( "#datepicker" ).datepicker({
					showAnim: "fadeIn",
					changeMonth: true,
					dateFormat: "yy-mm-dd",
					showButtonPanel: true,
				});
			});
		</script>
        <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
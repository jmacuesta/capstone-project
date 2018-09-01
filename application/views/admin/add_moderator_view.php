<html>
    <head>
        <title>Manage Requests - BloodGrant.ph Admin</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jqui/jquery-ui.css">
        
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/js/sidebar.js"></script>
        <script src="<?php echo base_url();?>assets/jqui/jquery-ui.js"></script>
    </head>    
    <body>
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
        <div id="wrapper">
            <div class="overlay"></div>
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="<?=base_url();?>AdminController/landing_page">
                           BloodGrant.ph
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>AdminController/landing_page">Home</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>AdminController/notifications">Notifications <span class="badge pull-right"><?=$_SESSION['notifications'];?></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Requests <span class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Manage Requests</li>
                            <li><a href="<?=base_url();?>AdminController/rejected_requests_view">View Rejected Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/pending_requests_view">View Pending Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/approved_requests_view">View Approved Requests</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Moderators <span class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Manage Moderators</li>
                            <li><a href="<?=base_url();?>AdminController/manage_moderator_view">View Moderators</a></li>
                            <li><a href="<?=base_url();?>AdminController/add_moderator_view">Add Moderator</a></li>
                        </ul>
                        
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Users <span class="caret pull-right"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Manage Users</li>
                        <li><a href="<?=base_url();?>AdminController/users_list_view">View Confirmed Users</a></li>
                        <li><a href="#">View Registered Users</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>AdminController/logout">Logout</a>
                    </li>
                </ul>
            </nav>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>

            </div>
            <!-- /#page-content-wrapper -->
            <div class="container-fluid">
                <form action="<?= base_url();?>AdminController/add_moderator" method="post">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h2 class="text-danger"><strong>Add Moderator</strong></h2>
                            <hr class="colorgraph"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <label for="modName">Moderator Name</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="modFName" placeholder="First Name" value="<?= set_value('modFName');?>">
                                        <?= form_error('modFName');?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="modLName" placeholder="Last Name" value="<?= set_value('modLName');?>">
                                        <?= form_error('modLName');?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="modEmail">Moderator Email</label>
                                <input type="email" class="form-control" name="modEmail" placeholder="Email Address" value="<?= set_value('modEmail');?>">
                                <?= form_error('modEmail');?>
                            </div>
                            
                            <div class="form-group">
                                <label for="modArea">Moderator's Area</label>
                                <select class="form-control" name="modArea" placeholder="Select Area">
                                    <option value="" selected disabled>Please Select Your Area of Residency</option>
                                    <?php
                                        foreach($regionlist as $regionrow){
                                            echo '<option value="'.$regionrow->region_name.'" disabled>----'.$regionrow->region_name.'----</option>';
                                            foreach($arealist as $arearow){
                                                echo '<option value="'.$arearow->area_name.'" '.set_select('modArea',$arearow->area_name).'>'.$arearow->area_name.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <?= form_error('modArea');?>
                            </div>
                            <div class="form-group">
                                <label for="modContact">Moderator Contact</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-phone"></span>+63
                                    </span>
                                    <input type="text" class="form-control" name="modContact" placeholder="Contact Number" value="<?= set_value('modContact');?>">
                                </div>
                                <?= form_error('modContact');?>
                                <p class="help-block">ex. +63(9123456780)</p>
                            </div>
                            <div class="form-group">
                                <label for="modBloodType">Moderator Blood Type</label>
                                <select class="form-control" name="modBloodType">
                                    <option value="" selected disabled>Select Your Blood Type</option>
                                    <?php
                                        foreach($bloodtypeslist as $bloodtypes){
                                            echo '<option value="'.$bloodtypes->name.'" '.set_select('modBloodType',$bloodtypes->name).'>'.$bloodtypes->name.'</option>';
                                        }
                                    ?>
                                    <option value="UNK" <?= set_select('modBloodType','UNK');?>>Does not know but, will update when moderator finds out</option>
                                </select>
                                <?= form_error('modBloodType');?>
                            </div>
                            <div class="form-group">
                                <label for="modDOB">Moderator Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
											<button type="button" id="buttondatepicker" class="btn btn-default form-control" role="button">
												<span class="glyphicon glyphicon-calendar"></span>
											</button>
						            </span>
                                    <input type="text" class="form-control" id="datepicker" name="modDOB" placeholder="YYYY-MM-DD" value="<?= set_value('modDOB');?>" readonly>
                                </div>
                                <?= form_error('modDOB');?>
                            </div>
                            <div class="form-group">
                                <label for="modGender">Moderator's Sex</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="modGender" value="Male" <?= set_radio('modGender','Male');?> >
                                            </span>
                                            <p class="form-control" style="color:dodgerblue;"><strong>Male</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="radio" name="modGender" value="Female" <?= set_radio('modGender','Female');?> >
                                            </span>
                                            <p class="form-control" style="color:deeppink;"><strong>Female</strong></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?= form_error('modGender');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <hr class="colorgraph"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-warning btn-lg percent100">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    
    <!-- /#wrapper -->
        
        
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
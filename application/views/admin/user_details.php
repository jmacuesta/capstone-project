<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/js/sidebar.js"></script>
    </head>
    <body>
        <style>
            .row{
                margin-top:40px;
                padding: 0 10px;
            }
            .clickable{
                cursor: pointer;   
            }
            .panel-heading span {
                margin-top: -15px;
                font-size: 15px;
            }
            th{
                width: 25%;
                text-align: center;
            }
            td{
                width: 75%;
                text-align: justify;
            }
            
        </style>
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
            <?php 
             
//                $requestTime=date("l / F d, Y / h:i:s A ", strtotime($request->request_time));
               
            ?>
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <?php
                         // lagay dito message flash data
                         
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>User ID #<?= $userDetails->users_id;?> Details</strong></h3>
                            </div>
                            <table class="table table-bordered table-condensed table-hover">
                                
                                <tr>
                                    <th>User Name</th>
                                    <td><a href="#"><?=$userDetails->users_lastname.', '.$userDetails->users_firstname;?></a></td>
                                </tr>
                                <tr>
                                    <th>User Email</th>
                                    <td><?=$userDetails->users_email;?></td>
                                </tr>
                                <tr>
                                    <th>User Area</th>
                                    <td><?=$userDetails->users_area;?></td>
                                </tr>
                                <tr>
                                    <th>User Contact Number</th>
                                    <td>0<?=$userDetails->users_contact;?></td>
                                </tr>
                                <tr>
                                    <th>User Blood Type</th>
                                    <td><?=$userDetails->users_bloodtype;?></td>
                                </tr>
                                <tr>
                                    <th>User Birthday</th>
<!--                                    date("l / F d, Y / h:i:s A", strtotime($request->request_postingTime));-->
                                    <td><?= date("F d, Y", strtotime($userDetails->users_dateofbirth));?></td>
                                </tr>
                                <tr>
                                    <th>User Gender</th>
                                    <td><?=$userDetails->users_gender;?></td>
                                </tr>
                                <tr>
                                    <th>User Email Status</th>
                                    <td>
                                        <?php
                                            if($userDetails->users_emailactivated==0){
                                                echo 'Not Activated';
                                            }else{
                                                echo 'Activated';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>User Mobile Status</th>
                                    <td>
                                        <?php
                                            if($userDetails->users_mobileactivated==0){
                                                echo 'Not Activated';
                                            }else{
                                                echo 'Activated';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>User Deferred</th>
                                    <td>
                                        <?php
                                            if($userDetails->users_deferred==0){
                                                echo 'No';
                                            }else{
                                                if($userDetails->users_deferred_type==1){
                                                    echo 'Yes (Temporarily)';
                                                }elseif($userDetails->users_deferred_type==2){
                                                    echo 'Yes (Permanently)';
                                                }
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>User Points</th>
                                    <td><?=$userDetails->users_points;?></td>
                                </tr>
                                <tr>
                                    <th>User Registration Time</th>
                                    <td><?=date("l / F d, Y / h:i A ",strtotime($userDetails->users_registrationTime));?></td>
                                </tr>
                                <tr>
                                    <th>Actions</th>
                                    <td>
                                        <div class="btn-group btn-group-justified" role="group">
                                            <a class="btn btn-default" href="<?=base_url();?>AdminController/users_list_view"><span class="glyphicon glyphicon-share-alt"></span> Return</a>
                                            <?php if($userDetails->users_emailactivated==1&&$userDetails->users_mobileactivated==1): ?>
                                            <a class="btn btn-info" href="#" data-toggle="modal" data-target="#AddPointsModal"><span class="glyphicon glyphicon-plus"></span> Add Points</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /#page-content-wrapper -->
    </div>
    <div class="modal fade" id="AddPointsModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" id="modalHeader">Add points to user <?=$userDetails->users_id;?></h3>
                </div>
                <div class="modal-body">
                    <p>Do you really want to Add points to user <?=$userDetails->users_id;?>?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-info" href="<?=base_url();?>AdminController/add_points_user/<?=$userDetails->users_id;?>"><span class="glyphicon glyphicon-plus"></span> Add Points</a>
                </div>
            </div>
        </div>
    </div><!-- delete -->
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
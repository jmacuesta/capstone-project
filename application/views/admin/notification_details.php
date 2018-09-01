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
            td{
                width: 25%;
            }
            table{
                font-size: 16px;
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
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading"><strong>Notification Details</strong></div>
                            <div class="panel-body">
                                <table class="table table-hover table-condensed">
                                    <caption class="text-danger">Blood Request</caption>
                                    <tr>
                                        <td><strong>Request Number</strong></td>
                                        <td><?=$request->request_id;?></td>
                                            <td><strong>Blood Component Needed</strong></td>
                                        <td><?=$request->request_neededBloodComponent;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Request By</strong></td>
                                        <td><?=$user->users_firstname.' '.$user->users_lastname;?></td>
                                            <td><strong>Needed Units of Blood</strong></td>
                                        <td><?=$request->request_numberUnits;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient</strong></td>
                                        <td><?=$request->request_patientFName.' '.$request->request_patientLName;?></td>
                                            <td><strong>Location</strong></td>
                                        <td><?=$request->request_patientExactLocation.', '.$request->request_patientExactLocationArea;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient Age</strong></td>
                                        <?php if(empty($request->request_patientAge)): ?>
                                        <td>Not Given</td>
                                        <?php else: ?>
                                        <td><?=$request->request_patientAge;?></td>
                                        <?php endif; ?>
                                            <td><strong>Relatives' Name</strong></td>
                                        <td><?=$request->request_relativeFName.' '.$request->request_relativeLName;?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Condition</strong></td>
                                        <td><?=$request->request_patientCondition;?></td>
                                            <td><strong>Relatives' Contact Number</strong></td>
                                        <td>0<?=$request->request_relativeContact;?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td><strong>Blood Type Needed</strong></td>
                                        <td><?=$request->request_neededBloodType;?></td>
                                            <td><strong>Relatives' Email</strong></td>
                                        <?php if(empty($request->request_relativeEmail)): ?>
                                        <td>Not Given</td>
                                        <?php else: ?>
                                        <td><?=$request->request_relativeEmail;?></td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Interested Donors</strong></td>
                                        <td><?=$request->request_NumInterestedDonors;?></td>
                                        <td><strong>Request Approved?</strong></td>
                                        <?php if($request->request_approved==0): ?>
                                        <td>No</td>
                                        <?php else: ?>
                                        <td>Yes</td>
                                        <?php endif;?>
                                    </tr>
                                    <?php if($request->request_NumInterestedDonors>0&&$request->request_approved==1):?>
                                    <tr>
                                        <td><strong>Names of Interested Donors</strong></td>
                                        <td><?=$request->request_InterestedDonors;?></td>
                                        <td><strong>Request Approved By</strong></td>
                                        <td><?=$request->request_approvedBy;?></td>
                                    </tr>
                                    <?php elseif($request->request_NumInterestedDonors>0&&$request->request_approved==0):?>
                                    <tr>
                                        <td><strong>Names of Interested Donors</strong></td>
                                        <td><?=$request->request_InterestedDonors;?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php elseif($request->request_NumInterestedDonors=0&&$request->request_approved==1): ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Request Approved By</strong></td>
                                        <td><?=$request->request_approvedBy;?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td></td>
                                        <td class="text-center"><strong>Other Details</strong></td>
                                        <td colspan="2"class="text-left"><?=$request->request_otherInfo;?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <a class="btn btn-default btn-lg" href="<?=base_url();?>AdminController/notifications">Back</a>
                                <a class="btn btn-danger btn-lg pull-right" href="#">Approve</a>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
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
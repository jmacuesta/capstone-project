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
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-info">
                            <div class="panel-heading"><strong>Notifications</strong></div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <?php foreach($notifs as $row): ?>
                                        <?php if($row->notification_read == 1): ?>
                                            <a href="<?=$row->notification_url;?>" class="list-group-item list-group-item-default">
                                        <?php else: ?>
                                            <a href="<?=$row->notification_url;?>" class="list-group-item list-group-item-info">
                                        <?php endif; ?>
                                                <?=$row->notification_details;?>
                                                <p class="pull-right">
                                                    <?=date("l F d, Y H:i:s",strtotime($row->notification_time));?>
                                                </p>
                                            </a>
                                        
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="#">See All Notifications</a>
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
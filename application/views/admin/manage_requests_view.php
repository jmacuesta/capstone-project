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
            .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
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
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Requests</strong></h3>
                                <span class="pull-right clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                            </div>
                            <div class="panel-body" style="display:none;">
                                <input type="text" class="form-control" name="requestSearch" placeholder="Search for request">
                            </div>
                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Time Requested</th>
                                            <th>Recipient</th>
                                            <th>Recipient's Condition/s</th>
                                            <th>Blood Type Needed</th>
                                            <th>Hospital</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            foreach($list as $row){
                                                if($row->request_neededBloodType === "ANY"){
                                                    $row->request_neededBloodType = $row->request_neededBloodType.' (Replacement)';
                                                }
                                                
                                                echo '<tr>';
                                                echo '<td>'.$row->request_time.'</td>';
                                                echo '<td>'.$row->request_patientFName.' '.$row->request_patientLName.'</td>';
                                                echo '<td>'.$row->request_patientCondition.'</td>';
                                                echo '<td>'.$row->request_neededBloodType.'</td>';
                                                echo '<td>'.$row->request_patientExactLocation.'</td>';
                                                echo '<td><a class="btn btn-danger" href="#">View Details</a></td>';
                                                echo '<td><a class="btn btn-warning" href="#">badibabdi</a></td>';
                                                echo '<td><a class="btn btn-success" href="#">View Details</a></td>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="center-block">
                            <?php echo $this->pagination->create_links(); ?>
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
        <script>
            $(document).on('click', '.panel-heading span.clickable', function(e){
                var $this = $(this);
                if(!$this.hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                } else {
                    $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                }
            })
        </script>
        <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
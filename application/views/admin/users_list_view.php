<html>
    <head>
        <title>Manage Requests - BloodGrant.ph Admin</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/js/sidebar.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
        
    </head>    
    <body>
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
                        <?php
                           //echo flash data alert messages
                        
                        ?>
                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Users List</strong></h3>
                            </div>
                            <div class="panel-body">
                                <table id="example" class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>User's Name</th>
                                            <th>User's Email</th>
                                            <th>User's Contact</th>
                                            <th>User's Points</th>
                                            <th>User Type</th>
                                            <th>View other details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($list as $row){
                                                if($row->users_id != $_SESSION['user_id']){
                                                    if($row->users_type==1){
                                                        $user_type = 'Admin';
                                                    }elseif($row->users_type==2){
                                                        $user_type = 'Moderator';
                                                    }else{
                                                        $user_type = 'User';
                                                    }
                                                    echo '<tr>';
                                                    echo '<td><a href="#">'.$row->users_firstname.' '.$row->users_lastname.'</a></td>';
                                                    echo '<td>'.$row->users_email.'</td>';
                                                    echo '<td>0'.$row->users_contact.'</td>';
                                                    echo '<td>'.$row->users_points.'</td>';
                                                    echo '<td>'.$user_type.'</td>';
                                                    echo '<td><a class="btn btn-info btn-xs" href="'.base_url().'AdminController/user_details/'.$row->users_id.'" style="width:100%;"><span class="glyphicon glyphicon-list"></span> View Other Details</a></td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <p class="help-block">This is the list of the users here at BloodGrant.ph. You wouldn't be able to see your details here. you can check them at your profile</p>
                        </div>
                        <div class="text-center">
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
        
        <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
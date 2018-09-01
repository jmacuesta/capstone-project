<html>
    <head>
        <title>Approved Requests - BloodGrant.ph Admin</title>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css">
        <script src="<?=base_url();?>assets/js/jqv1.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?=base_url();?>assets/js/sidebar.js"></script>
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
                        <div class="col-md-11 col-md-offset-1">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group pull-left" role="group">
                                    <a class="btn btn-default" href="<?= base_url();?>AdminController/pending_requests_view"><span class="glyphicon glyphicon-chevron-left"></span>Go to pending requests</a>
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Approved Requests</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <table id="example" class="display table table-hover table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Request #</th>
                                                <th>Request By</th>
                                                <th>Recipient</th>
                                                <th colspan="3">Time Requested</th>
                                                <th>Approval Type</th>
                                                <th>Posted?</th>
                                                <th>View Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($list as $row):?>
                                            <tr>
                                                <td><?=$row->request_id;?></td>
                                                <?php foreach($user as $row2):?>
                                                    <?php if($row2->users_id == $row->request_by_id):?>
                                                    <td><a href="#"><?=$row2->users_firstname.' '.$row2->users_lastname;?></a></td>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                                <td><?=$row->request_patientFName.' '.$row->request_patientLName;?></td>
                                                <td style="border-right:1px groove;"><?= date("l", strtotime($row->request_time));?></td>
                                                <td style="border-right:1px groove;"><?= date("F d, Y", strtotime($row->request_time));?></td>
                                                <td><?= date("h:i A", strtotime($row->request_time));?></td>
                                                <?php if($row->request_approvalType==2):?>
                                                    <td>For Posting</td>
                                                    <?php if($row->request_posted==1):?>
                                                    <td><span class="glyphicon glyphicon-ok-circle text-success"></span> Posted</td>
                                                    <?php else: ?>
                                                    <td><span class="glyphicon glyphicon-remove-circle text-danger"></span> Not Posted</td>
                                                    <?php endif;?>
                                                <?php else: ?>
                                                    <td>For Release</td>
                                                    <td><span class="glyphicon glyphicon-remove-circle text-danger"></span> Not available for posting</td>
                                                <?php endif;?>
                                                <td>
                                                    <a class="btn btn-danger btn-xs" href="<?=base_url();?>AdminController/request_details_view/<?=$row->request_id;?>" style="width:100%;">
                                                        <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;View Details
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                                <p class="help-block">This is the list of approved requests</p>

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
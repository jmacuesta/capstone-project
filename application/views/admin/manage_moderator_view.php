<html>
    <head>
        <title>Manage Requests - BloodGrant.ph Admin</title>
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
                        <div class="col-md-10 col-md-offset-1">
                            <?php
                            if($this->session->flashdata('deactivated')){
                                echo $this->session->flashdata('message');
                            }else{
                                echo $this->session->flashdata('message');
                            }
                            if($this->session->flashdata('registerSuccess')){
                                echo $this->session->flashdata('registerSuccessMsg');
                            }

                            ?>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Moderators List</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <table id="example" class="display table table-striped table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Moderator ID</th>
                                                <th>Moderator Name</th>
                                                <th>Moderator Email</th>
                                                <th>Moderator Contact</th>
                                                <th>Moderator Status</th>
                                                <th>View Details</th>
                                                <th>Controls</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($moderators as $row): ?>
                                            <tr>
                                                <td><?=$row->users_id;?></td>
                                                <td><?=$row->users_firstname.' '.$row->users_lastname;?></td>
                                                <td><?=$row->users_email;?></td>
                                                <td>0<?=$row->users_contact;?></td>
                                                <?php if($row->moderator_activated==null):?>
                                                <td>Not Activated</td>
                                                <td><a class="btn btn-primary btn-xs" style="width:100%;" href="<?=base_url();?>AdminController/moderator_details_view/<?=$row->users_id;?>"><span class="glyphicon glyphicon-list"></span> View Details</a></td>
                                                <td><a class="btn btn-success btn-xs" style="width:100%;" href="<?=base_url();?>AdminController/activate_moderator/<?=$row->users_id;?>"><span class="glyphicon glyphicon-off"></span> Activate</a></td>
                                                <?php else:?>
                                                <td>Activated</td>
                                                <td><a class="btn btn-primary btn-xs" style="width:100%;" href="<?=base_url();?>AdminController/moderator_details_view/<?=$row->users_id;?>"><span class="glyphicon glyphicon-list"></span> View Details</a></td>
                                                <td><a class="btn btn-danger btn-xs" style="width:100%;" href="<?=base_url();?>AdminController/deactivate_moderator/<?=$row->users_id;?>"><span class="glyphicon glyphicon-off"></span> Deactivate</a></td>
                                                <?php endif;?>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <p class="help-block pull-left">This is the list of moderators, as an admin, you would be able to create and activate/deactivate these moderator accounts</p>
                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group pull-right" role="group">
                                            <a class="btn btn-warning" href="<?= base_url();?>AdminController/add_moderator_view"><span class="glyphicon glyphicon-plus"></span> Add Moderator</a>
                                        </div>
                                    </div>
                                </div>
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
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
        <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>
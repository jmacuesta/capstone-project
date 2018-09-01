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
                         if($this->session->flashdata('deactivated')){
                             echo $this->session->flashdata('message');
                        }else{
                            echo $this->session->flashdata('message');
                         }
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Moderator Details</strong></h3>
                            </div>
                            <table class="table table-bordered table-condensed table-hover">
                                <tr>
                                    <th>Moderator ID</th>
                                    <td><?=$mod_detail->users_id;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Name</th>
                                    <td><a href="#"><?=$mod_detail->users_firstname.' '.$mod_detail->users_lastname;?></a></td>
                                </tr>
                                <tr>
                                    <th>Moderator Email</th>
                                    <td><?=$mod_detail->users_email;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Area</th>
                                    <td><?=$mod_detail->users_area;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Contact Number</th>
                                    <td><?=$mod_detail->users_contact;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Blood Type</th>
                                    <td><?=$mod_detail->users_bloodtype;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Birthday</th>
<!--                                    date("l / F d, Y / h:i:s A", strtotime($request->request_postingTime));-->
                                    <td><?= date("F d, Y", strtotime($mod_detail->users_dateofbirth));?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Gender</th>
                                    <td><?=$mod_detail->users_gender;?></td>
                                </tr>
                                <tr>
                                    <th>Moderator Activated</th>
                                    <td>
                                        <?php
                                            if($mod_detail->moderator_activated==null){
                                                echo 'Not Activated';
                                            }else{
                                                echo 'Activated';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="2">
                                        <div class="btn-group btn-group-justified" role="group">
                                            <a class="btn btn-default" href="<?=base_url();?>AdminController/manage_moderator_view"><span class="glyphicon glyphicon-share-alt"></span> Return</a>
                                            <?php
                                                if($mod_detail->moderator_activated==null){
                                                    $modal='Activate';
                                                    $action='<a class="btn btn-success" href="'.base_url().'AdminController/in_activate_moderator/'.$mod_detail->users_id.'"><span class="glyphicon glyphicon-off"></span> Activate</a>';
                                                    echo '<a class="btn btn-success" href="#" data-toggle="modal" data-target="#'.$modal.'"><span class="glyphicon glyphicon-off"></span> Activate</a>';
                                                }else{
                                                    $modal='Deactivate';
                                                    $action='<a class="btn btn-danger" href="'.base_url().'AdminController/in_deactivate_moderator/'.$mod_detail->users_id.'"><span class="glyphicon glyphicon-off"></span> Dectivate</a>';
                                                    echo '<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#'.$modal.'"><span class="glyphicon glyphicon-off"></span> Deactivate</a>';
                                                }
                                            ?>
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
    <div class="modal fade" id="<?=$modal;?>" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title" id="modalHeader"><?=$modal;?> Moderator Account</h3>
                </div>
                <div class="modal-body">
                    <p>Do you really want to <?=$modal;?> this moderator account?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?=$action;?>
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
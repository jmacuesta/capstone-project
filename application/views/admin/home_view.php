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
            .dropdown-menu > li > a { 
                height: 50px; 
                text-align: center;
                font-size: 1.65em;
            }
            .btn-lg{
                font-size: 1.35em;
            }
        </style>
        <div class="container-fluid">
            <div class="jumbotron" style="margin-top: 80px;height: 80vh; ">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Hello Admin <?=$_SESSION['user_fullname'];?></h1>
                    </div>
                    <div class="col-md-3">
                        <a href="<?=base_url();?>">
                            <button type="button" class="btn btn-danger btn-lg" style="width:100%;height:45%;">
                                <span class="glyphicon glyphicon-user"></span> Profile 
                            </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?=base_url();?>AdminController/notifications">
                            <button type="button" class="btn btn-default btn-lg" style="width:100%;height:45%;background-color: darkmagenta;color:#fff;">
                                Notifications <span class="badge"><?=$_SESSION['notifications'];?></span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;height:45%;">
                            <span class="glyphicon glyphicon-list"></span> View Requests <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu col-md-12">
                            <li><a href="<?=base_url();?>AdminController/rejected_requests_view">Rejected Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/pending_requests_view">Pending Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/approved_requests_view">Approved Requests</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;height:45%;">
                            <span class="glyphicon glyphicon-edit"></span> Manage Moderators <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu col-md-12">
                            <li><a href="<?=base_url();?>AdminController/manage_moderator_view">Moderators List</a></li>
                            <li><a href="<?=base_url();?>AdminController/add_moderator_view">Add Moderator</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;height:45%;">
                            <span class="glyphicon glyphicon-edit"></span> Manage Users <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu col-md-12">
                            <li><a href="<?=base_url();?>AdminController/users_list_view">View Confirmed Users</a></li>
                            <li><a href="#">View Registered Users</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <a href="<?=base_url();?>AdminController/logout">
                            <button type="button" class="btn btn-default tn-lg" style="width:100%;height:45%;">
                                <span class="glyphicon glyphicon-off"></span> Logout 
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
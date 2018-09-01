<html>
    <head>
        <title>Home - BloodGrant.ph</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>						
					<a class="navbar-brand" href="<?php echo base_url();?>">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li class="active"><a href="<?=base_url();?>UsersProfileController/user_profile_view/<?=$_SESSION['user_id'];?>">Profile</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dugong Bayani <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url();?>BloodController/request_blood_view">Request Blood</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=base_url();?>UsersProfileController/MyRequests">My Requests</a>
                        </li>
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="<?php echo base_url();?>UsersProfileController/user_home_view">
                                <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:17px;height:17px;">
                                <?php echo $_SESSION['user_fullname']; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url();?>UsersProfileController/notifications/<?=$_SESSION['user_id']?>">
                                <span class="glyphicon glyphicon-globe"></span> Notifications <span class="badge"> <?=$_SESSION['notifications'];?> </span>
                            </a>
                        </li>
						<li><a href="<?php echo base_url();?>UsersController/user_logout">Logout</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <?php 
                        if($this->session->flashdata('updatesuccess')){
                            echo $this->session->flashdata('updatemessage');
                        }
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?=$userDetail->users_firstname.' '.$userDetail->users_lastname;?></strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <img src="<?=base_url();?>assets/uploads/users/db.png" class="img-responsive img-circle">
                                    <a href="#">Update Profile Picture</a>
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Blood Type</td>
                                                <td><?php
                                                        if($userDetail->users_bloodtype=='UNK'){
                                                            echo '';
                                                        }else{
                                                            echo $userDetail->users_bloodtype;
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email Address</td>
                                                <td><?= $userDetail->users_email.' ';?>
                                                    <?php
                                                        if($userDetail->users_emailactivated==1){
                                                            echo '<span class="glyphicon glyphicon-ok-sign text-success" data-toggle="tooltip" data-placement="right" title="Verified"></span>';
                                                        }else{
                                                            echo '<span class="glyphicon glyphicon-remove-sign text-danger" data-toggle="tooltip" data-placement="right" title="Unverified"></span>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Number</td>
                                                <td>
                                                    <?='0'.$userDetail->users_contact.' ';?>
                                                    <?php
                                                        if($userDetail->users_mobileactivated==1){
                                                            echo '<span class="glyphicon glyphicon-ok-sign text-success" data-toggle="tooltip" data-placement="right" title="Verified"></span>';
                                                        }else{
                                                            echo '<span class="glyphicon glyphicon-remove-sign text-danger" data-toggle="tooltip" data-placement="right" title="Unverified"></span>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Location</td>
                                                <td><?=$userDetail->users_area;?></td>
                                            </tr>
                                            <tr>
                                                <td>Points</td>
                                                <td><?=$userDetail->users_points;?></td>
                                            </tr>
                                            <tr>
                                                <td>Birthday</td>
                                                <td><?=date('F d, Y',strtotime($userDetail->users_dateofbirth));?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?=$userDetail->users_gender;?></td>
                                            </tr>
                                            <tr>
                                                <td>Last Donation</td>
                                                <td>
                                                    <?php 
                                                        if($userDetail->users_last_donation=='0000-00-00'){
                                                            echo '';
                                                        }else{
                                                            echo $userDetail->users_last_donation;
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>User Donation Status</td>
                                                <td>
                                                    <?php 
                                                        if($userDetail->users_deferred==0){
                                                            echo 'Available to donate';
                                                        }else{
                                                            echo 'Not Available to Donate';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                if($userDetail->users_deferred==1){
                                                    echo '<tr>';
                                                    echo '<td>Not Available</td>';
                                                    if($userDetail->users_deferred_type==0){
                                                        echo '<td>Temporarily Not Available Until '.date('F d, Y (l) ',strtotime($userDetail->users_deferred_until)).'</td>';
                                                    }else{
                                                        echo '<td>Permanently</td>';
                                                    }
                                                    echo '</tr>';
                                                    echo '<tr>';
                                                    echo '<td>Why?</td>';
                                                    echo '<td>'.$userDetail->users_deferral_reason.'</td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    <span class="pull-right">
                                        <a class="btn btn-primary" href="<?=base_url();?>UsersProfileController/update_profile_view/<?=$userDetail->users_id;?>">Update Profile</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4><strong>Events</strong></h4>
                    
                    
                    <ul class="list-group">
                        <?php
                            
                            foreach($events as $row){
                                $date = date("F d, Y",strtotime($row->event_date));
                                if(date("Y-m-d",strtotime($row->event_date)) == substr(unix_to_human(now()),0,10)){
                                    $syntax = '<a href="'.base_url().'Events/event_details/'.$row->event_id.'" class="btn btn-success list-group-item list-group-item-success">';
                                }else{
                                    $syntax = '<a href="'.base_url().'Events/event_details/'.$row->event_id.'" class="btn btn-info list-group-item list-group-item-info">';
                                }//echo date("Y-m-d",strtotime(unix_to_human(now())));
                                echo $syntax;
                                echo '<span class="badge">'.$date.'</span>';
                                echo $row->event_name;
                                echo '</a>';
                            }
                        ?>
                    </ul>
                    <a class="btn btn-default pull-right" href="#"><span class="glyphicon glyphicon-plus"></span> Add your event</a>

                    <table class="table">
                        <caption><p class="text-info">Legend</p></caption>
                        <tr>
                            <th class="success"></th>
                            <td>Today</td>
                            <th class="warning"></th>
                            <td>Interested</td>
                        </tr>
                        <tr>
                            <th class="danger"></th>
                            <td>Attending</td>
                            <th class="info"></th>
                            <td>Upcoming</td>
                        </tr>
                    </table>
                    
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
        
<html>
    <head>
        <title>Home - BloodGrant.ph</title>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css">
        <script src="<?=base_url();?>assets/js/jqv1.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
    </head>
    <body>
        <style>
            td{
                vertical-align:middle;
            }
        </style>
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
                        <li class="active"><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?=base_url();?>UsersProfileController/user_profile_view/<?=$_SESSION['user_id'];?>">Profile</a></li>
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
                            <a href="<?php echo base_url();?>UsersProfileController/user_profile_view/<?=$_SESSION['user_id'];?>">
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
                <div class="col-md-2">
                    <a href="#" class="btn btn-link" role="button"><!-- profile view replace in href -->
                        <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:16px; height:16px"/>    
                        <?php echo $_SESSION['user_fullname'];?>
                    </a>
                </div>
                <div class="col-md-7">
                    <?php
                    if($this->session->flashdata('inserted')){
                        echo $this->session->flashdata('limiter').$this->session->flashdata('message').$this->session->flashdata('delimiter');
                    }elseif($this->session->flashdata('informed')){
                        echo $this->session->flashdata('limiter').$this->session->flashdata('message').$this->session->flashdata('delimiter');
                    }
                    ?>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="panel-title"><strong>Requests</strong></div>
                        </div>
                        <div class="panel-body">
                            <table class="display table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Recipient</th>
                                        <th>Condition</th>
                                        <!--                                        <th>Blood Type Needed</th>-->
                                        <th>Hospital</th>
                                        <th>Contact Number</th>
                                        <th>Interested to Donate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $row): ?>
                                    <tr>
                                        <td><?=$row->request_patientFName.' '.$row->request_patientLName;?></td>
                                        <td><?=$row->request_patientCondition;?></td>
                                        <!--                                        <td><?php//=$row->request_neededBloodType;?></td>-->
                                        <td><?=$row->request_patientExactLocation;?></td>
                                        <td>0<?=$row->request_relativeContact;?></td>
                                        <?php if(preg_match('/\b('.$_SESSION['user_id'].')\b/',$row->request_InterestedDonors)): ?>
                                        <td><a class="btn btn-danger  percent100 disabled" href="<?=base_url();?>Requests/interested/<?=$row->request_id.'/'.$_SESSION['user_id'];?>">You are interested</a></td>
                                        <?php else: ?>
                                        <td><a class="btn btn-danger percent100" href="<?=base_url();?>Requests/interested/<?=$row->request_id.'/'.$_SESSION['user_id'];?>">Interested</a></td>
                                        <?php endif; ?>                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    /*foreach($requests as $row){
                            echo $row->request_neededBloodType;
                            echo ' '.$row->request_neededBloodComponent;
                            echo ' '.$row->request_patientFName;
                            echo ' '.$row->request_patientLName;
                            echo ' '.$row->request_patientAge;
                            echo ' '.$row->request_patientCondition;
                            echo ' '.$row->request_patientExactLocation;
                            echo ' '.$row->request_patientExactLocationArea;
                            echo ' '.$row->request_numberUnits;
                            echo ' '.$row->request_dateNeeded;
                            echo ' '.$row->request_otherInfo;
                            echo ' '.$row->request_relativeFName;
                            echo ' '.$row->request_relativeLName;
                            echo ' 0'.$row->request_relativeContact;
                            echo ' '.$row->request_relativeEmail;
                            echo $row->request_time;
                            echo $this->pagination->create_links();
                        }*/
                    ?>
                    <?php  ?>
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
                    <a class="btn btn-default pull-right" href="<?= base_url();?>Events/add_event_page"><span class="glyphicon glyphicon-plus"></span> Add your event</a>
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
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
<html>
    <head>
        <title>Home - BloodGrant.ph</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jqui/jquery-ui.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/jqui/jquery-ui.js"></script>
    </head>
    <script>
        $(function() {
				$('#buttondatepicker').click(function(){
					$("#datepicker").datepicker("show");
				});
				$( "#datepicker" ).datepicker({
					showAnim: "fadeIn",
					changeMonth: true,
					changeYear: true,
					dateFormat: "yy-mm-dd",
					showButtonPanel: true,
                    yearRange: "-70:+0"

				});
			});
    </script>
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
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="<?php echo base_url();?>UsersProfileController/user_home_view">
                                <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:17px;height:17px;">
                                <?= $_SESSION['user_fullname']; ?>
                            </a>
                        </li>
						<li><a href="<?php echo base_url();?>UsersController/user_logout">Logout</a></li>
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?=$userDetail->users_firstname.' '.$userDetail->users_lastname;?></strong></h3>
                        </div>
                        <form action="<?=base_url();?>UsersProfileController/update_user" method="post">
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <img src="<?=base_url();?>assets/uploads/users/db.png" class="img-responsive img-circle">
                                    <a href="#">Update Profile Picture</a>
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr hidden="hidden">
                                                <td>ID</td>
                                                <td><input name="UserId"type="text" class="form-control" value="<?=$userDetail->users_id;?>"></td>
                                            </tr>
                                            <tr>
                                                <td>Blood Type</td>
                                                <td>
                                                    <select name="UsersBloodType" class="form-control">
                                                        <option value="<?=$userDetail->users_bloodtype;?>" <?= set_select('UsersBloodType',$userDetail->users_bloodtype);?> selected><?=$userDetail->users_bloodtype;?></option>
                                                        <?php
                                                            foreach($bloodtypelist as $row){
                                                                if($row->name!=$userDetail->users_bloodtype){
                                                                    echo '<option value="'.$row->name.'" '.set_select('UsersBloodType',$row->name).'>'.$row->name.'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?= form_error('UsersBloodType');?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email Address
                                                    <span class="glyphicon glyphicon-info-sign text-info" data-toggle="tooltip" data-placement="left" title="If you changed your verified email, you will need to confirm it again"></span>
                                                </td>
                                                <td>
                                                    
                                                    <input type="email" name="UsersEmail" class="form-control" value="<?= set_value('UsersEmail',$userDetail->users_email);?>">
                                                    <?= form_error('UsersEmail');?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Contact Number
                                                    <span class="glyphicon glyphicon-info-sign text-info" data-toggle="tooltip" data-placement="left" title="If you changed your verified contact number, you will need to confirm it again"></span>
                                                </td>
                                                <td>
                                                    <input type="text" name="UsersContact" class="form-control" value="<?= set_value('UsersContact',$userDetail->users_contact);?>">
                                                    <?= form_error('UsersContact');?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Location</td>
                                                <td>
                                                    <select name="UsersArea" class="form-control">
                                                        <option value="<?=$userDetail->users_area;?>" <?= set_select('UsersArea',$userDetail->users_area);?> selected><?=$userDetail->users_area;?></option>
                                                        <?php
                                                            foreach($regionlist as $regionrow){
                                                                echo '<option value="" disabled>----'.$regionrow->region_name.'----</option>';
                                                                foreach($arealist as $arearow){
                                                                    if($arearow->area_name!=$userDetail->users_area){
                                                                        echo '<option value="'.$arearow->area_name.'" '.set_select('UsersArea',$arearow->area_name).'>'.$arearow->area_name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <?= form_error('UsersArea');?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Points</td>
                                                <td><?=$userDetail->users_points;?></td>
                                            </tr>
                                            <tr>
                                                <td>Birthday</td>
                                                <td>
                                                    <input type="text" name="UsersDOB"class="form-control" value="<?= set_value('UsersDOB',$userDetail->users_dateofbirth);?>" id="datepicker">
                                                    <?= form_error('UsersDOB');?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>
                                                    <select name="UsersGender" class="form-control">
                                                        <?php
                                                            if($userDetail->users_gender=='Male'){
                                                                echo '<option value="Male" selected>Male</option>';
                                                                echo '<option value="Female">Female</option>';
                                                            }else{
                                                                echo '<option value="Female" selected>Female</option>';
                                                                echo '<option value="Male">Male</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    <?= form_error('UsersGender');?>
                                                </td>
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
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#UpdateModal" href="#">Update Profile</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="UpdateModal" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h3 class="modal-title" id="modalHeader">Update Profile</h3>
                                   </div>
                                   <div class="modal-body">
                                       <p>Are you sure about updating your profile?</p>
                                   </div>
                                   <div class="modal-footer">
                                       <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                       <button type="submit" role="button" class="btn btn-primary">Submit</button>
                                   </div>
                               </div>
                           </div>
                        </div><!-- delete -->
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4><strong>Events</strong></h4>
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
        
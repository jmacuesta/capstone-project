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
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-10">
                    
                    <h4><strong>Events</strong></h4>
                    <?= $this->calendar->generate($this->uri->segment(3),$this->uri->segment(4),$events);?>
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
        
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
    <body>
        <script>
        $(function() {
                $('.pop').on('click', function() {
                    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                    $('#imagemodal').modal('show');   
                });		
        });
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
        
        <style>
            th{
                width: 30%;
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
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="<?php echo base_url();?>UsersProfileController/user_home_view">
                                <img src="<?php echo base_url();?>assets/images/db1.png" alt="Profile Picture" style="width:17px;height:17px;">
                                <?php echo $_SESSION['user_fullname']; ?>
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
                
                <div class="col-md-6">
                   <div class="panel panel-default">
                       <div class="panel-heading">Add Event</div>
                       <div class="panel-body">
                           <form action="<?=base_url();?>Events/add_event" method="get">
                               <div class="form-group">
                                   <div class="row">
                                       <div class="col-md-4">
                                           <label for="eventName">Event Name</label>
                                       </div>
                                       <div class="col-md-8">
                                           <input type="text" class="form-control" name="eventName" placeholder="Name of Event">
                                       </div>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="row">
                                       <div class="col-md-4">
                                           <label for="eventDescription">Event Description</label>
                                       </div>
                                       <div class="col-md-8">
                                           <textarea class="form-control" name="eventDescription" placeholder="Description" rows="3" style="resize: none;"></textarea>
                                       </div>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="row">
                                       <div class="col-md-4">Event Date</div>
                                       <div class="col-md-8">
                                           <div class="input-group">
                                               <span class="input-group-addon">
                                                    <button type="button" id="datepicker" role="button">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </button>
                                               </span>
                                               <input type="text" class="form-control" name="eventDate" placeholder="Date" id="datepicker" readonly>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </form>
                       </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- add photo upload here -->
                </div>
            </div>
        </div>
        
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview"  style="width: 100%;" >
      </div>
    </div>
    
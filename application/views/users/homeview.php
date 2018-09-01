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
					<a class="navbar-brand" href="<?php echo base_url(); ?>">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?php echo base_url();?>UsersController/aboutview">About</a></li>
                        <li><a href="<?php echo base_url();?>FaqsController">FAQs</a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo base_url();?>UsersController/register">Register</a></li>
                        <li><a href="<?php echo base_url();?>UsersController/login">Login</a></li>
                    </ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
        <div class="container-fluid">
            <div class="row">
                 <div class="col-md-12">
                    <div class="jumbotron">
                        <h1>Welcome to BloodGrant.ph<span id="magic">!</span></h1>
<!--                        <p>BloodGrant.ph is a network of blood donors</p>-->
                        <p>No account yet? Sign up right <a href="<?php echo base_url();?>UsersController/register">here</a></p>
                        <p>Already have an account? Log in right <a href="<?php echo base_url();?>UsersController/login">here</a></p>
<!--                        <button type="button" class="btn" style="opacity:0%;" id="#admin"></button>-->
                        <p>Have some questions? You might wanna check the FAQs first right <a href="<?php echo base_url();?>FaqsController">here</a></p>
                        <p>
                            Are you an 
                            <strong>
                                <span id="magic1">A</span><span id="magic2">d</span><span id="magic3">m</span><span id="magic4">i</span><span id="magic5">n</span>
                            </strong>?
                        </p>
                    </div><!-- end jumbotron -->
                </div>
            </div><!-- end row-->
        </div><!-- end container-fluid -->
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
    $("#magic1").click(function(){
        $("#magic2").click(function(){
           $("#magic3").click(function(){
               $("#magic4").click(function(){
                   $("#magic5").click(function(){
                        window.location.replace("<?= base_url();?>AdminController/login_view"); 
                    });
                });
            });
        });
    });
</script>

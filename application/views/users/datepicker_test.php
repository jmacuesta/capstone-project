<html>
	<head>
		<title>Sample Datepicker</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css">

		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
		<script src="<?php echo base_url();?>assets/js/jqv2.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>	
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>	
	</head>
	<body>
		<input type="text" class="form-control">


		<script>
		$('#sandbox-container input').datepicker({
    format: "yyyy-mm-dd",
    startDate: "1990-01-01",
    endDate: "+Infinity"
});
		</script>
	</body>
</html>
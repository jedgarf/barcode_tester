<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/CSS/style.css">

</head>
<body onload="$('#qr').focus()">

<div id="header">
	<h1>JEDGARF'S BARCODE TESTER</h1> 
</div>


<div class="container-fluid">

	<div class="row text-center">

		<div class="col-md-3">
			<img src="images/GC15-678.png" width="200px" height="200px">
		</div>
		<div class="col-md-3">
			<img src="images/GC14-216.png" width="200px" height="200px">
		</div>
		<div class="col-md-3">
			<img src="images/GC14-265.png" width="200px" height="200px">
		</div>
		<div class="col-md-3">
			<img src="images/GC14-765.png" width="200px" height="200px">
		</div>
		
	</div>

	<hr>

	<div class="row">

		<div class="col-md-6">

			<fieldset class="card">
				<legend class="">Adding Data: </legend>
				<form id="Qr-form" action="query.php" method="POST" autocomplete="off">
				
					<div class="form-group">
						<label class="text-mute">QR Code: </label>
						<input type="text" id="qr" name="qr" class="form-control">
					</div>

				</form>

				<div id="content"></div>

				<script type="text/javascript">
					
				$(document).ready(function () {
					$("#Qr-form").submit(function (evt) {
						evt.preventDefault();
						
						if (document.getElementById('qr').value.length > 9) {

							alert("Invalid ID Number!");
							return false;

						} else {

							$.ajax({
								url: $(this).attr("action"),
								type: "POST",
								data: $(this).serialize(),

								success: function (response) {
									if (response == "invalid") {
										alert("Duplicate Data!");
										$("#qr").val("");
									} else {
										$("#content").html(response);
										$("#qr").val("");
									}
								},
								error: function () {
									alert("Caught An Error!");
									$("#qr").val("");
								}
							});
						}

					});
				});
				</script>
			</fieldset>
			
		</div>
		<div class="col-md-6">
			<fieldset class="card">
				<legend>Checking Attendance: </legend>
				<form id="Qr-check" action="query2.php" method="POST" autocomplete="off">
					
					<div class="form-group">
						<label class="text-mute">QR Code: </label>
						<input type="text" id="checkQr" name="checkQr" class="form-control">
					</div>
					<div class="form-group">
						<h6 id="message" align="center"></h6>
					</div>

				</form>

				<div id="content2">
					
				</div>

				<script type="text/javascript">
					$(document).ready(function () {
						
						$("#Qr-check").submit(function (evt) {
							evt.preventDefault();

							$.ajax({
								url: $(this).attr("action"),
								type: "POST",
								data: $(this).serialize(),

								success: function (response) {
									if (response == "false") {
										$("#message").html("Registered First!");
										$("#checkQr").val("");
									} else if (response == "invalid"){
										$("#message").html("Duplicate Data!");
										$("#checkQr").val("");
									} else {
										$("#content2").html(response);
										$("#checkQr").val("");
									}
									
								},
								error: function () {
									alert("Caught an Error!");
								}
							});

						});

					});
				</script>

			</fieldset>
		</div>
		
	</div>
	
</div>

</body>
</html>
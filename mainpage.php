<?php 

	session_start();

	include("connection.php");

	$query = "SELECT `diary` FROM `users` WHERE `id` = '".$_SESSION['id']."' LIMIT 1";

	$result = mysqli_query($link, $query);

	$row = mysqli_fetch_array($result);

	$diary = $row['diary'];

?>

<!DOCTYPE html>	
<html lang="en">	
<head>	
<meta charset="utf-8">	
<meta http-equiv="X-UA-Compatible" content="IE=edge">	
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Yournal</title>	

<!-- Bootstrap -->	
<link href="css/bootstrap.min.css" rel="stylesheet">	

	
<style>	
	
	 .navbar-brand {
	 	font-size:1.8em;	
	 }	

	 #topContainer {	
	 	 background-image:url("background.jpg");
	 	 height:400px;	
	 	 width:100%;	
	 	 background-size:cover;	
	 	 }	
	 	 	
	 #topRow {	
	 	 margin-top:80px;	
	 	 text-align:center;	
	 }	
	 	
	 #topRow h1 {	
		font-size:300%;	
	 }	
	 	
	 #emailSignup {		
		margin-top:50px;	
	 }	
	 	
	 .bold {		
		font-weight:bold;	
	 }	
	 	
	 .marginTop {	
	 	margin-top:30px;	
	 }	
	 	
	 .center {		
		text-align:center;	
	 }	
	 	
	 .title {	
	 	margin-top:100px;	
	 	font-size:300%;	
	 }	
	 	
	 #footer {	
	 	background-color:#B0D1FB;	
	 	padding-top:70px;	
	 	width:100%;	
	 }	
	 	
	 .marginBottom {	
		margin-bottom:30px;	
	 }	

	 .appstoreImage {		 	
		width:250px;	
	 }	

</style>	
</head>	

<body data-spy="scroll" data-target=".navbar-collapse">

<div class="navbar navbar-default navbar-fixed-top">

	<div class="container">	

	 	 <div class="navbar-header pull-left">	
			<a class="navbar-brand">Yournal</a>	
	 	</div>	

	 	<div class="pull-right">	
	 	 	<ul class="navbar-nav nav">
	 	 	<li><a href="index.php?logout=1">Log out</a></li>

	 	 	</ul>
	 	</div>	

	</div>	

</div>	

<div class="container contentContainer" id="topContainer">	
	
	 <div class="row">	

	 	<div class="col-md-6 col-md-offset-3" id="topRow">	
	 	 	
	 	 	<textarea class="form-control"><?php echo $diary; ?></textarea>
	 	 	
	 	 	
	 	 </div>	
	</div>	
	
</div>	

	
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
<!-- Include all compiled plugins (below), or include individual files as
needed -->	
<script src="js/bootstrap.min.js"></script>	
	
<script>	
	
	$(".contentContainer").css("min-height",$(window).height());

	$("textarea").css("min-height",$(window).height()-120);

	$("textarea").keyup(function() {

		$.post("updatediary.php", {diary: $("textarea").val()});

	});

</script>	

</body>	
</html>



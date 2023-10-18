<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width-device-width, initial-scale=1">
	<meta name="description" content="réseau social pour moi">
	<meta name="author" content="Claudio rama">
	<link rel="icon" href="../../favicon.ico">
	

	<title>
		<?=
		isset($title) 
			? $title . ' - ' 
			: WEBSITE_NAME.',Simple,Rapide,Efficace '
		?>
	CLD social network
	</title>


	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
 
	<!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> -->
	
		
		<!--STYLESHEET -->
	
	<!--
	<link href="//maxcdn.bootstrapccn.com/bootswatch/3.2.0/readable/bootstrap.min.css" rel="stylesheet">

	-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	
	<!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	-->
	
	<link href="assets/fontawesome/css/font-awesome.min.css" rel="stylesheet"> 

	<link rel="stylesheet" type="text/css" href="assets/js/google-code-pretiffy/prettify.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="libraries/uploadify/uploadify.css">
	<link rel="stylesheet" type="text/css" href="libraries/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="libraries/alertifyjs/css/themes/bootstrap.min.css">

	<link rel="stylesheet" href="libraries/sweetalert/sweetalert.css"> 
<link rel="stylesheet" href="assets/css/sweetalert2.css">
</head>
<body>
	<?php
	include('partials/_nav.php');
	include('partials/_flash.php');
	?>
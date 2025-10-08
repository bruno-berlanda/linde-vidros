<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Linde : Painel de Administração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="120">
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css?<?php echo filemtime('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="css/adm_linde.css?<?php echo filemtime('css/adm_linde.css'); ?>">
    <link rel="stylesheet" href="css/fontawesome-all.min.css?<?php echo filemtime('css/fontawesome-all.min.css'); ?>">
    
    <script src="js/jquery.min.js"></script>
    
    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <!-- iCheck -->
    <link href="css/flat/_all.css" rel="stylesheet">
	<script src="js/icheck.js"></script>
    
    <script>
	$(document).ready(function(){
	  $('input').iCheck({
		checkboxClass: 'icheckbox_flat',
		radioClass: 'iradio_flat'
	  });
	});
	</script>
    
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet" type="text/css">
</head>
<?php
// Démarrage de la session
session_start();

// Définitions des variables nécessaires
require('config.php');
$page = 'home';
if(isset($_GET['page']) && !empty($_GET['page'])){
	$page = $_GET['page'];
}
if(!file_exists('views/admin/'.$page.'.php') || !file_exists('models/admin/'.$page.'.php')){
	$page = '404';
}
if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
	$page = 'login';
}

// Traitement de la page
require_once('models/admin/'.$page.'.php');

// Header de la page
echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>';
if(isset($title)){
	echo $title.' - Admin - Mavi Services';
}else{
	echo 'Admin - Mavi Services';
}
echo '</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700" rel="stylesheet" type="text/css">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="'.$url.'css/admin.css">

	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
</head>
<body>';
if($page != 'login'){
	echo '<div class="navbar-wrapper">
	<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand accent" href="'.$url.'">Mavi Services</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="'.$url.'admin">Accueil</a></li>
					<li><a href="'.$url.'admin/pages">Pages</a></li>
					<li><a href="'.$url.'admin/menu">Menu</a></li>
					<li><a href="'.$url.'admin/images">Images</a></li>
					<li><a href="'.$url.'admin/shop">Boutique</a></li>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li><a href="'.$url.'admin/logout">Déconnexion</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<br>
<br>';
}

// Affichage de la vue
require_once('views/admin/'.$page.'.php');

// Footer de la page
echo '<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>';

// Fin du code
?>

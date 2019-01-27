<?php
// Démarrage de la session
session_start();

// Définitions des variables nécessaires
require('config.php');
$page = 'home';
if(isset($_GET['page']) && !empty($_GET['page'])){
	$page = $_GET['page'];
}
if(!file_exists('views/'.$page.'.php') || !file_exists('models/'.$page.'.php')){
	$page = '404';
}
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'logo'");
$logo = $sql->fetch();
$logo = $logo['value'];
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'background'");
$background = $sql->fetch();
$background = $background['value'];
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'footer'");
$footer = $sql->fetch();
$footer = $footer['value'];

// Traitement de la page
require_once('models/'.$page.'.php');

function displayMenu($parent, $bdd){
	$sql = $bdd->prepare("SELECT *, (SELECT COUNT(*) FROM menu as under WHERE under.parent = menu.id) as under FROM menu WHERE parent = ?");
	$sql->execute(array($parent));
	while($dn = $sql->fetch()){
		if($dn['under'] > 0) {
			echo '<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$dn['label'].'
				<span class="caret"></span></a>
				<ul class="dropdown-menu">';
					displayMenu($dn['id'], $bdd);
				echo '</ul>
			</li>';
		}else{
			echo '<li><a href="'.$dn['link'].'">'.$dn['label'].'</a></li>';
		}
	}
}

// Header de la page
echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>';
if(isset($title)){
	echo $title.' - Mavi Services';
}else{
	echo 'Mavi Services';
}
echo '</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700" rel="stylesheet" type="text/css">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="'.$url.'css/custom.css">

	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="keywords" content="Mavi services, Informatique">

	<style>
	body{
		background: '.(preg_match('/^http/', $background) ? 'url(\''.$background.'\')' : $background).';
		background-attachment: fixed;
		background-size: 100%;
	}
	</style>
</head>
<body>
<div class="wrapper">
<div class="header">
	<div class="container no-background">
		<img src="'.$logo.'" class="logo hidden-xs">
		<div class="visible-xs">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand accent" href="'.$url.'">Mavi Services</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">';
			displayMenu(0, $bdd);
			echo '</ul>
		</div>
	</div>
</div>';

// Affichage de la vue
require_once('views/'.$page.'.php');

// Footer de la page
echo '<div class="container"><br/></div>
<div class="push"></div>
</div>
<div class="footer">
	<div class="container no-background">'.$footer.'</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>';

// Fin du code
?>

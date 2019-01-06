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

// Traitement de la page
require_once('models/'.$page.'.php');

function displayMenu($parent, $bdd){
	$sql = $bdd->prepare("SELECT * FROM menu WHERE parent = ?");
	$sql->execute(array($parent));
	while($dn = $sql->fetch()){
		echo '<li><a href="'.$dn['link'].'">'.$dn['label'].'</a></li>';
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
	<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700" rel="stylesheet" type="text/css">

	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
<header>
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
				/*<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Test
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a>Test1</a></li>
					</ul>
				</li>*/
			displayMenu(0, $bdd);
			echo '</ul>
		</div>
	</div>
</header>';

// Affichage de la vue
require_once('views/'.$page.'.php');

// Footer de la page
$sql = $bdd->query("SELECT * FROM pub ORDER BY rand() LIMIT 1");
$pub = $sql->fetch();
if($pub){
	echo '<div class="pub">
		<a href="'.$pub['link'].'">'.$pub['content'].'</a>
	</div>';
}
echo '<div class="container"><br/></div>
<footer>
	<div class="container no-background">
		<div class="row">
			<div class="col-md-3">
				<h4>Title</h4><br/>
				<a href="#">A link</a><br/>
				<a href="#">Another link</a>
			</div>
		</div>
	</div>
</footer>
<script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>';

// Fin du code
?>
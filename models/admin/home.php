<?php
$title = 'Accueil';
if(isset($_POST['main_page'])){
	$sql = $bdd->prepare("UPDATE vars SET value = ? WHERE name = 'main_page'");
	$sql->execute(array($_POST['value']));
	$sql = $bdd->prepare("SELECT * FROM pages WHERE id = ?");
	$sql->execute(array($_POST['value']));
	$dn = $sql->fetch();
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La page d\'accueil est maintenant : '.$dn['name'].'
	</div>';
}else if(isset($_POST['404_page'])){
	$sql = $bdd->prepare("UPDATE vars SET value = ? WHERE name = '404_page'");
	$sql->execute(array($_POST['value']));
	$sql = $bdd->prepare("SELECT * FROM pages WHERE id = ?");
	$sql->execute(array($_POST['value']));
	$dn = $sql->fetch();
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La page d\'erreur 404 est maintenant : '.$dn['name'].'
	</div>';
}else if(isset($_POST['logo'])){
	$sql = $bdd->prepare("UPDATE vars SET value = ? WHERE name = 'logo'");
	$sql->execute(array($_POST['value']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le logo a bien été modifié !
	</div>';
}else if(isset($_POST['background'])){
	$sql = $bdd->prepare("UPDATE vars SET value = ? WHERE name = 'background'");
	$sql->execute(array($_POST['value']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		L\'arrière plan du site a bien été modifié !
	</div>';
}
?>
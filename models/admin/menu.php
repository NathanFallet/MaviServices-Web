<?php
$title = 'Menu';
if(isset($_POST['add'])){
	$sql = $bdd->prepare("INSERT INTO menu (label, link, parent) VALUES(?, ?, ?)");
	$sql->execute(array($_POST['label'], $_POST['link'], $_POST['parent']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le lien '.$_POST['label'].' a bien été ajouté !
	</div>';
}else if(isset($_POST['edit'])){
	$sql = $bdd->prepare("UPDATE menu SET label = ?, link = ?, parent = ? WHERE id = ?");
	$sql->execute(array($_POST['label'], $_POST['link'], $_POST['parent'], $_POST['id']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le lien '.$_POST['label'].' a bien été modifié !
	</div>';
}else if(isset($_POST['delete'])){
	$sql = $bdd->prepare("DELETE FROM menu WHERE id = ?");
	$sql->execute(array($_POST['id']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le lien '.$_POST['label'].' a bien été supprimé !
	</div>';
}
?>

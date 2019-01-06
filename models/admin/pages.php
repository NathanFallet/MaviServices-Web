<?php
$title = 'Pages';
if(isset($_POST['add'])){
	$sql = $bdd->prepare("INSERT INTO pages (name) VALUES(?)");
	$sql->execute(array($_POST['name']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La page '.$_POST['name'].' a bien été ajouté !
	</div>';
}else if(isset($_POST['edit'])){
	$sql = $bdd->prepare("UPDATE pages SET name = ?, content = ? WHERE id = ?");
	$sql->execute(array($_POST['name'], $_POST['content'], $_POST['id']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La page '.$_POST['name'].' a bien été modifié !
	</div>';
}else if(isset($_POST['delete'])){
	$sql = $bdd->prepare("DELETE FROM pages WHERE id = ?");
	$sql->execute(array($_POST['id']));
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La page '.$_POST['name'].' a bien été supprimé !
	</div>';
}
?>
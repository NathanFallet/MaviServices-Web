<?php
$title = 'Boutique';
if(isset($_POST['cats_add'])){
	$sql = $bdd->prepare("INSERT INTO shop_cats (name, parent) VALUES(?, ?)");
	$sql->execute(array($_POST['name'], $_POST['parent']));
	$cats_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La catégorie '.$_POST['name'].' a bien été ajouté !
	</div>';
	$selected = 'cats';
}else if(isset($_POST['cats_edit'])){
	$sql = $bdd->prepare("UPDATE shop_cats SET name = ?, parent = ? WHERE id = ?");
	$sql->execute(array($_POST['name'], $_POST['parent'], $_POST['id']));
	$cats_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La catégorie '.$_POST['name'].' a bien été modifié !
	</div>';
	$selected = 'cats';
}else if(isset($_POST['cats_delete'])){
	$sql = $bdd->prepare("DELETE FROM shop_cats WHERE id = ?");
	$sql->execute(array($_POST['id']));
	$cats_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		La catégorie '.$_POST['name'].' a bien été supprimé !
	</div>';
	$selected = 'cats';
}else if(isset($_POST['articles_add'])){
	$sql = $bdd->prepare("INSERT INTO shop_items (name, description, description_little, prix, parent, link, img) VALUES(?, ?, ?, ?, ?, ?, ?)");
	$sql->execute(array($_POST['name'], $_POST['description'], $_POST['description_little'], $_POST['prix'], $_POST['parent'], $_POST['link'], $_POST['img']));
	$articles_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		L\'article '.$_POST['name'].' a bien été ajouté !
	</div>';
	$selected = 'articles';
}else if(isset($_POST['articles_edit'])){
	$sql = $bdd->prepare("UPDATE shop_items SET name = ?, description = ?, description_little = ?, prix = ?, parent = ?, link = ?, img = ? WHERE id = ?");
	$sql->execute(array($_POST['name'], $_POST['description'], $_POST['description_little'], $_POST['prix'], $_POST['parent'], $_POST['link'], $_POST['img'], $_POST['id']));
	$articles_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		L\'article '.$_POST['name'].' a bien été modifié !
	</div>';
	$selected = 'articles';
}else if(isset($_POST['articles_delete'])){
	$sql = $bdd->prepare("DELETE FROM shop_items WHERE id = ?");
	$sql->execute(array($_POST['id']));
	$articles_message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		L\'article '.$_POST['name'].' a bien été supprimé !
	</div>';
	$selected = 'articles';
}
?>
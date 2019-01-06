<?php
if(!isset($_GET['id'])){
	header('location: '.$url);
	exit;
}
$sql = $bdd->prepare("SELECT * FROM pages WHERE id = ?");
$sql->execute(array($_GET['id']));
$page_data = $sql->fetch();
if(!$page_data){
	header('location: '.$url.'404');
	exit;
}
$title = $page_data['name'];
<?php
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'main_page'");
$dn = $sql->fetch();
if(!$dn){
	header('location: '.$url.'404');
}
$_GET['id'] = $dn['value'];
$page = 'pages';
require_once('models/pages.php');
?>
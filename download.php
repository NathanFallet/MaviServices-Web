<?php
session_start();
if(!isset($_GET['id'])){
	exit;
}
require('config.php');
$sql = $bdd->prepare("SELECT * FROM downloads WHERE id = ?");
$sql->execute(array($_GET['id']));
$item = $sql->fetch();
$name = $item['file'];
$filename = dirname(__FILE__)."/files/".$name;
if (!is_file($filename) || !is_readable($filename)) {
	echo 'UNABLE TO FIND THE FILE';
    exit;
}
$size = filesize($filename);

session_write_close();
 
// désactive la mise en cache
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
 
// force le téléchargement du fichier avec un beau nom
header("Content-Type: application/force-download");
header('Content-Disposition: attachment; filename="'.$name.'"');
 
// indique la taille du fichier à télécharger
header("Content-Length: ".$size);
 
// envoi le contenu du fichier
readfile($filename);
?>
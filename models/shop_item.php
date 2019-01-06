<?php
if(!isset($_GET['id'])){
	header('location: '.$url.'shop');
	exit;
}
$sql = $bdd->prepare("SELECT * FROM shop_items WHERE id = ?");
$sql->execute(array($_GET['id']));
$item = $sql->fetch();
if(!$item){
	header('location: '.$url.'shop');
	exit;
}
$title = $item['name'].' - Boutique';

function getPriceText($item, $bdd){
	$price = $item['prix'];
	if($price == -1){
		return 'Prix variable';
	}else if($price == 0){
		return 'Télécharger';
	}
	return 'Acheter : '.$price.' €';
}

function displayDiscover($bdd, $id, $url){
	$sql = $bdd->prepare("SELECT * FROM shop_items WHERE id != ? ORDER BY rand() LIMIT 3");
	$sql->execute(array($id));
	while($item = $sql->fetch()){
		echo '<div class="col-md-4">
			<h2>'.$item['name'].'</h2>
			<p>'.str_replace("\\\"", "\"", str_replace("\\'", "'", $item['description_little'])).'</p>
			<p>
				<a href="'.$url.'shop_item/'.$item['id'].'"><button class="btn btn-default">Plus d\'info</button>
				<button class="btn btn-success pull-right">'.getPriceText($item, $bdd).'</button></a>
			</p>
		</div>';
	}
}
?>
<?php
$title = 'Boutique';

function getCats($parent, $bdd){
	$sql = $bdd->prepare("SELECT * FROM shop_cats WHERE parent = ?");
	$sql->execute(array($parent));
	return $sql;
}

function getItems($parent, $bdd){
	$sql = $bdd->prepare("SELECT * FROM shop_items WHERE parent = ? ORDER BY id DESC");
	$sql->execute(array($parent));
	return $sql;
}

function displayCats($parent, $parent_name, $bdd){
	$sql = getCats($parent, $bdd);
	while($cat = $sql->fetch()){
		if(hasChild($cat['id'], $bdd)){
			displayCats($cat['id'], (empty($parent_name) ? '' : $parent_name.' > ').$cat['name'], $bdd);
		}else{
			echo '<li><a data-toggle="tab" href="#cat'.$cat['id'].'">'.(empty($parent_name) ? '' : $parent_name.' > ').$cat['name'].'</a></li>';
		}
	}
}

function hasChild($cat, $bdd){
	$sql = $bdd->prepare("SELECT * FROM shop_cats WHERE parent = ?");
	$sql->execute(array($cat));
	$dn = $sql->fetch();
	if($dn){
		return true;
	}
	return false;
}

function hasItems($cat, $bdd){
	$sql = $bdd->prepare("SELECT * FROM shop_items WHERE parent = ?");
	$sql->execute(array($cat));
	$dn = $sql->fetch();
	if($dn){
		return true;
	}
	return false;
}

function displayItems($bdd, $url){
	$sql = $bdd->query("SELECT * FROM shop_cats");
	while($cat = $sql->fetch()){
		$sql2 = getItems($cat['id'], $bdd);
		$add = '';
		if(isset($_GET['id']) && $_GET['id'] == $cat['id']){
			$add = ' in active';
		}
		echo '<div id="cat'.$cat['id'].'" class="tab-pane fade'.$add.'">';
		if(hasItems($cat['id'], $bdd)){
			while($item = $sql2->fetch()){
				echo '<div class="col-md-6">
					<h2>'.$item['name'].'</h2>
					<div class="row">';
if(!empty($item['img'])){
	echo '<div class="col-md-3">
		<img src="'.$item['img'].'" width="100%">
	</div>
	<div class="col-md-9">
		<p>'.str_replace("\\\"", "\"", str_replace("\\'", "'", $item['description_little'])).'</p>
	</div>';
}else{
	echo '<div class="col-md-12">
		<p>'.str_replace("\\\"", "\"", str_replace("\\'", "'", $item['description_little'])).'</p>
	</div>';
}
echo '</div>
					<p>
						<a href="'.$url.'shop_item/'.$item['id'].'"><button class="btn btn-default">Plus d\'info</button></a>
						<a href="'.$item['link'].'"><button class="btn btn-success pull-right">'.getPriceText($item, (isset($_SESSION['id']) ? $_SESSION['id'] : 0), $bdd).'</button></a>
					</p>
				</div>';
			}
		}else{
			echo '<p>Nous sommes désolé mais cette catégorie ne contient aucun article.</p>';
		}
		echo '</div>';
	}
}

function getPriceText($item, $user, $bdd){
	$price = $item['prix'];
	if($price == -1){
		return 'Prix variable';
	}else if($price == 0){
		return 'Télécharger';
	}else if($item['type'] == 'file'){
		$sql = $bdd->prepare("SELECT * FROM achat WHERE item = ? AND user = ?");
		$sql->execute(array($item['id'], $user));
		$dn = $sql->fetch();
		if($dn){
			return 'Télécharger';
		}
	}
	return 'Acheter : '.$price.' €';
}
?>
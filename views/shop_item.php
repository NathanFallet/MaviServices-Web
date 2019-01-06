<div class="container">
	<div class="page-header">
		<h1><?php echo $item['name']; ?> - Boutique</h1>
	</div>
	<div class="row">
<?php
if(!empty($item['img'])){
?>
	<div class="col-md-4">
		<img src="<?php echo $item['img']; ?>" width="100%">
	</div>
	<div class="col-md-8">
		<p><?php echo str_replace("\\\"", "\"", str_replace("\\'", "'", $item['description'])); ?></p>
	</div>
<?php
}else{
?>
	<div class="col-md-12">
		<p><?php echo str_replace("\\\"", "\"", str_replace("\\'", "'", $item['description'])); ?></p>
	</div>
<?php
}
?>
	</div>
	<p><a href="<?php echo $item['link']; ?>" class="btn btn-success"><?php echo getPriceText($item, $bdd); ?></a></p>
	<div class="page-header">
		<h2>Découvrez aussi</h2>
	</div>
	<?php displayDiscover($bdd, $item['id'], $url); ?>
</div>
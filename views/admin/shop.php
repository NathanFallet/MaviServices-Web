<div class="container">
	<div class="page-header">
		<h1>Boutique</h1>
	</div>
	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#cats" data-toggle="pill">Catégories</a></li>
				<li><a href="#articles" data-toggle="pill">Articles</a></li>
			</ul>
		</div>
		<div class="col-md-9">
			<div class="tab-content">
<?php
$add = ' in active';
if(isset($selected) && $selected != 'cats'){
	$add = '';
}
?>
				<div id="cats" class="tab-pane fade<?php echo $add; ?>">
<?php
if(isset($cats_message)){
	echo $cats_message;
}
?>
					<table class="table">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Parent</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn = $sql->fetch()){
	$sql2 = $bdd->prepare("SELECT * FROM shop_cats WHERE id = ?");
	$sql2->execute(array($dn['parent']));
	$dn2 = $sql2->fetch();
	echo '<tr>
		<td>'.$dn['name'].'</td>
		<td>'.($dn2 != null ? $dn2['name'] : 'Aucun').'</td>
		<td>
			<a href="#cats_edit_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;<a href="#cats_delete_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>';
}
?>
						</tbody>
					</table>
					<a href="#cats_add" data-toggle="pill" class="btn btn-primary">+ Ajouter une catégorie</a>
				</div>
				<div id="cats_add" class="tab-pane fade">
					<form method="post">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="parent">Parent :</label>
							<select class="form-control" name="parent" id="parent">
								<option value="0">Aucun</option>
<?php
$sql = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn = $sql->fetch()){
	echo '<option value="'.$dn['id'].'">'.$dn['name'].'</option>';
}
?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="cats_add" value="Ajouter">
						</div>
					</form>
				</div>
<?php
$sql = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn = $sql->fetch()){
	echo '<div id="cats_edit_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="form-group">
			<label for="name">Nom :</label>
			<input type="text" class="form-control" name="name" id="name" value="'.$dn['name'].'">
		</div>
		<div class="form-group">
			<label for="parent">Parent :</label>
			<select class="form-control" name="parent" id="parent">
				<option value="0">Aucun</option>';
$sql2 = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn2 = $sql2->fetch()){
	if($dn['id'] != $dn2['id']){
		echo '<option value="'.$dn2['id'].'"'.($dn['parent'] == $dn2['id'] ? ' selected' : '').'>'.$dn2['name'].'</option>';
	}
}
			echo '</select>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="cats_edit" value="Modifier">
		</div>
	</form>
</div>
<div id="cats_delete_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="name" value="'.$dn['name'].'">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="row">
			<div class="col-md-12">
				<div class="alert text-center">
					<h3>Voulez vous supprimer la catégorie '.$dn['name'].' ?</h3>
				</div>
			</div>
			<div class="col-md-6">
				<input type="submit" name="cats_delete" class="btn btn-primary" value="Oui" style="width: 100%;">
			</div>
			<div class="col-md-6">
				<a href="#cats" class="btn btn-primary" data-toggle="pill" style="width: 100%; display: block;">Non</a>
			</div>
		</div>
	</form>
</div>';
}
$add = '';
if(isset($selected) && $selected == 'articles'){
	$add = ' in active';
}
?>
				<div id="articles" class="tab-pane fade<?php echo $add; ?>">
<?php
if(isset($articles_message)){
	echo $articles_message;
}
?>
					<table class="table">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Description (petit)</th>
								<th>Prix</th>
								<th>Parent</th>
								<th>Lien</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = $bdd->query("SELECT * FROM shop_items ORDER BY parent");
while($dn = $sql->fetch()){
	$sql2 = $bdd->prepare("SELECT * FROM shop_cats WHERE id = ?");
	$sql2->execute(array($dn['parent']));
	$dn2 = $sql2->fetch();
	echo '<tr>
		<td>'.$dn['name'].'</td>
		<td>'.str_replace("\\\"", "\"", str_replace("\\'", "'", $dn['description_little'])).'</td>
		<td>'.$dn['prix'].'</td>
		<td>'.($dn2 != null ? $dn2['name'] : 'Aucun').'</td>
		<td><a href="'.$dn['link'].'">'.$dn['link'].'</a></td>
		<td><a href="'.$dn['img'].'">'.$dn['img'].'</a></td>
		<td>
			<a href="#articles_edit_'.$dn['id'].'" data-toggle="pill" onclick="CKEDITOR.replace(\'description_'.$dn['id'].'\');"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;<a href="#articles_delete_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>';
}
?>
						</tbody>
					</table>
					<a href="#articles_add" data-toggle="pill" class="btn btn-primary">+ Ajouter un article</a>
				</div>
				<div id="articles_add" class="tab-pane fade">
					<form method="post">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="description_little">Description (petit) :</label>
							<textarea class="form-control" name="description_little" id="description_little"></textarea>
						</div>
						<div class="form-group">
							<label for="description">Description (complet) :</label>
							<textarea class="form-control" name="description" id="description"></textarea>
						</div>
						<div class="form-group">
							<label for="prix">Prix :</label>
							<input type="text" class="form-control" name="prix" id="prix">
						</div>
						<div class="form-group">
							<label for="parent">Parent :</label>
							<select class="form-control" name="parent" id="parent">
<?php
$sql = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn = $sql->fetch()){
	echo '<option value="'.$dn['id'].'">'.$dn['name'].'</option>';
}
?>
							</select>
						</div>
						<div class="form-group">
							<label for="link">Lien :</label>
							<input type="text" class="form-control" name="link" id="link">
						</div>
						<div class="form-group">
							<label for="img">Image :</label>
							<input type="text" class="form-control" name="img" id="img">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="articles_add" value="Ajouter">
						</div>
					</form>
				</div>
<?php
$sql = $bdd->query("SELECT * FROM shop_items ORDER BY parent");
while($dn = $sql->fetch()){
	echo '<div id="articles_edit_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="form-group">
			<label for="name">Nom :</label>
			<input type="text" class="form-control" name="name" id="name" value="'.$dn['name'].'">
		</div>
		<div class="form-group">
			<label for="description_little">Description (petit) :</label>
			<textarea rows="3" class="form-control" name="description_little" id="description_little">'.str_replace("\\\"", "\"", str_replace("\\'", "'", $dn['description_little'])).'</textarea>
		</div>
		<div class="form-group">
			<label for="description_'.$dn['id'].'">Description (complet) :</label>
			<textarea rows="7" class="form-control" name="description" id="description_'.$dn['id'].'">'.str_replace("\\\"", "\"", str_replace("\\'", "'", $dn['description'])).'</textarea>
		</div>
		<div class="form-group">
			<label for="prix">Prix :</label>
			<input type="text" class="form-control" name="prix" id="prix" value="'.$dn['prix'].'">
		</div>
		<div class="form-group">
			<label for="parent">Parent :</label>
			<select class="form-control" name="parent" id="parent">';
$sql2 = $bdd->query("SELECT * FROM shop_cats ORDER BY parent");
while($dn2 = $sql2->fetch()){
	echo '<option value="'.$dn2['id'].'"'.($dn['parent'] == $dn2['id'] ? ' selected' : '').'>'.$dn2['name'].'</option>';
}
			echo '</select>
		</div>
		<div class="form-group">
			<label for="link">Lien :</label>
			<input type="text" class="form-control" name="link" id="link" value="'.$dn['link'].'">
		</div>
		<div class="form-group">
			<label for="img">Image :</label>
			<input type="text" class="form-control" name="img" id="img" value="'.$dn['img'].'">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="articles_edit" value="Modifier">
		</div>
	</form>
</div>
<div id="articles_delete_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="name" value="'.$dn['name'].'">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="row">
			<div class="col-md-12">
				<div class="alert text-center">
					<h3>Voulez vous supprimer l\'article '.$dn['name'].' ?</h3>
				</div>
			</div>
			<div class="col-md-6">
				<input type="submit" name="articles_delete" class="btn btn-primary" value="Oui" style="width: 100%;">
			</div>
			<div class="col-md-6">
				<a href="#articles" class="btn btn-primary" data-toggle="pill" style="width: 100%; display: block;">Non</a>
			</div>
		</div>
	</form>
</div>';
}
?>
			</div>
		</div>
	</div>
</div>
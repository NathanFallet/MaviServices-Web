<div class="container">
	<div class="page-header">
		<h1>Menu</h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">

				<div id="pages" class="tab-pane fade in active">
<?php
if(isset($message)){
	echo $message;
}
?>
					<table class="table">
						<thead>
							<tr>
								<th>Titre</th>
								<th>Parent</th>
								<th>Lien</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = $bdd->query("SELECT * FROM menu ORDER BY id");
while($dn = $sql->fetch()){
	$sql2 = $bdd->prepare("SELECT * FROM menu WHERE id = ?");
	$sql2->execute(array($dn['parent']));
	$dn2 = $sql2->fetch();
	echo '<tr>
		<td>'.$dn['label'].'</td>
		<td>'.($dn2 != null ? $dn2['label'] : 'Aucun').'</td>
		<td>'.$dn['link'].'</td>
		<td>
			<a href="'.$url.'pages/'.$dn['id'].'"><span class="glyphicon glyphicon-eye-open"></span></a>
			&nbsp;<a href="#edit_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;<a href="#delete_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>';
}
?>
						</tbody>
					</table>
					<a href="#add" data-toggle="pill" class="btn btn-primary">+ Ajouter un lien</a>
				</div>
				<div id="add" class="tab-pane fade">
					<form method="post">
						<div class="form-group">
							<label for="label">Titre :</label>
							<input type="text" class="form-control" name="label" id="label">
						</div>
						<div class="form-group">
							<label for="parent">Parent :</label>
							<select class="form-control" name="parent" id="parent">
								<option value="0">Aucun</option>
<?php
$sql = $bdd->query("SELECT * FROM menu ORDER BY parent");
while($dn = $sql->fetch()){
	echo '<option value="'.$dn['id'].'">'.$dn['label'].'</option>';
}
?>
							</select>
						</div>
						<div class="form-group">
							<label for="link">Lien :</label>
							<input type="text" class="form-control" name="link" id="link">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="add" value="Ajouter">
						</div>
					</form>
				</div>
<?php
$sql = $bdd->query("SELECT * FROM menu");
while($dn = $sql->fetch()){
	echo '<div id="edit_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="form-group">
			<label for="label">Titre :</label>
			<input type="text" class="form-control" name="label" id="label" value="'.$dn['label'].'">
		</div>
		<div class="form-group">
			<label for="parent">Parent :</label>
			<select class="form-control" name="parent" id="parent">
				<option value="0">Aucun</option>';
$sql2 = $bdd->query("SELECT * FROM menu ORDER BY parent");
while($dn2 = $sql2->fetch()){
	if($dn['id'] != $dn2['id']){
		echo '<option value="'.$dn2['id'].'"'.($dn['parent'] == $dn2['id'] ? ' selected' : '').'>'.$dn2['label'].'</option>';
	}
}
			echo '</select>
		</div>
		<div class="form-group">
			<label for="link">Lien :</label>
			<input type="text" class="form-control" name="link" id="link" value="'.$dn['link'].'">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="edit" value="Modifier">
		</div>
	</form>
</div>
<div id="delete_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="label" value="'.$dn['label'].'">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="row">
			<div class="col-md-12">
				<div class="alert text-center">
					<h3>Voulez vous supprimer le lien '.$dn['label'].' ?</h3>
				</div>
			</div>
			<div class="col-md-6">
				<input type="submit" name="delete" class="btn btn-primary" value="Oui" style="width: 100%;">
			</div>
			<div class="col-md-6">
				<a href="#pages" class="btn btn-primary" data-toggle="pill" style="width: 100%; display: block;">Non</a>
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

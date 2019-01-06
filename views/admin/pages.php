<div class="container">
	<div class="page-header">
		<h1>Pages</h1>
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
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php
$sql = $bdd->query("SELECT * FROM pages ORDER BY id");
while($dn = $sql->fetch()){
	echo '<tr>
		<td>'.$dn['name'].'</td>
		<td>
			<a href="'.$url.'pages/'.$dn['id'].'"><span class="glyphicon glyphicon-eye-open"></span></a>
			&nbsp;<a href="#edit_'.$dn['id'].'" data-toggle="pill" onclick="CKEDITOR.replace(\'content_'.$dn['id'].'\');"><span class="glyphicon glyphicon-pencil"></span></a>
			&nbsp;<a href="#delete_'.$dn['id'].'" data-toggle="pill"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
	</tr>';
}
?>
						</tbody>
					</table>
					<a href="#add" data-toggle="pill" class="btn btn-primary">+ Ajouter une page</a>
				</div>
				<div id="add" class="tab-pane fade">
					<form method="post">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="add" value="Ajouter">
						</div>
					</form>
				</div>
<?php
$sql = $bdd->query("SELECT * FROM pages");
while($dn = $sql->fetch()){
	echo '<div id="edit_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="form-group">
			<label for="name">Nom :</label>
			<input type="text" class="form-control" name="name" id="name" value="'.$dn['name'].'">
		</div>
		<div class="form-group">
			<label for="content_'.$dn['id'].'">Contenue :</label>
			<textarea rows="7" class="form-control" name="content" id="content_'.$dn['id'].'">'.str_replace("\\\"", "\"", str_replace("\\'", "'", $dn['content'])).'</textarea>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="edit" value="Modifier">
		</div>
	</form>
</div>
<div id="delete_'.$dn['id'].'" class="tab-pane fade">
	<form method="post">
		<input type="hidden" name="name" value="'.$dn['name'].'">
		<input type="hidden" name="id" value="'.$dn['id'].'">
		<div class="row">
			<div class="col-md-12">
				<div class="alert text-center">
					<h3>Voulez vous supprimer la page '.$dn['name'].' ?</h3>
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
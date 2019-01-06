<?php
$title = 'Images';

if(isset($_POST['add']) && isset($_FILES['file'])){
	$name = strtolower($_FILES['file']['name']);
	$name = preg_replace('#([^._a-z0-9])+#', '_', $name);
	move_uploaded_file($_FILES['file']['tmp_name'], 'images/'.$name);
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le fichier a bien été téléchargé !<br/>
		<a href="'.$url.'../images/'.$name.'">Voir le fichier</a>
	</div>';
}else if(isset($_POST['delete'])){
	$name = 'images/'.$_POST['name'];
	unlink($name);
	$message = '<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Le fichier a bien été supprimé !
	</div>';
}

function listDir($dir, $add) {
	$files = scandir($dir);
	foreach ($files as $key => $value) {
		if(!in_array($value, array('.', '..'))){
			if(!preg_match('#^[\.\_a-z0-9]+$#', $value)){
				$name = strtolower($value);
				$name = preg_replace('#([^._a-z0-9])+#', '_', $name);
				rename('images/'.$add.$value, 'images/'.$add.$name);
				$value = $name;
			}
			if(is_file('images/'.$add.$value)){
				echo '<tr>
					<td>'.$add.$value.'</td>
					<td>
						<a href="'.$url.'../images/'.$add.$value.'"><span class="glyphicon glyphicon-eye-open"></span></a>
						&nbsp;<a href="#delete_'.preg_replace('#[./]#', '_', $add.$value).'" data-toggle="pill"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>';
			}else{
				listDir('images/'.$add.$value.'/', $add.$value.'/');
			}
		}
	}
}

function listDirDelete($dir, $add) {
	$files = scandir($dir);
	foreach ($files as $key => $value) {
		if(!in_array($value, array('.', '..'))){
			if(is_file('images/'.$add.$value)){
				echo '<div id="delete_'.preg_replace('#[./]#', '_', $add.$value).'" class="tab-pane fade">
					<form method="post">
						<input type="hidden" name="name" value="'.$add.$value.'">
						<div class="row">
							<div class="col-md-12">
								<div class="alert text-center">
									<h3>Voulez vous supprimer l\'image '.$add.$value.' ?</h3>
								</div>
							</div>
							<div class="col-md-6">
								<input type="submit" name="delete" class="btn btn-primary" value="Oui" style="width: 100%;">
							</div>
							<div class="col-md-6">
								<a href="#images" class="btn btn-primary" data-toggle="pill" style="width: 100%; display: block;">Non</a>
							</div>
						</div>
					</form>
				</div>';
			}else{
				listDirDelete('images/'.$add.$value.'/', $add.$value.'/');
			}
		}
	}
}
?>
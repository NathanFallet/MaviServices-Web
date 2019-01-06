<div class="container">
	<div class="page-header">
		<h1>Accueil</h1>
	</div>
<?php
if(isset($message)){
	echo $message;
}
?>
	<form method="post">
		<div class="form-group">
			<label for="main_page">Page d'accueil du site :</label>
			<select class="form-control" name="value" id="main_page">
<?php
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'main_page'");
$main_page = $sql->fetch();
if(!$main_page){
	$main_page = 0;
}else{
	$main_page = $main_page['value'];
}
$sql = $bdd->query("SELECT * FROM pages");
while($dn = $sql->fetch()){
	echo '<option value="'.$dn['id'].'"'.($dn['id'] == $main_page ? ' selected' : '').'>'.$dn['name'].'</option>';
}
?>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="main_page" value="Modifier">
		</div>
	</form>
	<form method="post">
		<div class="form-group">
			<label for="404_page">Page d'erreur 404 du site :</label>
			<select class="form-control" name="value" id="404_page">
<?php
$sql = $bdd->query("SELECT * FROM vars WHERE name = '404_page'");
$main_page = $sql->fetch();
if(!$main_page){
	$main_page = 0;
}else{
	$main_page = $main_page['value'];
}
$sql = $bdd->query("SELECT * FROM pages");
while($dn = $sql->fetch()){
	echo '<option value="'.$dn['id'].'"'.($dn['id'] == $main_page ? ' selected' : '').'>'.$dn['name'].'</option>';
}
?>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="404_page" value="Modifier">
		</div>
	</form>
	<form method="post">
		<div class="form-group">
			<label for="logo">Logo :</label>
<?php
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'logo'");
$logo = $sql->fetch();
if(!$logo){
	$logo = '';
}else{
	$logo = $logo['value'];
}
?>
			<input type="text" name="value" id="logo" class="form-control" value="<?php echo $logo; ?>">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="logo" value="Modifier">
		</div>
	</form>
	<form method="post">
		<div class="form-group">
			<label for="background">Arrière plan du site :</label>
<?php
$sql = $bdd->query("SELECT * FROM vars WHERE name = 'background'");
$background = $sql->fetch();
if(!$background){
	$background = '';
}else{
	$background = $background['value'];
}
?>
			<input type="text" name="value" id="background" class="form-control" value="<?php echo $background; ?>">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" name="background" value="Modifier">
		</div>
	</form>
</div>
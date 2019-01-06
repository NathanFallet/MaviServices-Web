<div class="container">
	<div class="page-header">
		<h1>Contact</h1>
	</div>
	<?php
	if(isset($error)){
		echo $error;
	}
	?>
	<form method="post">
		<input type="text" class="form-control" name="nom" placeholder="Votre nom"><br/>
		<input type="text" class="form-control" name="prenom" placeholder="Votre prénom"><br/>
		<input type="mail" class="form-control" name="mail" placeholder="Votre mail"><br/>
		<input type="tel" class="form-control" name="tel" placeholder="Votre numéro de téléphone (facultatif)"><br/>
		<textarea name="msg" class="form-control" placeholder="Votre message"></textarea><br/>
		<input type="submit" class="btn btn-info" name="submit" value="Envoyer">
		</form>
</div>
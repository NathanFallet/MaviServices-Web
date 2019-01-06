<?php
if(isset($_POST['submit'])){
	$hidden = 1;
	if(!preg_match('#^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$#', $_POST['mail'])){
		if(isset($hidden)){
			unset($hidden);
		}
		$error = '<div class="alert alert-danger">Mail invalide !</div>';
	}else if(empty($_POST['nom'])){
		if(isset($hidden)){
			unset($hidden);
		}
		$error = '<div class="alert alert-danger">Entrez votre nom !</div>';
	}else if(empty($_POST['prenom'])){
		if(isset($hidden)){
			unset($hidden);
		}
		$error = '<div class="alert alert-danger">Entrez votre prénom !</div>';
	}else if(empty($_POST['msg'])){
		if(isset($hidden)){
			unset($hidden);
		}
		$error = '<div class="alert alert-danger">Entrez un message !</div>';
	}
}
if(isset($hidden)){
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$_POST['mail']."\r\n".
	'Reply-To: '.$_POST['mail']."\r\n".
	'X-Mailer: PHP/'.phpversion();
	$content = 'Ce message est issue du formulaire de contact du site Mavi Service<br/><br/>
	<b>Nom :</b> '.htmlspecialchars($_POST['nom']).'<br/>
	<b>Prénom :</b> '.htmlspecialchars($_POST['prenom']).'<br/>
	<b>Mail :</b> '.htmlspecialchars($_POST['mail']).'<br/>
	<b>Numéro de téléphone :</b> '.htmlspecialchars($_POST['tel']).'<br/>
	<b>Message :</b><br/>
	'.htmlspecialchars($_POST['msg']);
	if(mail('mavi.lh.services@gmail.com', 'Formulaire de contact', $content, $headers) && mail('nathan.fallet@gmail.com', 'Formulaire de contact', $content, $headers)){
		$error = '<div class="alert alert-success">Votre message à bien été envoyer !</div>';
	}else{
		$error = '<div class="alert alert-danger">Une erreur est survenue l\'ors de l\'envoie du mail.</div>';
	}
}
$title = 'Contact';
?>
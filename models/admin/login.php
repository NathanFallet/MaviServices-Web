<?php
$title = 'Connexion';
if(isset($_POST['login_admin'])){
	if($_POST['id'] == $admin_username && md5($_POST['password']) == md5($admin_password)){
		$_SESSION['admin'] = 1;
		header('location: '.$url.'admin');
		exit;
	}
}
?>

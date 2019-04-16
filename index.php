<?php 
session_start();
$fil = "";
$contrasenia = "";
$usuario = "";
$username = "";
if(!empty($_POST)){
	if(!empty($_POST['login']) && !empty($_POST['pword']))
	{
		$usuario = $_POST['login'];
		$contraseña = $_POST['pword'];
		include_once dirname(__FILE__).'/login.php';
		if(!empty($fil))
		{
			$_SESSION['inicio'] = 'iniciando';
			header('location: gelery.php');
		}
	}else
	{
		header('Location: error.php');	
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="uft-8"></meta>
		<meta name="viewport" content="width=divice-width,initial-scale=1,maximun-scale=1"></meta>
		<title>
			Iniciar Usuario
		</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body>
		<div id="login">
			<form  method="post" action="">
				<label> Usuario </label>
				<input type="text" name="login"/><br>
				<label> Contrase&ntilde;a</label>
				<input type="password" name="pword"><br>
				<input type="submit" name="btnlogin" value="login"/><br>
			</form>
		</div>
	</body>
</html>

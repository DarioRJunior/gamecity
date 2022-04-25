<?php
include ('config.php');
session_start();

if (@$_REQUEST['submit']=="Entrar")
{
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	$query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha' ";
	$result = mysqli_query($conexao, $query);
	while ($coluna=mysqli_fetch_array($result)) 
	{
		$_SESSION["id_usuario"]= $coluna["id"]; 
		$_SESSION["email_usuario"] = $coluna["email"]; 
		$_SESSION["nivel_usuario"] = $coluna["nivel"];

		// caso queira direcionar para páginas diferentes
		$niv = $coluna['nivel'];
		if($niv == "USER"){ 
			header("Location: sistema.php"); 
			exit; 
		}
		
		if($niv == "ADM"){ 
			header("Location: sistemaAdm.php"); 
			exit; 
		}
		// ----------------------------------------------
	}
	
}

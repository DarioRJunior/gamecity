<?php
include('config.php');
session_start(); // inicia a sessão	


if (@$_REQUEST['submit'] == "Entrar") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha' ";
    $result = mysqli_query($conexao, $query);
    while ($coluna = mysqli_fetch_array($result)) {
        $_SESSION["id_usuario"] = $coluna["id"];
        $_SESSION["email_usuario"] = $coluna["email"];
        $_SESSION["UsuarioNivel"] = $coluna["nivel"];

        // caso queira direcionar para páginas diferentes
        $niv = $coluna['nivel'];
        if ($niv == "USER") {
            header("Location: sistema.php");
            exit;
        }

        if ($niv == "ADM") {
            header("Location: sistemaAdm.php");
            exit;
        }
        // ----------------------------------------------
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCity - Login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        .box-login {
            background: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 20px;
            color: #fff;
        }

        input {
            padding: 15px;
            border: none;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        .inputsubmit {
            background: #4CAF50;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            text-transform: uppercase;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.4s ease-in-out;
        }

        .inputsubmit:hover {
            background: #028d09;
        }

        .voltar {
            background: #ffa500;
            width: 100px;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.4s ease-in-out;
        }

        .voltar:hover {
            background: #cc8400;
        }

        .voltar a {
            color: white;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <button class="voltar"><a href="home.php">Voltar</a></button>
    <div class="box-login">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="email">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <input class="inputsubmit" type="submit" name="submit" value="Entrar">
        </form>
    </div>
</body>

</html>
<?php
require('verifica.php');

if ($_SESSION["UsuarioNivel"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='sistema.php';</script>";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamecity - Administração</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        .menu {
            display: flex;
            justify-content: space-around;
            width: 940px;
            margin: 0 auto;
            color: #fff;
            align-items: center;
        }

        .menu-box ul {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .menu-box li {
            list-style: none;
            margin: 10px;
            font-size: 20px;
        }

        .menu-box li a {
            background: #9b111e;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 10px;
            text-transform: uppercase;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.4s ease-in-out;
        }

        .menu-box li a:hover {
            background: #7c0e18;
            color: #fff;
        }

        .sistema {
            display: flex;
            justify-content: space-around;
            width: 940px;
            margin: 0 auto;
            color: #fff;
            align-items: center;
        }

        .sistema-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(0, 0, 0, 0.9);
            width: 450px;
            padding: 10px;
        }

        .sistema-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #7c0e18;
            width: 400px;
            padding: 10px;
        }

        .sistema-container a {
            text-decoration: none;
            text-align: center;
            background: rgb(20, 147, 220);
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            width: 80%;
            text-transform: uppercase;
            transition: all 0.4s ease-in-out;
        }

        .sistema-container a:hover {
            background: rgb(17, 54, 71);
        }
    </style>
</head>

<body>
    <header class="menu">
        <h1>GameCity</h1>
        <nav class="menu-box">
            <ul>
                <li>
                    <p>Bem-vindo ao GameCity administrador, <?php echo $_SESSION["email_usuario"]; ?></p>
                </li>
                <li><a href="login.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="sistema">
            <div class="sistema-box">
                <div class="sistema-container">
                    <h2>O que deseja fazer?</h2>
                    <a href="cadastro-categorias.php">Cadastrar nova categoria</a>
                    <a href="">Liberação de anúncios</a>
                    <a href="excluir-anuncio-adm.php">Ver todos os anúncios</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
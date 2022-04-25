<?php
require('verifica.php');
include_once('config.php');

if ($_SESSION["UsuarioNivel"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='sistema.php';</script>";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamecity - Cadastro de Categorias</title>
    <script>
        function validaCampos() {
            if (document.fmCategorias.txtCategoria.value == "") {
                alert("Preencha o campo Categoria!");
                document.fmCategorias.txtCategoria.focus();
                return false;
            }
        }
    </script>
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

        .sistema-container input[type=text] {
            outline: none;
            padding: 5px;
            width: 100%;
            margin-top: 5px;
        }

        .btnCategoria {
            margin-top: 5px;
            border: none;
            text-decoration: none;
            text-align: center;
            background: rgb(20, 147, 220);
            color: #fff;
            padding: 10px;
            border-radius: 10px;
            width: 80%;
            text-transform: uppercase;
            transition: all 0.4s ease-in-out;
        }

        .btnCategoria:hover {
            cursor: pointer;
            background: rgb(17, 54, 71);
        }

        .itensCadastrados {
            border: 1px solid #9b111e;
            margin-top: 10px;
            display: flex;
            width: 400px;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            padding: 10px;
            border-radius: 10px;
        }

        .itensCadastrados a {
            margin-left: 10px;
        }

        .btnCadastradasEditar {
            text-decoration: none;
            color: #fff;
            background: rgb(20, 147, 220);
            padding: 10px;
            border-radius: 10px;
            transition: all 0.4s ease-in-out;
        }

        .btnCadastradasEditar:hover {
            cursor: pointer;
            background: rgb(17, 54, 71);
        }

        .btnCadastradasExcluir {
            text-decoration: none;
            color: #fff;
            background: #9b111e;
            padding: 10px;
            border-radius: 10px;
            transition: all 0.4s ease-in-out;
        }

        .btnCadastradasExcluir:hover {
            cursor: pointer;
            background: #7c0e00;
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
                <li><a href="sistemaAdm.php">Voltar</a></li>
                <li><a href="login.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="sistema">
            <div class="sistema-box">
                <div class="sistema-container">
                    <?php
                    if (isset($_GET['btnSubmitCategoria'])) {
                        $nomeCategoria = $_GET['txtCategoria'];
                        $link = $nomeCategoria;
                        $sql = "CALL sp_cadastra_categoria('$nomeCategoria', '$link', @saida)";
                        if ($res = mysqli_query($conexao, $sql)) {
                            $reg = mysqli_fetch_assoc($res);
                            $saida = $reg['saida'];
                            echo $saida;
                            echo "<br><br>";
                            echo "<a href='cadastro-categorias.php' target='_self'>Voltar</a>";
                        } else {
                            echo "Erro ao cadastrar categoria";
                        }
                    } else {
                    ?>
                        <h2>Cadastro de Categorias</h2>
                        <form name="fmCategorias" method="GET" action="cadastro-categorias.php" onsubmit="return validaCampos()">
                            <label>Nome da categoria:</label><br>
                            <input maxlength="50" type="text" name="txtCategoria" placeholder="Categoria"><br>
                            <button name="btnSubmitCategoria" type="submit" class="btnCategoria">Cadastrar</button>
                        </form>
                </div>
                <h2>Categorias Cadastradas:</h2>
                <?php
                        $sql = 'SELECT * FROM vw_retorna_categorias';
                        if ($res = mysqli_query($conexao, $sql)) {
                            $nomeCategoria = array();
                            $linkCategoria = array();
                            $idCategoria = array();
                            $i = 0;
                            while ($reg = mysqli_fetch_assoc($res)) {
                                $nomeCategoria[$i] = $reg['nome_categoria'];
                                $linkCategoria[$i] = $reg['link_categoria'];
                                $idCategoria[$i] = $reg['id_categoria'];
                ?>
                        <div>
                            <div class="itensCadastrados">
                                <p><?php echo $nomeCategoria[$i]; ?></p>
                            </div>
                        </div>

                <?php
                                $i++;
                            }
                        }
                ?>

            <?php

                    }
            ?>
            </div>
        </section>
    </main>

    <?php
    if (isset($conexao)) {
        mysqli_close($conexao);
    }
    ?>
</body>

</html>
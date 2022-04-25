<?php

if (isset($_POST['submit'])) {
    include_once('config.php');
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $nomeCategoria = $_POST['categoria'];

    $result = mysqli_query($conexao, "INSERT INTO jogos (nome, descricao, preco, link, categoria) VALUES ('$nome', '$descricao', '$preco', '', '$nomeCategoria')");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCity - Cadastro de anúncio</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        .box {
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }

        fieldset {
            border: 3px solid dodgerblue;
        }

        legend {
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }

        .inputBox {
            position: relative;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelInput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }

        .inputUser:focus~.labelInput,
        .inputUser:valid~.labelInput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }

        #submit {
            background: #4CAF50;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.4s ease-in-out;
        }

        #submit:hover {
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
    <button class="voltar"><a href="sistema.php">Voltar</a></button>
    <div class="box">
        <form action="cadastro-anuncios.php" method="POST">
            <fieldset>
                <legend><b>Fórmulário de Anúncios</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="descricao" id="descricao" class="inputUser" required>
                    <label for="descricao" class="labelInput">Descrição:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="preco" id="preco" class="inputUser" required>
                    <label for="preco" class="labelInput">Preço:</label>
                </div>
                <br><br>
                <div>
                    <label>Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option selected disable value="">Escolha...</option>
                        <?php
                        include_once("config.php");
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
                                $i++;
                            }
                        }
                        ?>
                        <?php
                        for ($i = 0; $i < count($nomeCategoria); $i++) {
                            echo "<option value='$idCategoria[$i]'>$nomeCategoria[$i]</option>";
                        }
                        ?>
                    </select>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </fieldset>
        </form>
    </div>
</body>

</html>
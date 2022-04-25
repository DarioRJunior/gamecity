<?php
include_once('config.php');

$sql = "SELECT * FROM jogos ORDER BY id ASC";

$result = $conexao->query($sql);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamecity - Home</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }

        header {
            display: flex;
            justify-content: space-around;
            width: 940px;
            margin: 0 auto;
            color: #fff;
            align-items: center;
        }

        .menu li {
            display: inline-block;
            list-style: none;
            background: #4CAF50;
            width: 120px;
            border: none;
            padding: 15px;
            color: white;
            text-align: center;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.4s ease-in-out;
        }

        .menu a {
            text-decoration: none;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            padding: 15px;
        }

        .menu li:hover {
            background: #028d09;
        }

        main {
            margin-top: 100px;
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
            width: 940px;
            padding: 10px;
        }

        .sistema-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #7c0e18;
            width: 800px;
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

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .table {
            border: 1px solid #9b111e;
            width: 800px;
            text-align: center;
        }

        .table td {
            border: 1px solid #9b111e;
            padding: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Bem vindo ao Gamecity</h1>
        <nav class="menu">
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="cadastro.php">Cadastro</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="sistema">
            <div class="sistema-box">
                <div class="sistema-container">
                    <h2>anúncios do GameCity</h2>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($produto_data = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $produto_data['nome'] . "</td>";
                                    echo "<td>" . $produto_data['descricao'] . "</td>";
                                    echo "<td>" . $produto_data['preco'] . "</td>";
                                    echo "<td>" . $produto_data['categoria'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
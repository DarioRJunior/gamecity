<?php
require('verifica.php');
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
    <title>Gamecity - Sistema</title>
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
            width: 940px;
            padding: 10px;
        }

        .sistema-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid #7c0e18;
            width: 900px;
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
            width: 890px;
            text-align: center;
        }

        .table td {
            border: 1px solid #9b111e;
            padding: 30px 0;
        }

        .btnEditar {
            background-color: #9b111e;
            color: #fff;
            padding: 6px;
            border-radius: 5px;

        }

        .btnEditar:hover {
            background-color: #7c0e18;
        }

        .voltar {
            background: #ffa500;
            width: 100px;
            border: none;
            padding: 10px;
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
    <header class="menu">
        <h1>GameCity</h1>
        <nav class="menu-box">
            <ul>
                <li>
                    <p>Bem-vindo ao GameCity, <?php echo $_SESSION["email_usuario"]; ?></p>
                </li>
                <button class="voltar"><a href="sistema.php">Voltar</a></button>
                <li><a href="login.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="sistema">
            <div class="sistema-box">
                <div class="sistema-container">
                    <h2>Meus anúncios</h2>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($produto_data = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $produto_data['id'] . "</td>";
                                    echo "<td>" . $produto_data['nome'] . "</td>";
                                    echo "<td>" . $produto_data['descricao'] . "</td>";
                                    echo "<td>" . $produto_data['preco'] . "</td>";
                                    echo "<td>" . $produto_data['categoria'] . "</td>";
                                    echo "<td>
                                <a class='btnEditar' href='edicao-anuncios.php?id=$produto_data[id]' title='Editar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a>

                            <a class='btnExcluir' href='delete.php?id=$produto_data[id]' title='Excluir'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
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
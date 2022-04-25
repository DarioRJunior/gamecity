<?php

include_once('config.php');

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $nomeCategoria = $_POST['categoria'];

    $sqlUpdate = "UPDATE jogos SET nome='$nome', descricao='$descricao', preco='$preco', categoria='$nomeCategoria' WHERE id='$id'";

    $result = $conexao->query($sqlUpdate);
}
    header("Location: lista-meus-anuncios.php");

?>
<?php
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'sistemaAnuncio';

    $conexao = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    // if(!$conexao){
    //     echo("Falha na conexão: " . mysqli_connect_error());
    // } else {
    //     echo("Conexão realizada com sucesso!");
    // }

    mysqli_query($conexao, "SET NAMES 'utf8'");
    mysqli_query($conexao, 'SET character_set_connection=utf8');
    mysqli_query($conexao, 'SET character_set_client=utf8');
    mysqli_query($conexao, 'SET character_set_results=utf8');
?>
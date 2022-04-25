-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Maio-2015 às 20:51
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
    time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8 */
;

--
-- Database: `sistema`
--
-- --------------------------------------------------------
--
-- Estrutura da tabela `usuario`
--
CREATE TABLE IF NOT EXISTS `usuario` (
    `id` int(2) NOT NULL,
    `nome` varchar(45) NOT NULL,
    `email` varchar(110) NOT NULL,
    `senha` varchar(15) NOT NULL,
    `nivel` varchar(4)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = latin1;

--
-- Extraindo dados da tabela `usuario`
--
INSERT INTO
    `usuario` (`id`, `nome`, `email`, `senha`, `nivel`)
VALUES
    (
        1,
        'Dario',
        'darioarjr321@gmail.com',
        '123',
        'ADM'
    ),
    --
    -- Indexes for dumped tables
    --
    --
    -- Indexes for table `usuario`
    --
ALTER TABLE
    `usuario`
ADD
    PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE
    `usuario`
MODIFY
    `id` int(2) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;

CREATE TABLE IF NOT EXISTS `jogos` (
    `id` int(2) NOT NULL AUTO_INCREMENT,
    `nome` varchar(45) NOT NULL,
    `descricao` varchar(45) NOT NULL,
    `preco` varchar(45) NOT NULL,
    `link` varchar(100),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `categorias` (
    `id` int(2) NOT NULL AUTO_INCREMENT,
    `categoria` varchar(50) NOT NULL,
    `link` varchar(100),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS `jogos_categorias` (
    `jogos_id` int(2) NOT NULL,
    `categorias_id` int(2) NOT NULL,
    PRIMARY KEY (`jogos_id`, `categorias_id`),
    CONSTRAINT fk_jogos_categorias_jogos
        FOREIGN KEY (`jogos_id`)
        REFERENCES `jogos` (`id`),
    CONSTRAINT fk_jogos_categorias_categorias
        FOREIGN KEY (`categorias_id`)
        REFERENCES `categorias` (`id`)

) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = latin1;


DELIMITER $$
CREATE OR REPLACE PROCEDURE sp_cadastra_categoria( IN nome_categoria VARCHAR(50),link_categoria VARCHAR(100),OUT saida varchar(80))
BEGIN
 IF NOT EXISTS(SELECT * FROM categorias WHERE categoria = nome_categoria OR link = link_categoria) THEN
    BEGIN
        INSERT INTO categorias (categoria, link)
        VALUES (nome_categoria, link_categoria);

        IF ROW_COUNT() = 0 THEN
            SET saida = 'Erro ao cadastrar categoria';
        ELSE
            SET saida = 'Categoria cadastrada com sucesso';
        END IF;
    END;
ELSE
    SET saida = 'OPS! Essa categoria já está cadastrada';
END IF;
SELECT saida;
END $$

DELIMITER ;

CALL sp_cadastra_categoria('Playstation 4','Playstation4',@saida);
CALL sp_cadastra_categoria('Nintendo Switch','NintendoSwitch',@saida);

DELIMITER $$
CREATE OR REPLACE  PROCEDURE sp_deleta_categoria(id_categoria INT,OUT saida varchar(80), OUT saida_rotulo varchar(80))
BEGIN
 IF NOT EXISTS(SELECT * FROM categorias WHERE id = id_categoria) THEN
    BEGIN
        SET saida = 'OPS! Essa categoria não existe';
END;
	ELSEIF EXISTS(SELECT * FROM vw_jogos_categorias WHERE id_categoria = id_categoria)THEN
    BEGIN
    SET saida_rotulo = 'OPS!';
    SET saida = 'Não foi possivel excluir está categoria pois está vinculada a um jogo';
    END;
ELSE
    DELETE FROM categorias WHERE id = id_categoria;
     IF ROW_COUNT() = 0 THEN
            SET saida = 'Erro ao excluir categoria';
        ELSE
            SET saida = 'Categoria excluída com sucesso';
        END IF;
END IF;
SELECT  saida_rotulo, saida;
END $$

DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE sp_edita_categoria(id_categoria INT, nome_categoria VARCHAR(50), link_categoria VARCHAR(100),OUT saida varchar(80))
BEGIN
 IF NOT EXISTS(SELECT * FROM categorias WHERE categoria = nome_categoria OR link = link_categoria) THEN
    BEGIN
       UPDATE categorias
       SET categoria = nome_categoria, link = link_categoria
       WHERE id = id_categoria;

        IF ROW_COUNT() = 0 THEN
            SET saida = 'Erro ao editar categoria';
        ELSE
            SET saida = 'Categoria editada com sucesso';
        END IF;
    END;
ELSE
   SET saida = 'OPS! Essa categoria já está cadastrada';
END IF;
    SELECT saida;
END $$

DELIMITER ;

CREATE VIEW vw_retorna_categorias AS
SELECT id as id_categoria, categoria as nome_categoria, link as link_categoria FROM categorias;

CREATE VIEW vw_jogos_categorias AS
SELECT jogos_id as id_jogo, categorias_id as id_categoria
FROM jogos_categorias;
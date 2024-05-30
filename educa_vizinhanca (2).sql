-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Maio-2024 às 19:47
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `educa_vizinhanca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administracao`
--

CREATE TABLE `administracao` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `nome_materno` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone_celular` varchar(20) DEFAULT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `data_nasc`, `sexo`, `nome_materno`, `cpf`, `email`, `telefone_celular`, `telefone_fixo`, `login`, `senha`, `cep` ) VALUES
(0, 'ana', '2001-01-01', 'Feminino', 'teste', '11955468745', 'teste@teste.com', '21983784343', '21983784343', 'teste@teste.com', '1234', NULL),
(1, 'ana', '2001-01-01', 'Feminino', 'teste', '123456789', 'teste@teste.com', '21983784343', '21983784343', 'teste@teste.com', '1234', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_curso`
--

CREATE TABLE `aluno_curso` (
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `comentario` varchar(50) NOT NULL,
  `data_comentario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(100) DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `localidade` varchar(100) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `areacurso` varchar(100) DEFAULT NULL,
  `tipocurso` varchar(50) DEFAULT NULL,
  `formato` varchar(50) DEFAULT NULL,
  `quantidadevagas` int(11) DEFAULT NULL,
  `duracao` varchar(50) DEFAULT NULL,
  `linksite` varchar(255) DEFAULT NULL,
  `inicioinscricoes` date DEFAULT NULL,
  `terminoinscricoes` date DEFAULT NULL,
  `fotocurso` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- EStrutura Tabela ADMIN-INSTI
--
CREATE TABLE `curso_admin_instituicao` (
  `id_curso` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_curso`, `id_admin`, `id_instituicao`),
  FOREIGN KEY (`id_curso`) REFERENCES `curso`(`id_curso`) ON DELETE CASCADE,
  FOREIGN KEY (`id_admin`) REFERENCES `admin`(`id_admin`) ON DELETE CASCADE,
  FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao`(`id_instituicao`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_salvo`
--

CREATE TABLE `curso_salvo` (
  `id_curso_sv` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cep`, `cidade`, `uf`, `logradouro`, 'bairro', `numero`) VALUES
('23092631', 'rio de janeiro', 'rj', 'rua tal', 'campo grande','11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id_instituicao` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `numero_insti` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `status` varchar(1) DEFAULT 'A',
  `cnpj` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`id_instituicao`, `nome`, `telefone`, `cep`, `complemento`, `numero_insti`, `email`, `senha`, `status`, `cnpj`) VALUES
(1, 'bra', '(21)98378-4343', '23092-631', 'casa', 23, 'bra@teste.com', '$2y$10$0w/9E1u8UtPMNEloLTqzsuU.1hpdcFoyLtJhy7YB4lF9g6u57fJ.6', 'A', '1234'),
(2, 'novo', '(21)983784343', '23092-631', 'casa', 255, 'novo@teste.com', '$2y$10$/Gm/cmQbLBsvDFiUF9ep8eFtdVO0PxzmaY74iUpGB6KC3rI7Ay0/i', 'A', '567'),
(3, 'dnv', '(22)12344-5454', '23092-631', 'casa', 6666, 'dnv@porra.com', '$2y$10$Vwk3Ju6WPsH0m5Nnl2RNZ.DL/A08gwQUjN7ta.KsC/0mZjifROA5W', 'A', '789'),
(4, 'dnv', '(22)12344-5454', '23092-631', 'casa', 6666, 'dnv@porra.com', '$2y$10$zFNe65KhVP9nHCpXqFyZ9O7AirUfKvVJ/cIfjGfiZ2Plj2dUg6.Um', 'A', '1011'),
(5, 'Yasmin Lucia Rezende De Souza', '(21)970330894', '23092-631', 'casa', 6666, 'yasminrezende228@gmail.com', '$2y$10$Ev1gVkzptF/9ZGP27/B3o.WvVPS7Zg30Jmtf.fEzl0Hw9zv9wo2rK', 'A', '1213');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administracao`
--
ALTER TABLE `administracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `cep` (`cep`);

--
-- Índices para tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD PRIMARY KEY (`id_aluno`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_instituicao` (`id_instituicao`);

--
-- Índices para tabela `curso_salvo`
--
ALTER TABLE `curso_salvo`
  ADD PRIMARY KEY (`id_curso_sv`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cep`);

--
-- Índices para tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`id_instituicao`),
  ADD KEY `cep` (`cep`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administracao`
--
ALTER TABLE `administracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso_salvo`
--
ALTER TABLE `curso_salvo`
  MODIFY `id_curso_sv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id_instituicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`cep`) REFERENCES `endereco` (`cep`);

--
-- Limitadores para a tabela `curso_salvo`
--
ALTER TABLE `curso_salvo`
  ADD CONSTRAINT `curso_salvo_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `curso_salvo_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

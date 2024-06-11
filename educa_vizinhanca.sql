-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jun-2024 às 05:22
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
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `administracao`
--

INSERT INTO `administracao` (`id_admin`, `usuario`, `email`, `senha`) VALUES
(1, 'AdminT', 'AdminOne@gmail', 'senha_adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
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
  `cep` varchar(10) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `auth_factor` varchar(50) NOT NULL,
  `auth_last` datetime DEFAULT NULL,
  `auth_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome`, `data_nasc`, `sexo`, `nome_materno`, `cpf`, `email`, `telefone_celular`, `telefone_fixo`, `usuario`, `senha`, `cep`, `registro`, `auth_factor`, `auth_last`, `auth_answer`) VALUES
(0, 'Felipe Martins ', '2004-09-12', 'masculino', 'Jessica Martins', '414.565.786-18', 'fp@gmail', '(+55)13-111111111', '(+55)13-33333333', 'userfp', '$2y$10$Yd.AnpTnhffGm5k.8qbMkuBT/QOfOlPS99/V9GQ4WMjG/31Hroh2.', '17603-75', '2024-06-10 16:55:31', '', NULL, NULL),
(1, 'teste', '2024-06-12', 'fem', 'silva', '111.111.111-11', 'teste@gmail', '+55(21)111111111', '+55(21)11111111', 'usuario', 'teste', '23540040', '2024-06-10 05:10:24', '', NULL, NULL),
(2, 'Maria Clara Souza', '2001-01-01', 'feminino', 'Luana Souza', '881.346.431-24', 'Mclara@gmail.com', '(+55)21-555555555', '(+55)21-11111111', 'Mclara', '$2y$10$KJnrs5yumqdxCRhQhztrUe3BskUS7fK4ZZbqQmmdRh4cNEifMRvvO', '05453-90', '2024-06-10 10:16:27', '', NULL, NULL),
(3, 'Gabriel Silveira', '1995-11-11', 'masculino', 'Mariana Teixeira', '714.447.939-34', 'GabSilva@gmail.com', '(+55)21-555555555', '(+55)21-11111111', 'GaSilv', '$2y$10$q/EK0JvKA/ZWtL6bsnCSf.i3u.0EDbG/9iB3IsQq2BORnLAcgJ1.u', '74555-51', '2024-06-11 00:51:15', '', NULL, NULL),
(4, 'julia magalhaes', '2000-04-16', 'outro', 'Tereza Aguiar', '439.343.171-54', 'julia@gmail.com', '(+55)21-555555555', '(+55)21-11111111', 'juliaM', '$2y$10$OBdigGle/ZOiDYV4ePqCHO2.58A.N23l0OiY13Y3oOAmbdNcsd4QC', '14056-56', '2024-06-10 14:22:55', '', NULL, NULL);

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
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `texto` text NOT NULL,
  `data` datetime NOT NULL
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

--
-- Estrutura da tabela `curso_admin_instituicao`
--

CREATE TABLE `curso_admin_instituicao` (
  `id_curso` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_instituicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

CREATE TABLE `curtida` (
  `id_curtida` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`cep`, `cidade`, `estado`, `logradouro`, `bairro`, `num`) VALUES
('05453-90', 'São Paulo', 'SP', 'Rua Doutor Luís Augusto de Queirós Aranha 173', 'Vila Madalena', '4'),
('14056-56', 'Ribeirão Preto', 'SP', 'Rua Ozório Zambonini', 'Planalto Verde', '3'),
('17603-75', 'Tupã', 'SP', 'Rua Orestes Bianchi', 'Jardim Santa Adélia', '8'),
('23540040', 'rio', 'rio', 'centro', 'centro', '4'),
('74555-51', 'Goiânia', 'GO', 'Rua T', 'Vila Ofugi', '11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id_instituicao` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nome_insti` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data_fundacao` date DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `telefone_celular` varchar(20) DEFAULT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`id_instituicao`, `nome`, `nome_insti`, `email`, `data_fundacao`, `cnpj`, `telefone_celular`, `telefone_fixo`, `cep`, `usuario`, `senha`) VALUES
(1, 'instituição One', 'Teste', 'InstituiçãoOne@gmail', '0000-00-00', '11111111111111', '+55(21)111111111', '+55(21)11111111', '23540040', 'instest', 'senha_inst');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL,
  `cor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `salvo`
--

CREATE TABLE `salvo` (
  `id_salvo` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administracao`
--
ALTER TABLE `administracao`
  ADD PRIMARY KEY (`id_admin`);

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
-- Índices para tabela `antigo_endereco`
--
ALTER TABLE `antigo_endereco`
  ADD PRIMARY KEY (`cep`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_instituicao` (`id_instituicao`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_instituicao` (`id_instituicao`);

--
-- Índices para tabela `curso_admin_instituicao`
--
ALTER TABLE `curso_admin_instituicao`
  ADD PRIMARY KEY (`id_curso`,`id_admin`,`id_instituicao`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_instituicao` (`id_instituicao`);

--
-- Índices para tabela `curtida`
--
ALTER TABLE `curtida`
  ADD PRIMARY KEY (`id_curtida`),
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
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `salvo`
--
ALTER TABLE `salvo`
  ADD PRIMARY KEY (`id_salvo`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administracao`
--
ALTER TABLE `administracao`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curtida`
--
ALTER TABLE `curtida`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id_instituicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `salvo`
--
ALTER TABLE `salvo`
  MODIFY `id_salvo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_fk_endereco` FOREIGN KEY (`cep`) REFERENCES `endereco` (`cep`);

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrinho_ibfk_3` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `curso_admin_instituicao`
--
ALTER TABLE `curso_admin_instituicao`
  ADD CONSTRAINT `curso_admin_instituicao_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_admin_instituicao_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `administracao` (`id_admin`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_admin_instituicao_ibfk_3` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `salvo`
--
ALTER TABLE `salvo`
  ADD CONSTRAINT `salvo_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `salvo_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06-Abr-2022 às 23:20
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `job`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cidade` text DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `resumo` text DEFAULT NULL,
  `habilidades` text DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `ingles` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`id`, `nome`, `email`, `senha`, `titulo`, `foto`, `cidade`, `telefone`, `resumo`, `habilidades`, `area`, `cv`, `ingles`, `estado`) VALUES
(1, 'Lucílio Gomes', 'lucilio@gmail.com', '12345', 'Técnico de Informática', NULL, 'Luanda', '922223432', 'Apaixonado por tecnologia. Estou a procura de novas oportunidades nas áreas de Programação e Segurança Cibernética', 'Conhecimentos em Programação, com Tecnologias Backend, PHP,Python, JavaScript.\r\nMetodologia Ágeis, Clean Code, TDD,DDD, Api\'s Restfull', 'Tecnologias de Informação', NULL, 'basico', 0),
(2, 'Pedro Viriato', 'pedro@gmail.com', '12345', 'Enfermeiro', NULL, 'Huambo, Angola', '934445566', 'Amante da Vida. Sou enfermeiro de profissão, comprometido com o melhoramento da vida dos meus pacientes.', 'Dinâmico. Boas práticas em primeiros socorros, suporte de vida, etc', 'Saúde', NULL, 'basico', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidatura`
--

CREATE TABLE `candidatura` (
  `id` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `id_vaga` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `escola` varchar(200) NOT NULL,
  `data_conclusao` date NOT NULL,
  `certificado` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `escola`, `data_conclusao`, `certificado`, `id_user`) VALUES
(1, 'Desenvolvimento Web', 'LUTEC-Formações', '2021-09-14', 'qewewwwqwqwwq.pdf', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `logotipo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `email`, `senha`, `ano`, `descricao`, `telefone`, `cidade`, `logotipo`) VALUES
(1, 'BITLINE SOFTWARES', 'geral.bitline@gmail.com', '12345', 2020, 'Empresa de Sofware, focada no desenvolvimento de Softwares de Gestão, Web sites, etc.', '922334455', 'Luanda, Angola', NULL),
(2, 'Clinica Pureza', 'pureza.clinica@gmail.com', '12345', 2018, 'Clinica Pureza, serviços de Saúde.', '922123456', 'Moxico', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `experiencia`
--

CREATE TABLE `experiencia` (
  `id` int(11) NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `experiencia`
--

INSERT INTO `experiencia` (`id`, `cargo`, `empresa`, `descricao`, `inicio`, `fim`, `id_user`) VALUES
(3, 'Técnico de Suporte em TI', 'Adobe IT', 'Manutenção de Computadores, Montagem, manutenção e operação em infraestruturas de redes, configuração de roteadores.', '2018-03-15', '2020-08-20', 1),
(4, 'Enfermeiro ', 'Hospital Vida Feliz', 'Consultas gerais, suporte de Vida, primeiros socorros', '2019-04-18', NULL, 2),
(5, 'Programador Júnior', 'Hack Soft', 'Criação de Paginas Web, Html, Css, JavaScript. ', '2020-12-24', '2022-02-23', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao`
--

CREATE TABLE `formacao` (
  `id` int(11) NOT NULL,
  `nivel` varchar(200) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `escola` varchar(200) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formacao`
--

INSERT INTO `formacao` (`id`, `nivel`, `curso`, `escola`, `inicio`, `fim`, `id_user`) VALUES
(1, 'medio', 'Informática', 'Instituto de Telecomunicações', '2014-02-04', '2017-12-28', 1),
(2, 'licenciado', 'Enfermagem Geral', 'Universidade Boa Vida', '2017-03-08', '2021-11-22', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` text NOT NULL,
  `nivel` varchar(200) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `nivel`) VALUES
(1, 'Luter Gomez', 'luter@gmail.com', '1234', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

CREATE TABLE `vaga` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `formato` varchar(200) NOT NULL,
  `modalidade` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `salario_min` double DEFAULT NULL,
  `salario_max` double DEFAULT NULL,
  `descricao` text NOT NULL,
  `habilidades` text NOT NULL,
  `ano_de_experiencia` int(11) DEFAULT NULL,
  `educacao` varchar(200) NOT NULL,
  `data_limite` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`id`, `titulo`, `formato`, `modalidade`, `cidade`, `salario_min`, `salario_max`, `descricao`, `habilidades`, `ano_de_experiencia`, `educacao`, `data_limite`, `estado`, `id_empresa`) VALUES
(1, 'Programador', 'full', 'presencial', 'Luanda', 300000, NULL, 'Desenvolvedor de Software, BACKEND.\r\nDesenvolver sites, softwares de variados generos.\r\nDar manutenção aos softwares existentes na compania.', 'Desenvolvimento Web\r\n- Dinamico\r\n- Html, Css, Javascript\r\n- PHP, JAVA\r\n- Angular , Sringboot\r\n- Git\r\n- Metodologias Ageis\r\n- Apis\r\n- Clean Code', 2, 'medio', '2022-04-14', 1, 1),
(2, 'Enfermeiro', 'full', 'presencial', 'Moxico', 200000, NULL, 'Tratar doentes, cuidar de doentes', 'Dinamico, Proeficiente em primeiros socorros', 1, 'licenciado', '2022-05-19', 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`);

--
-- Índices para tabela `candidatura`
--
ALTER TABLE `candidatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_candidato` (`id_candidato`),
  ADD KEY `id_vaga` (`id_vaga`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `experiencia`
--
ALTER TABLE `experiencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `formacao`
--
ALTER TABLE `formacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vaga`
--
ALTER TABLE `vaga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `candidato`
--
ALTER TABLE `candidato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `candidatura`
--
ALTER TABLE `candidatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `experiencia`
--
ALTER TABLE `experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `formacao`
--
ALTER TABLE `formacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vaga`
--
ALTER TABLE `vaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `candidatura`
--
ALTER TABLE `candidatura`
  ADD CONSTRAINT `candidatura_ibfk_1` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `candidatura_ibfk_2` FOREIGN KEY (`id_vaga`) REFERENCES `vaga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `candidato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `experiencia`
--
ALTER TABLE `experiencia`
  ADD CONSTRAINT `experiencia_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `candidato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `formacao`
--
ALTER TABLE `formacao`
  ADD CONSTRAINT `formacao_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `candidato` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vaga`
--
ALTER TABLE `vaga`
  ADD CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

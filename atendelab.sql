-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/07/2026 às 00:20
-- Versão do servidor: 8.0.43
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `atendelab`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id` int NOT NULL,
  `pessoa_id` int NOT NULL,
  `tipo_atendimento_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('aberto','em_andamento','concluido') COLLATE utf8mb4_general_ci DEFAULT 'aberto',
  `data_atendimento` date NOT NULL,
  `horario_atendimento` time NOT NULL,
  `observacao_final` text COLLATE utf8mb4_general_ci,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atendimentos`
--

INSERT INTO `atendimentos` (`id`, `pessoa_id`, `tipo_atendimento_id`, `usuario_id`, `descricao`, `status`, `data_atendimento`, `horario_atendimento`, `observacao_final`, `criado_em`, `atualizado_em`) VALUES
(1, 2, 4, 1, 'treste', 'aberto', '2026-07-03', '04:45:00', 'fzghzdgfh', '2026-07-03 22:04:31', '2026-07-03 22:19:30'),
(2, 1, 4, 1, 'wr', 'em_andamento', '2026-07-10', '04:45:00', '', '2026-07-03 22:06:48', '2026-07-03 22:13:49'),
(3, 2, 3, 1, 'ikxgjffzgtjh', 'concluido', '2026-07-09', '04:46:00', 'fdghzfgh', '2026-07-03 22:19:26', '2026-07-03 22:19:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int NOT NULL,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `documento` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `curso` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `periodo` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_general_ci,
  `status` enum('ativo','inativo') COLLATE utf8mb4_general_ci DEFAULT 'ativo',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `documento`, `telefone`, `email`, `curso`, `periodo`, `observacoes`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 'João da Silva', '123.456.789-00', '(47) 99999-0001', 'joao.silva@exemplo.com', 'Engenharia de Software', '5º', '', 'ativo', '2026-06-30 21:52:34', '2026-07-03 21:29:20'),
(2, 'Ana Carolina', '987.654.321-00', '(47) 99999-0002', 'ana.carolina@exemplo.com', 'Sistemas de Informação', '7º', '', 'ativo', '2026-06-30 21:52:34', '2026-07-03 21:29:17'),
(4, 'teste', '12525337999', '(47) 99999-0002', 'andremanoel.santana31@gmail.com', 'Sistemas de Informação', '7º', 'teste', 'inativo', '2026-07-03 21:30:59', '2026-07-03 21:37:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_atendimentos`
--

CREATE TABLE `tipos_atendimentos` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `status` enum('ativo','inativo') COLLATE utf8mb4_general_ci DEFAULT 'ativo',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_atendimentos`
--

INSERT INTO `tipos_atendimentos` (`id`, `nome`, `descricao`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 'Dúvida acadêmica', 'Dúvidas sobre disciplinas, conteúdos e atividades.', 'ativo', '2026-06-30 21:52:34', '2026-06-30 21:52:34'),
(2, 'Orientação de atividade', 'Orientações sobre trabalhos, TCC e projetos.', 'ativo', '2026-06-30 21:52:34', '2026-06-30 21:52:34'),
(3, 'Suporte técnico', 'Problemas com sistemas, equipamentos e acessos.', 'ativo', '2026-06-30 21:52:34', '2026-06-30 21:52:34'),
(4, 'Matrícula e documentação', 'Solicitações de matrícula, declarações e históricos.', 'ativo', '2026-06-30 21:52:34', '2026-06-30 21:52:34'),
(5, 'Acesso ao laboratório', 'Liberação de uso e agendamento de laboratórios.', 'ativo', '2026-06-30 21:52:34', '2026-06-30 21:52:34'),
(6, 'teste', 'teste', 'inativo', '2026-07-03 21:39:01', '2026-07-03 21:45:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `perfil` enum('admin','atendente') COLLATE utf8mb4_general_ci DEFAULT 'atendente',
  `status` enum('ativo','inativo') COLLATE utf8mb4_general_ci DEFAULT 'ativo',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `perfil`, `status`, `criado_em`, `atualizado_em`) VALUES
(1, 'Administrador', 'admin@atendelab.com', '$2a$12$Jnfgg0toPaK4c9WDNFvvjuSOYlyZyo4kkNxS8QnZzkhbLChyIRh1G', 'admin', 'ativo', '2026-06-30 21:52:34', '2026-06-30 22:20:24');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_atendimentos_pessoa` (`pessoa_id`),
  ADD KEY `fk_atendimentos_tipo` (`tipo_atendimento_id`),
  ADD KEY `fk_atendimentos_usuario` (`usuario_id`);

--
-- Índices de tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- Índices de tabela `tipos_atendimentos`
--
ALTER TABLE `tipos_atendimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipos_atendimentos`
--
ALTER TABLE `tipos_atendimentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `fk_atendimentos_pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`),
  ADD CONSTRAINT `fk_atendimentos_tipo` FOREIGN KEY (`tipo_atendimento_id`) REFERENCES `tipos_atendimentos` (`id`),
  ADD CONSTRAINT `fk_atendimentos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

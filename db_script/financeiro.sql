  -- phpMyAdmin SQL Dump
  -- version 5.2.1
  -- https://www.phpmyadmin.net/
  --
  -- Host: 127.0.0.1
  -- Tempo de geração: 26/11/2024 às 20:07
  -- Versão do servidor: 10.4.32-MariaDB
  -- Versão do PHP: 8.2.12

  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  START TRANSACTION;
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;

  --
  -- Banco de dados: `financeiro`
  --

  -- --------------------------------------------------------

  --
  -- Estrutura para tabela `gastos`
  --

  CREATE TABLE `gastos` (
    `id` int(11) NOT NULL,
    `categoria` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Despejando dados para a tabela `gastos`
  --

  INSERT INTO `gastos` (`id`, `categoria`) VALUES
  (1, 'Transporte'),
  (2, 'Alimentação'),
  (3, 'Saúde'),
  (5, 'Lazer');

  -- --------------------------------------------------------

  --
  -- Estrutura para tabela `meses`
  --

  CREATE TABLE `meses` (
    `id_mes` int(11) NOT NULL,
    `nome_mes` varchar(20) NOT NULL,
    `ano` int(4) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Despejando dados para a tabela `meses`
  --

  INSERT INTO `meses` (`id_mes`, `nome_mes`, `ano`) VALUES
  (1, 'Abril', 2024),
  (2, 'Novembro', 2024);

  -- --------------------------------------------------------

  --
  -- Estrutura para tabela `movimentacao`
  --

  CREATE TABLE `movimentacao` (
    `id` int(11) NOT NULL,
    `data_transacao` date NOT NULL,
    `tipo` enum('entrada','saida') NOT NULL,
    `descricao` varchar(255) NOT NULL,
    `valor` decimal(10,2) NOT NULL,
    `id_categoria` int(11) DEFAULT NULL,
    `id_mes` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  --
  -- Despejando dados para a tabela `movimentacao`
  --

  INSERT INTO `movimentacao` (`id`, `data_transacao`, `tipo`, `descricao`, `valor`, `id_categoria`, `id_mes`) VALUES
  (76, '2024-11-26', 'saida', 'Parque Aquático', 100.00, 5, 2),
  (77, '2024-04-26', 'saida', 'academia', 50.00, 3, 1);

  --
  -- Índices para tabelas despejadas
  --

  --
  -- Índices de tabela `gastos`
  --
  ALTER TABLE `gastos`
    ADD PRIMARY KEY (`id`);

  --
  -- Índices de tabela `meses`
  --
  ALTER TABLE `meses`
    ADD PRIMARY KEY (`id_mes`);

  --
  -- Índices de tabela `movimentacao`
  --
  ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`id_categoria`)
  REFERENCES `gastos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`id_mes`)
  REFERENCES `meses`(`id_mes`) ON DELETE CASCADE;
    

  --
  -- AUTO_INCREMENT para tabelas despejadas
  --

  --
  -- AUTO_INCREMENT de tabela `gastos`
  --
  ALTER TABLE `gastos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT de tabela `meses`
  --
  ALTER TABLE `meses`
    MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- AUTO_INCREMENT de tabela `movimentacao`
  --
  ALTER TABLE `movimentacao`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  --
  -- Restrições para tabelas despejadas
  --

  --
  -- Restrições para tabelas `movimentacao`
  --
  ALTER TABLE `movimentacao`
    ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `gastos` (`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`id_mes`) REFERENCES `meses` (`id_mes`) ON DELETE CASCADE;
  COMMIT;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

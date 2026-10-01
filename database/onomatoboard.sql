-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/10/2026 às 16:09
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
-- Banco de dados: `onomatoboard`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `sounds`
--

CREATE TABLE `sounds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sounds`
--

INSERT INTO `sounds` (`id`, `user_id`, `name`, `path`) VALUES
(8, 1, 'abertura', 'uploads/audio/6abdef9b1f222.mp3'),
(9, 1, 'batida de pá', 'uploads/audio/6abdefa8e156b.mp3'),
(10, 1, 'sem sinal', 'uploads/audio/6abdefb021dc0.mp3'),
(12, 1, 'Música Dramática Foda', 'uploads/audio/6abdfbac1a44e.mp3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Andrei', 'andreifalmeida08@gmail.com', '$2y$10$aN6b8cz9vd53cwpCU6LPFOT./wvfaBL2ZTEw/neDzG3zxSeZcqnPK'),
(2, 'teste', 'teste@email.com', '$2y$10$wu3kWbRu1E4SOirtgU5kZuIqD0a0oNkmzLngqeoTQLFXEaaUlypOK'),
(3, 'teste', 'teste1@gmail.com', '$2y$10$z5nzL5ndXW9/Ah1PQBXJGOJaVhbgFKmkKr1XzdosQRzVasEukcl2a');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `sounds`
--
ALTER TABLE `sounds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `path` (`path`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `sounds`
--
ALTER TABLE `sounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `sounds`
--
ALTER TABLE `sounds`
  ADD CONSTRAINT `sounds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

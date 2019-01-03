-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Out-2018 às 09:58
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `idc` int(11) NOT NULL,
  `comentario` longtext,
  `nome` varchar(100) DEFAULT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_post` int(11) NOT NULL,
  `resposta` int(1) NOT NULL,
  `lido` int(1) NOT NULL,
  `dono` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gifs`
--

CREATE TABLE `gifs` (
  `id` int(11) NOT NULL,
  `iframe` varchar(250) NOT NULL,
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gifs`
--

INSERT INTO `gifs` (`id`, `iframe`, `fk_user`) VALUES
(2, '<iframe src=\'https://gfycat.com/ifr/CreamyTintedKomododragon\' frameborder=\'0\' scrolling=\'no\' allowfullscreen width=\'640\' height=\'855\'></iframe>', 2),
(4, '<iframe src=\'https://gfycat.com/ifr/IdealForcefulIrishredandwhitesetter\' frameborder=\'0\' scrolling=\'no\' allowfullscreen width=\'640\' height=\'359\'></iframe><p> <a href=\"https://gfycat.com/gifs/detail/IdealForcefulIrishredandwhitesetter\">via Gfycat</a><', 2),
(8, '<iframe src=\'https://gfycat.com/ifr/EmptyYellowAtlanticblackgoby\' frameborder=\'0\' scrolling=\'no\' allowfullscreen width=\'640\' height=\'363\'></iframe>', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `idl` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cidade` varchar(250) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `instagram` varchar(250) DEFAULT NULL,
  `telefone` varchar(250) DEFAULT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `foto` varchar(250) NOT NULL,
  `nivel` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`idl`, `nome`, `email`, `senha`, `cidade`, `facebook`, `instagram`, `telefone`, `bio`, `foto`, `nivel`) VALUES
(1, 'luciano', 'luciano@gmail.com', '123', 'jaboticabal', '', '', '(16)3333-3333', '#daciolo51', 'e74c6cf0150d9e27b1e123b471d06b95.jpg', 0),
(2, 'lucia', 'lucia@gmail.com', '123', '', '', 'https://getbootstrap.com/', '(16)9999999', 'gosto de animais', '7f9cb4e14d35c381bb1d6ba92c5c00f0.jpg', 1),
(3, 'test', 'test@test.com', '123', '', '', '', '', '', '8b6993e3e53da0d19b70904519e14d3b.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE `postagem` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `data` varchar(250) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`id`, `titulo`, `data`, `descricao`, `imagem`, `autor`, `fk_user`) VALUES
(4, 'preciso de remÃ©dio para minha gatinha', '27-06-2018', 'minha gatinha precisa de uma doaÃ§Ã£o de remÃ©dio ', '013b776c922e71e862deaee5f4ca8630.jpg', 'lucia', 2),
(14, 'aaa', '14-10-2018', 'asdas', '6760e7320adfb42949f39481397184ff.jpg', 'luciano', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idc`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_post` (`fk_post`);

--
-- Indexes for table `gifs`
--
ALTER TABLE `gifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idl`);

--
-- Indexes for table `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gifs`
--
ALTER TABLE `gifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postagem`
--
ALTER TABLE `postagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `login` (`idl`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`fk_post`) REFERENCES `postagem` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `gifs`
--
ALTER TABLE `gifs`
  ADD CONSTRAINT `gifs_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `login` (`idl`);

--
-- Limitadores para a tabela `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `login` (`idl`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

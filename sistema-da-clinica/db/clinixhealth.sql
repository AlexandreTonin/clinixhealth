-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/11/2024 às 22:54
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
-- Banco de dados: `clinixhealth`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimento`
--

CREATE TABLE `atendimento` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `data_atendimento` date NOT NULL,
  `descricao` text DEFAULT NULL,
  `diagnostico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atendimento`
--

INSERT INTO `atendimento` (`id`, `id_medico`, `id_paciente`, `data_atendimento`, `descricao`, `diagnostico`) VALUES
(1, 1, 1, '2024-10-10', 'Atendimento para consulta cardiológica', 'Sem alterações significativas'),
(2, 2, 2, '2024-10-12', 'Exame de pele e aconselhamento', 'Sem alterações significativas'),
(3, 3, 3, '2024-10-14', 'Consulta para exame de sangue', 'Nenhuma alteração importante'),
(4, 4, 4, '2024-10-16', 'Raio-X devido a dor na coluna', 'Fratura detectada'),
(5, 5, 5, '2024-10-18', 'Exame de visão e prescrição de lentes de contato', 'Visão normal'),
(6, 6, 6, '2024-10-20', 'Exame de audição', 'Perda auditiva leve'),
(7, 7, 7, '2024-10-22', 'Atendimento psiquiátrico', 'Sem alterações'),
(8, 8, 8, '2024-10-24', 'Ultrassom abdominal', 'Sem alterações'),
(9, 9, 9, '2024-10-26', 'Exame ginecológico', 'Sem alterações'),
(10, 10, 10, '2024-10-28', 'Consulta de urgência', 'Sem problemas detectados'),
(11, 11, 11, '2024-10-30', 'Exame neurológico', 'Sem alterações detectadas'),
(12, 12, 12, '2024-11-01', 'Exame de trato gastrointestinal', 'Possível refluxo'),
(13, 13, 13, '2024-11-03', 'Atendimento endocrinológico', 'Hormônios dentro do normal'),
(14, 14, 14, '2024-11-05', 'Consulta para dor abdominal', 'Com alteração nos exames'),
(15, 15, 15, '2024-11-07', 'Raio-X para dor no joelho', 'Lesão detectada'),
(16, 16, 16, '2024-11-09', 'Consulta de rotina', 'Normal'),
(17, 17, 17, '2024-11-11', 'Exame de cólon', 'Sem alteração importante'),
(18, 18, 18, '2024-11-13', 'Consulta de emergência', 'Sem alterações detectadas'),
(19, 19, 19, '2024-11-15', 'Atendimento clínico geral', 'Exames de sangue indicam alerta'),
(20, 20, 20, '2024-11-17', 'Consulta de urgência', 'Necessário acompanhamento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `diagnostico`
--

CREATE TABLE `diagnostico` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `diagnostico` varchar(255) NOT NULL,
  `data_diagnostico` date NOT NULL,
  `observacoes` text DEFAULT NULL,
  `id_atendimento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `diagnostico`
--

INSERT INTO `diagnostico` (`id`, `id_medico`, `id_paciente`, `diagnostico`, `data_diagnostico`, `observacoes`, `id_atendimento`) VALUES
(1, 1, 1, 'Paciente sem alterações no exame cardiológico', '2024-11-01', 'Nenhuma anormalidade encontrada durante a consulta.', NULL),
(2, 2, 2, 'Paciente com pele saudável, sem alterações detectadas', '2024-11-02', 'Observado boa elasticidade e hidratação da pele.', NULL),
(3, 3, 3, 'Exame de sangue sem alterações, paciente em bom estado de saúde', '2024-11-03', 'Todos os parâmetros laboratoriais estão dentro da normalidade.', NULL),
(4, 4, 4, 'Fratura detectada em coluna, iniciar tratamento ortopédico', '2024-11-04', 'Paciente será encaminhado para ortopedia para iniciar fisioterapia.', 1),
(5, 5, 5, 'Visão corrigida com lentes de contato, sem complicações', '2024-11-05', 'Paciente está seguindo as orientações e utilizando as lentes corretamente.', NULL),
(6, 6, 6, 'Problema auditivo leve, acompanhamento recomendado', '2024-11-06', 'Será realizada audiometria para avaliar mais detalhadamente o quadro.', 2),
(7, 7, 7, 'Paciente sem distúrbios psiquiátricos significativos', '2024-11-07', 'Acompanhamento psicológico sugerido por precaução.', NULL),
(8, 8, 8, 'Ultrassonografia normal, sem alterações visíveis', '2024-11-08', 'Sem sinais de complicações, continuar com os cuidados habituais.', NULL),
(9, 9, 9, 'Exame ginecológico sem alterações, paciente saudável', '2024-11-09', 'Exame preventivo dentro da normalidade.', 3),
(10, 10, 10, 'Sem problemas detectados durante o atendimento de urgência', '2024-11-10', 'Paciente liberado após observação e sem intercorrências.', NULL),
(11, 11, 11, 'Exame neurológico dentro da normalidade', '2024-11-11', 'Nenhuma alteração significativa nos testes neurológicos realizados.', NULL),
(12, 12, 12, 'Resultado de exame gastrointestinal dentro da faixa normal', '2024-11-12', 'Tudo dentro da normalidade, paciente está com boa digestão.', 4),
(13, 13, 13, 'Hormônios normais, paciente saudável', '2024-11-13', 'Pacientes com bons resultados nos exames hormonais.', NULL),
(14, 14, 14, 'Alterações no exame de sangue, mais exames necessários', '2024-11-14', 'Precisa de novos exames para investigar alterações nos leucócitos.', 5),
(15, 15, 15, 'Lesão detectada no joelho, iniciar fisioterapia', '2024-11-15', 'Será iniciado tratamento de fisioterapia para recuperação muscular.', NULL),
(16, 16, 16, 'Raio-X normal, paciente sem lesões detectadas', '2024-11-16', 'A radiografia não apresentou fraturas ou lesões visíveis.', 6),
(17, 17, 17, 'Sem alterações detectadas no exame de cólon', '2024-11-17', 'Exame preventivo de cólon dentro dos parâmetros normais.', NULL),
(18, 18, 18, 'Paciente em bom estado de saúde, sem alterações', '2024-11-18', 'Paciente com saúde estável, sem complicações.', 7),
(19, 19, 19, 'Alerta devido a alterações nos exames de sangue', '2024-11-19', 'Alterações detectadas, exames adicionais serão necessários para esclarecer.', 8),
(20, 20, 20, 'Necessário acompanhamento devido a sintomas não resolvidos', '2024-11-20', 'Sintomas persistentes necessitam de nova consulta em breve.', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `exame`
--

CREATE TABLE `exame` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `tipo_exame` varchar(255) NOT NULL,
  `data_solicitacao` date NOT NULL,
  `resultado` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exame`
--

INSERT INTO `exame` (`id`, `id_medico`, `id_paciente`, `tipo_exame`, `data_solicitacao`, `resultado`) VALUES
(1, 1, 1, 'Eletrocardiograma', '2024-10-10', 'Normal'),
(2, 2, 2, 'Exame de Pele', '2024-10-12', 'Sem alterações'),
(3, 3, 3, 'Exame de Sangue', '2024-10-14', 'Exames normais'),
(4, 4, 4, 'Raio-X de Coluna', '2024-10-16', 'Fratura detectada'),
(5, 5, 5, 'Exame de Visão', '2024-10-18', 'Visão perfeita'),
(6, 6, 6, 'Teste de Audição', '2024-10-20', 'Audição comprometida'),
(7, 7, 7, 'Exame Psiquiátrico', '2024-10-22', 'Sem alterações significativas'),
(8, 8, 8, 'Ultrassonografia', '2024-10-24', 'Normal'),
(9, 9, 9, 'Papanicolau', '2024-10-26', 'Sem alterações'),
(10, 10, 10, 'Tomografia', '2024-10-28', 'Não detectado'),
(11, 11, 11, 'Exame Neurológico', '2024-10-30', 'Sem alterações'),
(12, 12, 12, 'Exame Gástrico', '2024-11-01', 'Sugerido acompanhamento'),
(13, 13, 13, 'Exame de Hormônios', '2024-11-03', 'Dentro do esperado'),
(14, 14, 14, 'Exame de Sangue', '2024-11-05', 'Com resultados elevados'),
(15, 15, 15, 'Ultrassonografia', '2024-11-07', 'Sem alterações'),
(16, 16, 16, 'Raio-X de Joelho', '2024-11-09', 'Lesão detectada'),
(17, 17, 17, 'Exame de Cólon', '2024-11-11', 'Resultados normais'),
(18, 18, 18, 'Eletrocardiograma', '2024-11-13', 'Normal'),
(19, 19, 19, 'Exame de Sangue', '2024-11-15', 'Com resultado suspeito'),
(20, 20, 20, 'Tomografia', '2024-11-17', 'Resultados inconclusivos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `medico`
--

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `crm` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `medico`
--

INSERT INTO `medico` (`id`, `nome`, `especialidade`, `crm`) VALUES
(1, 'Dr. João Silva', 'Cardiologia', '1234567'),
(2, 'Dr. Maria Oliveira', 'Dermatologia', '2345678'),
(3, 'Dr. Pedro Santos', 'Pediatria', '3456789'),
(4, 'Dr. Ana Costa', 'Ortopedia', '4567890'),
(5, 'Dr. Lucas Almeida', 'Oftalmologia', '5678901'),
(6, 'Dr. Clara Ferreira', 'Ginecologia', '6789012'),
(7, 'Dr. Eduardo Lima', 'Psiquiatria', '7890123'),
(8, 'Dr. Bianca Souza', 'Neurologia', '8901234'),
(9, 'Dr. Rafael Gomes', 'Gastroenterologia', '9012345'),
(10, 'Dr. Juliana Alves', 'Endocrinologia', '1234509'),
(11, 'Dr. Felipe Martins', 'Cirurgia Geral', '2345609'),
(12, 'Dr. Carolina Castro', 'Urologia', '3456709'),
(13, 'Dr. Mariana Torres', 'Reumatologia', '4567809'),
(14, 'Dr. Fernando Pinto', 'Oncologia', '5678909'),
(15, 'Dr. Paula Barros', 'Otolaringologia', '6789009'),
(16, 'Dr. Rodrigo Costa', 'Dermatologia', '7890109'),
(17, 'Dr. Camila Mendes', 'Cardiologia', '8901209'),
(18, 'Dr. Leandro Silva', 'Neurologia', '9012309'),
(19, 'Dr. Isabela Moura', 'Pediatria', '1234609'),
(20, 'Dr. Vinicius Almeida', 'Ginecologia', '2345709');

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `paciente`
--

INSERT INTO `paciente` (`id`, `nome`, `cpf`, `telefone`, `data_nascimento`) VALUES
(1, 'Alexandre Tonin Mota Rico', '03176582630', '(55) 99124-2342', '2014-11-01'),
(2, 'Andrei Albrecht', '03678223404', '(55) 99131-9278', '2014-06-03'),
(3, 'Lori', '07040263294', '(55) 992124-5232', '2014-01-25'),
(4, 'João Silva', '12345678901', '(11) 91234-5678', '1985-12-03'),
(5, 'Maria Oliveira', '23456789012', '(21) 92345-6789', '1990-07-25'),
(6, 'Pedro Santos', '34567890123', '(31) 93456-7890', '1978-01-15'),
(7, 'Ana Costa', '45678901234', '(41) 94567-8901', '1995-10-30'),
(8, 'Lucas Almeida', '56789012345', '(51) 95678-9012', '2000-02-18'),
(9, 'Clara Ferreira', '67890123456', '(61) 96789-0123', '1988-09-22'),
(10, 'Eduardo Lima', '78901234567', '(71) 97890-1234', '1983-11-05'),
(11, 'Bianca Souza', '89012345678', '(81) 98901-2345', '1997-04-16'),
(12, 'Rafael Gomes', '90123456789', '(91) 99012-3456', '1992-08-20'),
(13, 'Juliana Alves', '12345098765', '(41) 91234-5678', '1980-02-29'),
(14, 'Felipe Martins', '23456098765', '(51) 92345-6789', '1986-07-13'),
(15, 'Carolina Castro', '34567098765', '(61) 93456-7890', '1999-03-01'),
(16, 'Mariana Torres', '45678098765', '(71) 94567-8901', '1982-10-25'),
(17, 'Fernando Pinto', '56789098765', '(11) 95678-9012', '1995-12-18'),
(18, 'Paula Barros', '67890098765', '(21) 96789-0123', '1990-06-15'),
(19, 'Rodrigo Costa', '78901098765', '(31) 97890-1234', '1987-01-22'),
(20, 'Camila Mendes', '89012098765', '(41) 98901-2345', '1994-05-30'),
(21, 'Leandro Silva', '90123098765', '(51) 99012-3456', '2001-09-12'),
(22, 'Isabela Moura', '12346098765', '(61) 91234-5678', '1985-04-07'),
(23, 'Vinicius Almeida', '23457098765', '(71) 92345-6789', '1998-11-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prescricao`
--

CREATE TABLE `prescricao` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `medicamento` varchar(255) NOT NULL,
  `dosagem` varchar(100) NOT NULL,
  `data_prescricao` date NOT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prescricao`
--

INSERT INTO `prescricao` (`id`, `id_medico`, `id_paciente`, `medicamento`, `dosagem`, `data_prescricao`, `observacoes`) VALUES
(1, 1, 1, 'Atenolol', '50mg', '2024-10-10', 'Tomar uma vez ao dia'),
(2, 2, 2, 'Cremes para Pele', 'Aplicar 2x ao dia', '2024-10-12', 'Iniciar o uso amanhã'),
(3, 3, 3, 'Paracetamol', '500mg', '2024-10-14', 'Tomar em caso de dor'),
(4, 4, 4, 'Ibuprofeno', '400mg', '2024-10-16', 'Para dor intensa'),
(5, 5, 5, 'Lentes de Contato', 'Uma por olho', '2024-10-18', 'Substituir a cada 6 meses'),
(6, 6, 6, 'Aspirina', '100mg', '2024-10-20', 'Tomar com água'),
(7, 7, 7, 'Clonazepam', '2mg', '2024-10-22', 'Antes de dormir'),
(8, 8, 8, 'Omeprazol', '20mg', '2024-10-24', 'Tomar 1 vez ao dia'),
(9, 9, 9, 'Anticoncepcional', '1 comprimido ao dia', '2024-10-26', 'Iniciar amanhã'),
(10, 10, 10, 'Dipirona', '500mg', '2024-10-28', 'Tomar em caso de febre'),
(11, 11, 11, 'Sertralina', '50mg', '2024-10-30', 'Tomar ao acordar'),
(12, 12, 12, 'Ranitidina', '150mg', '2024-11-01', 'Uma vez ao dia'),
(13, 13, 13, 'Levotiroxina', '25mcg', '2024-11-03', 'Tomar pela manhã'),
(14, 14, 14, 'Metformina', '850mg', '2024-11-05', 'Tomar 2x ao dia'),
(15, 15, 15, 'Dipirona', '1g', '2024-11-07', 'Para dor'),
(16, 16, 16, 'Colágeno', '10g', '2024-11-09', 'Diluir em água'),
(17, 17, 17, 'Losartana', '50mg', '2024-11-11', 'Tomar uma vez ao dia'),
(18, 18, 18, 'Alprazolam', '0.25mg', '2024-11-13', 'Para relaxamento'),
(19, 19, 19, 'Metformina', '500mg', '2024-11-15', '2x ao dia'),
(20, 20, 20, 'Antibiótico', '250mg', '2024-11-17', 'Tomar de 8 em 8 horas');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `exame`
--
ALTER TABLE `exame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `crm` (`crm`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `prescricao`
--
ALTER TABLE `prescricao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medico` (`id_medico`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `exame`
--
ALTER TABLE `exame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `prescricao`
--
ALTER TABLE `prescricao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atendimento`
--
ALTER TABLE `atendimento`
  ADD CONSTRAINT `atendimento_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`),
  ADD CONSTRAINT `atendimento_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);

--
-- Restrições para tabelas `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`),
  ADD CONSTRAINT `diagnostico_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);

--
-- Restrições para tabelas `exame`
--
ALTER TABLE `exame`
  ADD CONSTRAINT `exame_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`),
  ADD CONSTRAINT `exame_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);

--
-- Restrições para tabelas `prescricao`
--
ALTER TABLE `prescricao`
  ADD CONSTRAINT `prescricao_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`),
  ADD CONSTRAINT `prescricao_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

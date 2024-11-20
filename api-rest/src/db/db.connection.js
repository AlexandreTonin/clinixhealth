import { DatabaseSync } from "node:sqlite";
export const database = new DatabaseSync("./src/db/database.db");
import chalk from "chalk";

try {
  database.exec(`
-- Tabela de pacientes
CREATE TABLE pacientes (
    id_paciente INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf TEXT UNIQUE NOT NULL,
    email TEXT
);

-- Tabela de médicos
CREATE TABLE medicos (
    id_medico INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    crm TEXT UNIQUE NOT NULL,
    especialidade TEXT NOT NULL,
    email TEXT
);

-- Tabela de histórico médico
CREATE TABLE diagnosticos (
    id_diagnostico INTEGER PRIMARY KEY AUTOINCREMENT,
    id_paciente INTEGER NOT NULL,
    id_medico INTEGER NOT NULL,
    descricao TEXT NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES pacientes (id_paciente)
    FOREIGN KEY (id_medico) REFERENCES medicos (id_medico)
);

-- Tabela de exames
CREATE TABLE exames (
    id_exame INTEGER PRIMARY KEY AUTOINCREMENT,
    id_paciente INTEGER NOT NULL,
    id_medico INTEGER NOT NULL,
    tipo_exame TEXT NOT NULL,
    resultado TEXT NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES pacientes (id_paciente),
    FOREIGN KEY (id_medico) REFERENCES medicos (id_medico)
);

-- Tabela de prescrições
CREATE TABLE prescricoes (
    id_prescricao INTEGER PRIMARY KEY AUTOINCREMENT,
    id_paciente INTEGER NOT NULL,
    id_medico INTEGER NOT NULL,
    descricao TEXT NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES pacientes (id_paciente),
    FOREIGN KEY (id_medico) REFERENCES medicos (id_medico)
);

-- Tabela de autenticação de clientes da API
CREATE TABLE clientes_api (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    clinica TEXT NOT NULL,
    senha TEXT NOT NULL
);

-- Inserindo clientes da API
INSERT INTO clientes_api (clinica, senha) VALUES
('clinixhealth', '$2b$10$fhM6g8asjCAQN0keBd1otun2B17y9WZJjeiG2TiFse0hhdEVLKMqq');

-- Inserindo registros fictícios
INSERT INTO pacientes (nome, data_nascimento, cpf, email) VALUES
('João Silva', '03/12/1985', '12345678901', 'joao.silva@gmail.com'),
('Maria Oliveira', '25/07/1990', '23456789012', 'maria.oliveira@gmail.com'),
('Pedro Santos', '15/01/1978', '34567890123', 'pedro.santos@gmail.com'),
('Ana Costa', '30/10/1995', '45678901234', 'ana.costa@gmail.com'),
('Lucas Almeida', '18/02/2000', '56789012345', 'lucas.almeida@gmail.com'),
('Clara Ferreira', '22/09/1988', '67890123456', 'clara.ferreira@gmail.com'),
('Eduardo Lima', '05/11/1983', '78901234567', 'eduardo.lima@gmail.com'),
('Bianca Souza', '16/04/1997', '89012345678', 'bianca.souza@gmail.com'),
('Rafael Gomes', '20/08/1992', '90123456789', 'rafael.gomes@gmail.com'),
('Juliana Alves', '29/02/1980', '12345098765', 'juliana.alves@gmail.com'),
('Felipe Martins', '13/07/1986', '23456098765', 'felipe.martins@gmail.com'),
('Carolina Castro', '01/03/1999', '34567098765', 'carolina.castro@gmail.com'),
('Mariana Torres', '25/10/1982', '45678098765', 'mariana.torres@gmail.com'),
('Fernando Pinto', '18/12/1995', '56789098765', 'fernando.pinto@gmail.com'),
('Paula Barros', '15/06/1990', '67890098765', 'paula.barros@gmail.com'),
('Rodrigo Costa', '22/01/1987', '78901098765', 'rodrigo.costa@gmail.com'),
('Camila Mendes', '30/05/1994', '89012098765', 'camila.mendes@gmail.com'),
('Leandro Silva', '12/09/2001', '90123098765', 'leandro.silva@gmail.com'),
('Isabela Moura', '07/04/1985', '12346098765', 'isabela.moura@gmail.com'),
('Vinicius Almeida', '03/11/1998', '23457098765', 'vinicius.almeida@gmail.com');

INSERT INTO medicos (nome, crm, especialidade, email) VALUES
('Dr. Carlos Lima', '12345-SP', 'Cardiologia', 'carlos.lima@gmail.com'),
('Dra. Fernanda Sousa', '67890-RJ', 'Dermatologia', 'fernanda.sousa@gmail.com'),
('Dr. Roberto Rocha', '11121-MG', 'Pediatria', 'roberto.rocha@gmail.com'),
('Dr. Marcelo Nunes', '12346-SP', 'Neurologia', 'marcelo.nunes@gmail.com'),
('Dra. Adriana Moreira', '67891-RJ', 'Endocrinologia', 'adriana.moreira@gmail.com'),
('Dr. Fábio Lima', '11122-MG', 'Geriatria', 'fabio.lima@gmail.com'),
('Dr. Thiago Pereira', '22233-PR', 'Ortopedia', 'thiago.pereira@gmail.com'),
('Dra. Larissa Campos', '33344-RS', 'Oftalmologia', 'larissa.campos@gmail.com'),
('Dr. André Silva', '44455-SP', 'Psiquiatria', 'andre.silva@gmail.com'),
('Dra. Juliana Prado', '55566-BA', 'Ginecologia', 'juliana.prado@gmail.com'),
('Dr. Lucas Matos', '66677-PE', 'Urologia', 'lucas.matos@gmail.com'),
('Dr. Rafael Santos', '77788-CE', 'Pediatria', 'rafael.santos@gmail.com'),
('Dra. Fernanda Lacerda', '88899-AM', 'Cardiologia', 'fernanda.lacerda@gmail.com');

INSERT INTO diagnosticos (id_paciente, id_medico, descricao, data) VALUES
(1, 1, 'Hipertensão arterial diagnosticada', '14/05/2020'),
(2, 2, 'Dermatite tratada com sucesso', '10/01/2023'),
(3, 3, 'Pneumonia tratada', '25/11/2021'),
(4, 4, 'Exames regulares, sem condições identificadas', '02/08/2023'),
(6, 6, 'Tratamento de diabetes tipo 2', '12/11/2022'),
(7, 7, 'Cirurgia de apendicite', '18/04/2019'),
(8, 8, 'Asma controlada com inaladores', '21/07/2023'),
(9, 9, 'Hipotireoidismo diagnosticado', '15/08/2020'),
(10, 10, 'Recuperação de fratura no braço esquerdo', '10/02/2021'),
(11, 1, 'Sinusite tratada com sucesso', '06/05/2023'),
(12, 2, 'Colesterol elevado, dieta recomendada', '01/09/2021'),
(13, 3, 'Artrite reumatóide em acompanhamento', '28/03/2022'),
(14, 4, 'Retinopatia diabética diagnosticada', '11/12/2020'),
(15, 5, 'Recuperação de cirurgia bariátrica', '19/02/2023'),
(16, 6, 'Exames regulares, sem condições identificadas', '30/08/2022'),
(17, 7, 'Tratamento de anemia ferropriva', '05/11/2021'),
(18, 8, 'Bronquite aguda', '25/03/2023'),
(19, 9, 'Hérnia inguinal reparada cirurgicamente', '17/01/2022'),
(20, 10, 'Infecção urinária tratada', '10/06/2023');

INSERT INTO exames (id_paciente, id_medico, tipo_exame, resultado, data) VALUES
(1, 1, 'Eletrocardiograma', 'Normal', '10/07/2023'),
(2, 2, 'Biópsia de pele', 'Benigna', '15/06/2023'),
(3, 3, 'Radiografia de tórax', 'Sem alterações', '05/12/2022'),
(4, 5, 'Exame de visão', '20/20', '11/01/2023'),
(5, 6, 'Tomografia cerebral', 'Sem anormalidades', '14/02/2023'),
(6, 7, 'Mamografia', 'Sem sinais de malignidade', '18/03/2023'),
(7, 8, 'Ultrassom abdominal', 'Cálculo renal identificado', '23/04/2023'),
(8, 9, 'Raio-X de tórax', 'Sem alterações', '19/05/2023'),
(9, 10, 'Holter 24h', 'Arritmia identificada', '24/06/2023'),
(10, 1, 'Eletrocardiograma', 'Normal', '15/07/2023'),
(11, 2, 'Exame dermatológico', 'Psoríase leve', '12/08/2023'),
(12, 3, 'Papanicolau', 'Normal', '18/09/2023'),
(13, 4, 'Teste de esforço', 'Capacidade aeróbica reduzida', '09/10/2023'),
(14, 5, 'Audiometria', 'Deficiência auditiva moderada', '01/11/2023');

INSERT INTO prescricoes (id_paciente, id_medico, descricao, data) VALUES
(1, 1, 'Captopril 25mg 2x ao dia', '14/08/2023'),
(2, 2, 'Cremes tópicos para dermatite', '16/06/2023'),
(3, 3, 'Amoxicilina 500mg 3x ao dia', '06/12/2022'),
(6, 6, 'Metformina 850mg 2x ao dia', '12/11/2022'),
(7, 7, 'Cefalexina 500mg 4x ao dia', '18/04/2019'),
(8, 8, 'Salbutamol spray 2x ao dia', '21/07/2023'),
(9, 9, 'Levotiroxina sódica 50mcg 1x ao dia', '15/08/2020'),
(10, 10, 'Analgésico e repouso', '10/02/2021'),
(11, 1, 'Sinutab 3x ao dia', '06/05/2023'),
(12, 2, 'Omega 3 2x ao dia', '01/09/2021'),
(13, 3, 'Metotrexato 10mg 1x por semana', '28/03/2022'),
(14, 4, 'Insulina regular 3x ao dia', '11/12/2020'),
(15, 5, 'Pantoprazol 40mg 1x ao dia', '19/02/2023'),
(16, 6, 'Vitamina D 10.000UI semanalmente', '30/08/2022'),
(17, 7, 'Ferro quelado 3x ao dia', '05/11/2021'),
(18, 8, 'Corticóide inalatório 2x ao dia', '25/03/2023'),
(19, 9, 'Ibuprofeno 400mg 3x ao dia', '17/01/2022'),
(20, 10, 'Nitrofurantoína 100mg 2x ao dia', '10/06/2023');
    `);

  console.log(chalk.green("Banco de dados criado com sucesso\n"));
} catch (error) {
  if (error.message.includes("already exists")) {
    console.log(
      chalk.green(
        "\nTabelas já existem no banco de dados. Nenhuma ação necessária\n"
      )
    );
  } else {
    console.log(error.message);
  }
}

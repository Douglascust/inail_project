DROP DATABASE SeuSistema;
CREATE DATABASE SeuSistema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE SeuSistema;

-- Tabela: Generos
CREATE TABLE generos (
    idGenero INT NOT NULL AUTO_INCREMENT,
    genero VARCHAR(128),
    PRIMARY KEY (idGenero)
);


-- Tabela: Escolaridades
CREATE TABLE escolaridades (
    idEscolaridade INT NOT NULL AUTO_INCREMENT,
    escolaridade VARCHAR(128),
    PRIMARY KEY (idEscolaridade)
);

-- Tabela: EstadosCivis
CREATE TABLE estadosCivis (
    idEstadoCivil INT NOT NULL AUTO_INCREMENT,
    estadoCivil VARCHAR(128),
    PRIMARY KEY (idEstadoCivil)
);

CREATE TABLE nivelUsuarios (
  idNivelUsuario int(11) NOT NULL AUTO_INCREMENT,
  nivel varchar(20) DEFAULT NULL COMMENT '{''Usuario '', ''Colaborador'', ''Pesquisador'',  ''Administrador''}',
  PRIMARY KEY (idNivelUsuario)
);

-- Tabela: UnidadesFederativas
CREATE TABLE unidadesFederativas (
    idUF INT NOT NULL AUTO_INCREMENT,
    sigla VARCHAR(2) UNIQUE,
    uf VARCHAR(64),
    PRIMARY KEY (idUF)
);


-- Tabela: Usuarios
CREATE TABLE usuarios (
    idUsuario INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) COMMENT 'Nome do Usuário',
    cpf VARCHAR(11) COMMENT 'CPF',
    dtNasc VARCHAR(10) COMMENT 'Data de Nascimento',
    idGenero INT COMMENT 'ID do Gênero',
    idEscolaridade INT COMMENT 'ID da Escolaridade',
    idEstadoCivil INT COMMENT 'ID do Estado Civil',
    qtdFilhos INT COMMENT 'Quantidade de Filhos',
    siglaUF VARCHAR(2) COMMENT 'Sigla da Unidade Federativa',
    telefone VARCHAR(15) COMMENT 'Número de Telefone',
    email VARCHAR(128) COMMENT 'Endereço de Email',
    senha VARCHAR(128) COMMENT 'Senha',
    aceitaContrato INT DEFAULT 0 COMMENT 'Aceitação do Contrato (0: Não, 1: Sim)',
    dthrContrato VARCHAR(10) COMMENT 'Data e Hora da Aceitação do Contrato',
    activeCode VARCHAR(128) COMMENT 'Código de Ativação da Conta',
    ativo INT DEFAULT 0 COMMENT 'Status de Ativação (0: Não, 1: Sim)',
    idNivelUsuario INT DEFAULT 0 COMMENT 'ID do Nível',
    fraseRecupera VARCHAR(128) DEFAULT '' COMMENT 'Frase de Recuperação de Senha',
    PRIMARY KEY (idUsuario)
);

ALTER TABLE usuarios ADD FOREIGN KEY (idGenero) REFERENCES generos (idGenero);
ALTER TABLE usuarios ADD FOREIGN KEY (idEstadoCivil) REFERENCES estadosCivis (idEstadoCivil);
ALTER TABLE usuarios ADD FOREIGN KEY (idNivelUsuario) REFERENCES nivelUsuarios (idNivelUsuario);
ALTER TABLE usuarios ADD FOREIGN KEY (idEscolaridade) REFERENCES escolaridades ( idEscolaridade );
ALTER TABLE usuarios ADD FOREIGN KEY (siglaUF) REFERENCES unidadesFederativas (sigla);

INSERT INTO kukafit_project.nivelUsuarios (nivel) values
    ('usuário'),
    ('colaborador'),
    ('pesquisador'),
    ('administrador');

INSERT INTO escolaridades (escolaridade) VALUES
    ('Não Alfabetizado'),
    ('Fundamental Incompleto'),
    ('Fundamental Completo'),
    ('Ensino Médio Incompleto'),
    ('Ensino Médio Completo'),
    ('Ensino Superior Incompleto'),
    ('Ensino Superior Completo'),
    ('Especialização'),
    ('Mestrado'),
    ('Doutorado'),
    ('Pós-Doutorado Completo');

INSERT INTO estadosCivis (estadoCivil) VALUES
    ('Não especificado'),
    ('Solteiro(a)'),
    ('Casado(a)'),
    ('Divorciado(a)'),
    ('Viúvo(a)'),
    ('Separado(a)'),
    ('União estável'),
    ('Prefiro não dizer');

INSERT INTO unidadesFederativas (sigla, uf) VALUES
    ('00', 'Não especificado'),
    ('AC', 'Acre'),
    ('AL', 'Alagoas'),
    ('AP', 'Amapá'),
    ('AM', 'Amazonas'),
    ('BA', 'Bahia'),
    ('CE', 'Ceará'),
    ('DF', 'Distrito Federal'),
    ('ES', 'Espírito Santo'),
    ('GO', 'Goiás'),
    ('MA', 'Maranhão'),
    ('MT', 'Mato Grosso'),
    ('MS', 'Mato Grosso do Sul'),
    ('MG', 'Minas Gerais'),
    ('PA', 'Pará'),
    ('PB', 'Paraíba'),
    ('PR', 'Paraná'),
    ('PE', 'Pernambuco'),
    ('PI', 'Piauí'),
    ('RJ', 'Rio de Janeiro'),
    ('RN', 'Rio Grande do Norte'),
    ('RS', 'Rio Grande do Sul'),
    ('RO', 'Rondônia'),
    ('RR', 'Roraima'),
    ('SC', 'Santa Catarina'),
    ('SP', 'São Paulo'),
    ('SE', 'Sergipe'),
    ('TO', 'Tocantins');
    
 INSERT INTO generos (genero) VALUES
    ('Masculino'),
    ('Feminino'),
    ('Outro');


CREATE TABLE `aceiteTermos` (
  idAceiteTermos  int(11) NOT NULL AUTO_INCREMENT,
  email 		  varchar(128) DEFAULT NULL,
  datahora 		  varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idAceiteTermos`)
);

CREATE TABLE `autenticacaoHist` (
  `idAutenticacaoHist` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `datahora` varchar(25) DEFAULT NULL,
  `foto` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`idAutenticacaoHist`)
);



CREATE TABLE uploadedCtrl (
	idUploadedCtrl  int(11) NOT NULL AUTO_INCREMENT,
	idUsuario int,	
	filePath varchar(2048),
	accessCtrl int,
	shareMails varchar(2048),
	PRIMARY KEY (idUploadedCtrl),
    FOREIGN KEY (idUsuario) REFERENCES usuarios (idUsuario)
);




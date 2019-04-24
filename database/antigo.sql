CREATE TABLE agendalocal.niveis_acesso
(
	id_nivelacesso SERIAL, PRIMARY KEY(id_nivelacesso),
	nome VARCHAR(255) NOT NULL
);

INSERT INTO agendalocal.niveis_acesso(nome)
VALUES('Administrador'),
('Financeiro'),
('Marketing');

CREATE TABLE agendalocal.usuarios
(
	/*--SERIAL PRIMARY KEY = NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)--*/
	id_usuario SERIAL, PRIMARY KEY(id_usuario),
	id_nivelacesso INTEGER NOT NULL, FOREIGN KEY(id_nivelacesso) REFERENCES agendalocal.niveis_acesso(id_nivelacesso),
	pnome VARCHAR(255) NOT NULL,
	snome VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL,
	senha VARCHAR(255) NOT NULL

);
INSERT INTO agendalocal.usuarios(id_nivelacesso, pnome, snome, email, login, senha)
VALUES(1, 'João Lucas', 'Benvenho', 'joao.admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE agendalocal.estados
(
	id_estado SERIAL, PRIMARY KEY(id_estado),
	nome VARCHAR(255) NOT NULL,
	sigla VARCHAR(2) NOT NULL
);
INSERT INTO agendalocal.estados(nome, sigla)
VALUES('Acre', 'AC'),
('Alagoas', 'AL'),
('Amapá', 'AP'),
('Amazonas', 'AM'),
('Bahia', 'BA'),
('Ceará', 'CE'),
('Distrito Federal', 'DF'),
('Espírito Santo', 'ES'),
('Goiás', 'GO'),
('Maranhão', 'MA'),
('Mato Grosso', 'MT'),
('Mato Grosso do Sul', 'MS'),
('Minas Gerais', 'MG'),
('Pará', 'PA'),
('Paraíba', 'PB'),
('Paraná', 'PR'),
('Pernambuco', 'PE'),
('Piauí', 'PI'),
('Rio de Janeiro', 'RJ'),
('Rio Grande do Norte', 'RN'),
('Rio Grande do Sul', 'RS'),
('Rondônia', 'RO'),
('Roraima', 'RR'),
('Santa Catarina', 'SC'),
('São Paulo', 'SP'),
('Sergipe', 'SE'),
('Tocantins', 'TO');

CREATE TABLE agendalocal.cidades
(
	id_cidade SERIAL, PRIMARY KEY(id_cidade),
	id_estado INTEGER NOT NULL, FOREIGN KEY(id_estado) REFERENCES agendalocal.estados(id_estado),
	nome VARCHAR(255) NOT NULL

);
-- INSERT INTO agendalocal.cidades(id_estado,nome)
-- VALUES(16, 'Arapongas'),
-- (16, 'Cambé'),
-- (16, 'Londrina'),
-- (16, 'Cascavél'),
-- (16, 'Umuarama'),
-- (16, 'Palotina'),
-- (16, 'Curitiba'),
-- (24, 'Florianópolis'),
-- (24, 'Blumenau'),
-- (24, 'Chapecó'),
-- (24, 'São José'),
-- (24, 'Araranguá'),
-- (24, 'Criciúma'),
-- (24, 'Joinville'),
-- (24, 'Mafra'),
-- (21, 'Porto Alegre'),
-- (21, 'Pelotas'),
-- (21, 'Canoas'),
-- (21, 'Caxias do Sul'),
-- (21, 'São Leopoldo'),
-- (21, 'Uruguaiana'),
-- (21, 'Passo Fundo'),
-- (21, 'Novo Hamburgo'),
-- (21, 'Alvorada'),
-- (21, 'Farroupilha');

CREATE TABLE agendalocal.tipos_registro
(
	id_tiporegistro SERIAL, PRIMARY KEY(id_tiporegistro),
	nome VARCHAR(255) NOT NULL
);

INSERT INTO agendalocal.tipos_registro(nome)
VALUES('Residencial'),
('Comercial');

CREATE TABLE agendalocal.clientes
(
	id_cliente SERIAL, PRIMARY KEY(id_cliente),
	id_cidade INTEGER NOT NULL, FOREIGN KEY(id_cidade) REFERENCES agendalocal.cidades(id_cidade),
	id_tiporegistro INTEGER NOT NULL, FOREIGN KEY(id_tiporegistro) REFERENCES agendalocal.tipos_registro(id_tiporegistro),
	nome VARCHAR(255) NOT NULL,
	telefone VARCHAR(255) NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	numero VARCHAR(255) NOT NULL,
	atividade VARCHAR(255),
	is_cliente INTEGER NOT NULL,
	logomarca VARCHAR(512)
);

CREATE TABLE agendalocal.anuncios
(
	id_anuncio SERIAL, PRIMARY KEY(id_anuncio),
	id_cidade INTEGER NOT NULL, FOREIGN KEY(id_cidade) REFERENCES agendalocal.cidades(id_cidade),
	nome VARCHAR(255) NOT NULL,
	tipo VARCHAR(255) NOT NULL,
	expira_em DATE NOT NULL
);

--TRUNCATE agendalocal.cidades RESTART IDENTITY CASCADE; --

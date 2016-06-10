CREATE TABLE usuario (
	email			VARCHAR(100) NOT NULL,
	senha			CHAR(64) COMMENT 'Senha criptografada em 64 bytes',
foto			VARCHAR(255) COMMENT 'Caminho do arquivo da foto',
	nome			VARCHAR(50),
	genero			CHAR(1),
	nascimento		DATE,
	celular			VARCHAR(11),
	PRIMARY KEY 		(email)
);

CREATE TABLE preferencias (
	id			INT NOT NULL  AUTO_INCREMENT,
	descricao		VARCHAR(50),
	PRIMARY KEY		(id)
);

CREATE TABLE usuario_preferencias(
	email			VARCHAR(100),
	id			INT,
	PRIMARY KEY		(email, id),
	FOREIGN KEY		(email)
REFERENCES usuario (email) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY		(id)
REFERENCES preferencias (id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE grupo (
	id			INT NOT NULL  AUTO_INCREMENT,
	nome			VARCHAR(50) NOT NULL,
	categoria		VARCHAR(50),
	email_criador		VARCHAR(100)  NOT NULL,
	PRIMARY KEY		(id),
	FOREIGN KEY		(email_criador)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE carona (
	id			INT NOT NULL  AUTO_INCREMENT,
	email			VARCHAR(100) NOT NULL,
	id_grupo			INT,
	origem			VARCHAR(50) NOT NULL,
	destino			VARCHAR(50) NOT NULL,
	descricao		TEXT,
	data			DATE NOT NULL,
	hora			TIME NOT NULL,
	qtd_passageiros		INT NOT NULL,
	bagagem			CHAR(1) COMMENT "Pequena, Média ou Grande",
	preco			FLOAT(5,2),
	PRIMARY KEY		(id, email),
	FOREIGN KEY		(email)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY		(id_grupo)
REFERENCES	grupo (id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE info_modelo (
	modelo			VARCHAR(50),
	marca			VARCHAR(50),
	lugares			TINYINT  NOT NULL,
	PRIMARY KEY		(modelo)
);

CREATE TABLE veiculo (
	id			INT NOT NULL  AUTO_INCREMENT,
	modelo			VARCHAR(50) NOT NULL,
	conforto			VARCHAR(50),
	categoria		VARCHAR(50),
	cor			VARCHAR(20),
	email_dono		VARCHAR(100)  NOT NULL,
	PRIMARY KEY		(id),
	FOREIGN KEY		(email_dono)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY		(modelo)
REFERENCES info_modelo(modelo)  ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE mensagem (
id			INT NOT NULL  AUTO_INCREMENT,
	email_destinatario	VARCHAR(100)  NOT NULL,
	email_remetente		VARCHAR(100)  NOT NULL,
	conteudo		TEXT,
	status			INT(1),
	data			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY		(id),
	FOREIGN KEY		(email_destinatario)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE,
   	FOREIGN KEY		(email_remetente)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE reserva (
	email			VARCHAR(100) NOT NULL,
	id_carona		INT  NOT NULL,
	PRIMARY KEY		(email, id_carona),
	FOREIGN KEY		(email)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (id_carona)
REFERENCES carona (id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE amizade (
email_amigo1		VARCHAR(100) NOT NULL,
	email_amigo2		VARCHAR(100) NOT NULL,
	data_inicio		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY		(email_amigo1, email_amigo2),
	FOREIGN KEY		(email_amigo1)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY		(email_amigo2)
REFERENCES usuario (email)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE avalia (
	id			INT NOT NULL  AUTO_INCREMENT,
	email_avaliador		VARCHAR(100) NOT NULL,
	email_avaliado		VARCHAR(100) NOT NULL,
	data			DATE,
	nota			INT,
	conteudo		TEXT,
	PRIMARY KEY		(id),
	FOREIGN KEY		(email_avaliador)
REFERENCES usuario (email) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY		(email_avaliado)
REFERENCES usuario (email) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE participa (
	email			VARCHAR(100),
	id_grupo			INT NOT NULL,
	PRIMARY KEY		(email, id_grupo),
	FOREIGN KEY		(email)
REFERENCES usuario (email) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY		(id_grupo)
REFERENCES grupo (id) ON DELETE CASCADE ON UPDATE CASCADE
);

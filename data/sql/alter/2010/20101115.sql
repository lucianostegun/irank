DROP TABLE IF EXISTS auxiliar_text;
DROP SEQUENCE IF EXISTS auxiliar_text_seq;
DROP TABLE IF EXISTS file;
DROP SEQUENCE IF EXISTS file_seq;

DROP TABLE IF EXISTS config;

CREATE TABLE config (
	config_name VARCHAR(50) NOT NULL PRIMARY KEY,
    description VARCHAR(150),
    config_value VARCHAR(100) DEFAULT NULL,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

DELETE FROM config WHERE config_name IN('smtpHostname', 'smtpUsername', 'smtpPassword', 'emailSenderName', 'encodeEmailToUTF8', 'decodeEmailFromUTF8');

INSERT INTO config VALUES('smtpHostname', 'Servidor SMTP', 'smtp.stegun.com', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO config VALUES('smtpUsername', 'Usuário', 'noreply@stegun.com', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO config VALUES('smtpPassword', 'Senha', 'noreply2010', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO config VALUES('emailSenderName', 'Remetente padrão', 'iRanking', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO config VALUES('encodeEmailToUTF8', 'Codificar e-mail para UTF-8', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO config VALUES('decodeEmailFromUTF8', 'Decodificar e-mail de UTF-8', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE SEQUENCE file_seq;
CREATE TABLE file (
    id INTEGER NOT NULL DEFAULT nextval('file_seq'::regclass) PRIMARY KEY,
    file_name VARCHAR(200),
    file_path VARCHAR(200),
    file_size INTEGER,
    description	VARCHAR(250),
    is_image BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE SEQUENCE auxiliar_text_seq;
CREATE TABLE auxiliar_text ( 
	id INTEGER NOT NULL DEFAULT nextval('auxiliar_text_seq'::regclass) PRIMARY KEY,
	description VARCHAR(150),
	file_id INTEGER,
    tag_name VARCHAR(30),
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT auxiliar_text_FK_1 FOREIGN KEY (file_id) REFERENCES file (id)
);

ALTER TABLE event_member ADD COLUMN email_sent BOOLEAN DEFAULT FALSE;
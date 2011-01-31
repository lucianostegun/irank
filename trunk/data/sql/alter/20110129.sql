CREATE TABLE faq_i18n (
    faq_id INTEGER NOT NULL,
    culture CHAR(5),
    question_i18n VARCHAR(200),
    answer_i18n TEXT,
    PRIMARY KEY(faq_id, culture),
    CONSTRAINT faq_i18n_FK_1 FOREIGN KEY (faq_id) REFERENCES faq (id)
);

INSERT INTO faq_i18n
    (SELECT id, 'pt_BR', question, answer FROM faq);

INSERT INTO faq_i18n
    (SELECT id, 'en_US', question, answer FROM faq);






CREATE SEQUENCE user_admin_seq;
CREATE TABLE user_admin ( 
	id              	INTEGER NOT NULL DEFAULT nextval('user_admin_seq'::regclass) PRIMARY KEY,
	people_id       	INTEGER NULL,
	username        	VARCHAR(20) NULL DEFAULT NULL,
	password        	VARCHAR(32) NULL DEFAULT NULL,
	last_access_date	TIMESTAMP NULL,
	master          	BOOLEAN NULL DEFAULT false,
	active          	BOOLEAN NULL DEFAULT true,
	enabled         	BOOLEAN NULL DEFAULT false,
	visible         	BOOLEAN NULL DEFAULT true,
	locked          	BOOLEAN NULL DEFAULT false,
	deleted         	BOOLEAN NULL DEFAULT false,
	created_at      	TIMESTAMP NULL,
	updated_at      	TIMESTAMP NULL,
    CONSTRAINT user_admin_FK_1 FOREIGN KEY (people_id) REFERENCES people (id)
);

INSERT INTO user_admin VALUES(nextval('user_admin_seq'), (SELECT id FROM people WHERE email_address='lucianostegun@gmail.com'), 'lucianostegun', md5('sherK33p0utme'), null, true, true, true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


CREATE TABLE module ( 
	id                 	INTEGER NOT NULL PRIMARY KEY,
	module_id          	INTEGER NULL,
	is_menu            	BOOLEAN NULL DEFAULT true,
	description        	VARCHAR(30) NULL,
	toolbar_description	VARCHAR(30) NULL,
	image_menu         	VARCHAR(20) NULL,
	image_module       	VARCHAR(20) NULL,
	execute_module     	VARCHAR(20) NULL,
	execute_action     	VARCHAR(15) NULL,
	enabled            	BOOLEAN NULL DEFAULT true,
	master_only        	BOOLEAN NULL DEFAULT false,
	has_child          	BOOLEAN NULL DEFAULT false,
	order_seq          	INTEGER NULL,
	created_at         	TIMESTAMP NULL,
	updated_at         	TIMESTAMP NULL,
    CONSTRAINT module_FK_1 FOREIGN KEY (module_id) REFERENCES module (id)
);

CREATE SEQUENCE toolbar_seq;
CREATE TABLE toolbar ( 
	id            	INTEGER NOT NULL DEFAULT nextval('toolbar_seq'::regclass) PRIMARY KEY,
	module_id     	INTEGER NULL,
	description   	VARCHAR(20) NULL,
	tag_name      	VARCHAR(20) NULL,
	tag_id        	VARCHAR(20) NULL,
	image         	VARCHAR(20) NULL,
	action_name   	VARCHAR(20) NULL,
	execute_module	VARCHAR(20) NULL,
	execute_action	VARCHAR(255) NULL,
	is_javascript 	BOOLEAN NULL DEFAULT false,
	order_seq     	INTEGER NULL,
	enabled       	BOOLEAN NULL DEFAULT true,
	start_disabled	BOOLEAN NULL DEFAULT false,
	visible_action	VARCHAR(30) NULL,
	created_at    	TIMESTAMP NULL,
	updated_at    	TIMESTAMP NULL,
	start_hide    	BOOLEAN NULL,
    CONSTRAINT toolbar_FK_1 FOREIGN KEY (module_id) REFERENCES module(id)
);

DELETE FROM module;
INSERT INTO module VALUES(1, null, true, 'Home', 'Home', 'home.png', 'home.png', 'home', 'index', true, false, false, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO module VALUES(2, null, true, 'FAQ', 'FAQ', 'faq.png', 'faq.png', 'faq', 'index', true, false, false, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Novo', 'new', 'new', 'new.png', null, 'faq', 'doNew( ''faq'' )', true, 1, true, false, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Editar', 'edit', 'edit', 'edit.png', null, 'faq', 'doEdit( ''faq'' )', true, 2, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Visualizar', 'view', 'view', 'view.png', null, 'faq', 'doView( ''faq'' )', true, 3, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Salvar', 'save', 'save', 'save.png', null, 'faq', 'doSave( ''main'' )', true, 4, true, true, 'edit,create,view', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Excluir', 'delete', 'delete', 'delete.png', null, 'faq', 'doDelete( ''faq'' )', true, 5, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 2, 'Listagem', 'index', 'index', 'list.png', null, 'faq', 'showList( ''faq'', false )', true, 6, true, true, 'edit,create,view', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE faq ADD COLUMN enabled BOOLEAN DEFAULT FALSE;
ALTER TABLE faq ADD COLUMN deleted BOOLEAN DEFAULT FALSE;
ALTER TABLE faq ADD COLUMN locked BOOLEAN DEFAULT FALSE;
UPDATE faq SET enabled = TRUE WHERE visible;

ALTER TABLE faq DROP COLUMN answer;
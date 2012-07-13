CREATE SEQUENCE partner_seq;
CREATE TABLE partner (
    id INTEGER NOT NULL DEFAULT nextval('partner_seq'::regclass) PRIMARY KEY,
    partner_name VARCHAR(50),
    external_url VARCHAR(200),
    file_id INTEGER,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT partner_FK_1 FOREIGN KEY (file_id) REFERENCES file (id)
);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('nerdsubs.jpg', 'images/partners/nerdsubs.jpg', 'Banner de parceria com o site Nerds', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO partner(partner_name, external_url, file_id, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('N.E.R.D.S.', 'http://www.nerdsubs.com', (SELECT MAX(id) FROM file WHERE file_name = 'nerdsubs.jpg'), true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO module VALUES(3, null, true, 'Parceiros', 'Parceiros', 'partner.png', 'partner.png', 'partner', 'index', true, false, false, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Novo', 'new', 'new', 'new.png', null, 'partner', 'doNew( ''partner'' )', true, 1, true, false, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Editar', 'edit', 'edit', 'edit.png', null, 'partner', 'doEdit( ''partner'' )', true, 2, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Visualizar', 'view', 'view', 'view.png', null, 'partner', 'doView( ''partner'' )', true, 3, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Salvar', 'save', 'save', 'save.png', null, 'partner', 'doSave( ''main'' )', true, 4, true, true, 'edit,create,view', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Excluir', 'delete', 'delete', 'delete.png', null, 'partner', 'doDelete( ''partner'' )', true, 5, true, true, null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO toolbar VALUES (nextval('toolbar_seq'), 3, 'Listagem', 'index', 'index', 'list.png', null, 'partner', 'showList( ''partner'', false )', true, 6, true, true, 'edit,create,view', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
DELETE FROM auxiliar_text;
DELETE FROM file;

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at) 
    VALUES('signWelcome.htm', 'templates/signWelcome.htm', 'Template do e-mail de boas vindas', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template do e-mail de boas vindas', (SELECT MAX(id) FROM file), 'signWelcome', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('emailTemplate.htm', 'templates/emailTemplate.htm', 'Template padr�o de e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template padr�o de e-mail', (SELECT MAX(id) FROM file), 'emailTemplate', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('rankingMemberAdd.htm', 'templates/rankingMemberAdd.htm', 'Template de e-mail de notifica��o inclus�o em ranking', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de e-mail de notifica��o inclus�o em ranking', (SELECT MAX(id) FROM file), 'rankingMemberAdd', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventCreateNotify.htm', 'templates/eventCreateNotify.htm', 'Template de notifica��o de cria��o de evento por e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de notifica��o de cria��o de evento por e-mail', (SELECT MAX(id) FROM file), 'eventCreateNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventChangeNotify.htm', 'templates/eventChangeNotify.htm', 'Template de notifica��o de altera��o de evento por e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de notifica��o de altera��o de evento por e-mail', (SELECT MAX(id) FROM file), 'eventChangeNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventResult.htm', 'templates/eventResult.htm', 'Template de notifica��o de resultado de evento por e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de notifica��o de resultado de evento por e-mail', (SELECT MAX(id) FROM file), 'eventResult', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
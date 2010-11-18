DELETE FROM auxiliar_text;
DELETE FROM file;

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('emailTemplate.htm', 'templates/emailTemplate.htm', 'Template padrão de e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template padrão de e-mail', (SELECT MAX(id) FROM file), 'emailTemplate', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at) 
    VALUES('signWelcome.htm', 'templates/signWelcome.htm', 'E-mail de boas vindas', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de boas vindas', (SELECT MAX(id) FROM file), 'signWelcome', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('rankingMemberAdd.htm', 'templates/rankingMemberAdd.htm', 'E-mail de notificação inclusão em ranking', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notificação inclusão em ranking', (SELECT MAX(id) FROM file), 'rankingMemberAdd', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventCreateNotify.htm', 'templates/eventCreateNotify.htm', 'E-mail de notificação de criação de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notificação de criação de evento', (SELECT MAX(id) FROM file), 'eventCreateNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventChangeNotify.htm', 'templates/eventChangeNotify.htm', 'E-mail de notificação de alteração de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notificação de alteração de evento', (SELECT MAX(id) FROM file), 'eventChangeNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventResult.htm', 'templates/eventResult.htm', 'E-mail de notificação de resultado de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notificação de resultado de evento', (SELECT MAX(id) FROM file), 'eventResult', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventDeleteNotify.htm', 'templates/eventDeleteNotify.htm', 'E-mail de notificação de exclusão de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notificação de exclusão de evento', (SELECT MAX(id) FROM file), 'eventDeleteNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('newUserInvite.htm', 'templates/newUserInvite.htm', 'Convite de cadastro para novos usuários', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Convite de cadastro para novos usuários', (SELECT MAX(id) FROM file), 'newUserInvite', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('confirmPresenceNotify.htm', 'templates/confirmPresenceNotify.htm', 'Notificação de confirmação de presença', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Notificação de confirmação de presença', (SELECT MAX(id) FROM file), 'confirmPresenceNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventReminder.htm', 'templates/eventReminder.htm', 'Lembrete de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Lembrete de evento', (SELECT MAX(id) FROM file), 'eventReminder', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
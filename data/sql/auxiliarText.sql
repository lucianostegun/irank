DELETE FROM auxiliar_text;
DELETE FROM file;

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('emailTemplate.htm', 'templates/emailTemplate.htm', 'Template padr�o de e-mail', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template padr�o de e-mail', (SELECT MAX(id) FROM file), 'emailTemplate', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('emailTemplateAdmin.htm', 'templates/emailTemplateAdmin.htm', 'Template de e-mail para administra��o', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Template de e-mail para administra��o', (SELECT MAX(id) FROM file), 'emailTemplateAdmin', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at) 
    VALUES('signWelcome.htm', 'templates/signWelcome.htm', 'E-mail de boas vindas', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de boas vindas', (SELECT MAX(id) FROM file), 'signWelcome', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('rankingPlayerAdd.htm', 'templates/rankingPlayerAdd.htm', 'E-mail de notifica��o inclus�o em ranking', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notifica��o inclus�o em ranking', (SELECT MAX(id) FROM file), 'rankingPlayerAdd', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventCreateNotify.htm', 'templates/eventCreateNotify.htm', 'E-mail de notifica��o de cria��o de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notifica��o de cria��o de evento', (SELECT MAX(id) FROM file), 'eventCreateNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventChangeNotify.htm', 'templates/eventChangeNotify.htm', 'E-mail de notifica��o de altera��o de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notifica��o de altera��o de evento', (SELECT MAX(id) FROM file), 'eventChangeNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventResult.htm', 'templates/eventResult.htm', 'E-mail de notifica��o de resultado de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notifica��o de resultado de evento', (SELECT MAX(id) FROM file), 'eventResult', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventDeleteNotify.htm', 'templates/eventDeleteNotify.htm', 'E-mail de notifica��o de exclus�o de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de notifica��o de exclus�o de evento', (SELECT MAX(id) FROM file), 'eventDeleteNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('newUserInvite.htm', 'templates/newUserInvite.htm', 'Convite de cadastro para novos usu�rios', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Convite de cadastro para novos usu�rios', (SELECT MAX(id) FROM file), 'newUserInvite', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('confirmPresenceNotify.htm', 'templates/confirmPresenceNotify.htm', 'Notifica��o de confirma��o de presen�a', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Notifica��o de confirma��o de presen�a', (SELECT MAX(id) FROM file), 'confirmPresenceNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventReminder.htm', 'templates/eventReminder.htm', 'Lembrete de evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Lembrete de evento', (SELECT MAX(id) FROM file), 'eventReminder', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('contactMessage.htm', 'templates/contactMessage.htm', 'E-mail para notifica��o de contato', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail para notifica��o de contato', (SELECT MAX(id) FROM file), 'contactMessage', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('feedbackMessage.htm', 'templates/feedbackMessage.htm', 'E-mail de contato para feedback', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de contato para feedback', (SELECT MAX(id) FROM file), 'feedbackMessage', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('friendInvite.htm', 'templates/friendInvite.htm', 'Convite para ingressar ao site', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Convite para ingressar ao site', (SELECT MAX(id) FROM file), 'friendInvite', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('faqQuestion.htm', 'templates/faqQuestion.htm', 'Nova d�vida do FAQ', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Nova d�vida do FAQ', (SELECT MAX(id) FROM file), 'faqQuestion', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventCommentNotify.htm', 'templates/eventCommentNotify.htm', 'Coment�rios no evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Coment�rios no evento', (SELECT MAX(id) FROM file), 'eventCommentNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('eventPhotoCommentNotify.htm', 'templates/eventPhotoCommentNotify.htm', 'Coment�rios nas fotos do evento', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('Coment�rios nas fotos do evento', (SELECT MAX(id) FROM file), 'eventPhotoCommentNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at)
    VALUES('passwordRecovery.htm', 'templates/passwordRecovery.htm', 'E-mail de recupera��o de senha', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de recupera��o de senha', (SELECT MAX(id) FROM file), 'passwordRecovery', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
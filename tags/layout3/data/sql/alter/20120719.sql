INSERT INTO file(file_name, file_path, description, created_at, updated_at)
    VALUES('emailTemplateStore.htm', 'templates/email/emailTemplateStore.htm', 'Template notificações da loja virtual', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO email_template(template_name, description, tag_name, file_id, enabled, visible, deleted, locked, created_at, updated_at)
    VALUES('Template loja virtual', 'Template de notificações das transações feitas na loja virtual', 'emailTemplateStore', (SELECT MAX(id) FROM file), true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO file(file_name, file_path, description, created_at, updated_at)
    VALUES('storePurchaseConfirm.htm', 'templates/email/storePurchaseConfirm.htm', 'Template de confirmação de compra na loja virtual', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO email_template(email_template_id, tag_name_parent, template_name, description, tag_name, file_id, enabled, visible, deleted, locked, created_at, updated_at)
    VALUES((SELECT MAX(id) FROM email_template), 'emailTemplateStore', 'Confirmação de compra na loja virtual', 'Confirmação de compra na loja virtual', 'storePurchaseConfirm', (SELECT MAX(id) FROM file), true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
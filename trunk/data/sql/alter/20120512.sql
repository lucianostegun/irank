CREATE SEQUENCE email_template_seq;
CREATE TABLE email_template (
    id INTEGER NOT NULL DEFAULT nextval('email_template_seq'::regclass) PRIMARY KEY,
    template_name VARCHAR(50),
    description VARCHAR(200),
    tag_name VARCHAR(32),
    file_id INTEGER,
    club_id INTEGER,
    email_template_id INTEGER,
    is_available_for_use BOOLEAN DEFAULT FALSE,
    is_available_for_sale BOOLEAN DEFAULT FALSE,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    locked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT email_template_FK_1 FOREIGN KEY (file_id) REFERENCES file (id),
    CONSTRAINT email_template_FK_2 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT email_template_FK_3 FOREIGN KEY (email_template_id) REFERENCES email_template (id)
);

INSERT INTO email_template(template_name, description, tag_name, file_id, enabled, visible, deleted, locked, created_at, updated_at)
    (SELECT description, description, tag_name, file_id, enabled, visible, deleted, locked, created_at, updated_at FROM auxiliar_text);

UPDATE email_template SET email_template_id = (SELECT id FROM email_template WHERE tag_name = 'emailTemplate') WHERE tag_name NOT IN ('emailTemplate', 'emailTemplateAdmin');
UPDATE email_template SET email_template_id = (SELECT id FROM email_template WHERE tag_name = 'emailTemplateAdmin') WHERE tag_name IN ('faqQuestion', 'feedbackMessage', 'contactMessage');

UPDATE file SET file_path = REPLACE(file_path, 'templates/pt_BR/', 'templates/pt_BR/email/') WHERE id IN (SELECT id FROM file WHERE id IN (SELECT file_id FROM email_template));
UPDATE file SET file_path = REPLACE(file_path, 'email/email/', 'email/') WHERE id IN (SELECT id FROM file WHERE id IN (SELECT file_id FROM email_template));
UPDATE file SET file_path = REPLACE(file_path, 'pt_BR/', '') WHERE id IN (SELECT id FROM file WHERE id IN (SELECT file_id FROM email_template));

INSERT INTO settings VALUES(nextval('settings_seq'), 'emailDebug', 'E-mail de debug', 'E-mail para envios de teste', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
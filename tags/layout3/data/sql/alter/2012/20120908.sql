ALTER TABLE email_template ADD COLUMN is_option BOOLEAN DEFAULT FALSE;
UPDATE email_template SET is_option = true WHERE tag_name_parent = 'emailTemplate';

CREATE TABLE email_option (
    email_address VARCHAR(150) NOT NULL,
    email_template_id INTEGER NOT NULL,
    lock_send BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY (email_address, email_template_id),
    CONSTRAINT email_option_FK_1 FOREIGN KEY (email_template_id) REFERENCES email_template (id)
);
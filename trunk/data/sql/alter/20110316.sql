CREATE TABLE email_log (
    email_address TEXT,
    email_subject VARCHAR(200),
    sending_status VARCHAR(10),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
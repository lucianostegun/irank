CREATE SEQUENCE log_seq;

CREATE TABLE log ( 
    id INTEGER NOT NULL DEFAULT nextval('log_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER,
    app VARCHAR(60),
    module_name VARCHAR(60),
    action_name VARCHAR(60),
    message VARCHAR(255),
    class_name VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    severity INTEGER DEFAULT 0
);

CREATE TABLE log_field ( 
    log_id INTEGER NOT NULL,
    field_name VARCHAR(32) NOT NULL,
    field_value VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(field_name, log_id)
);

CREATE TABLE email_log ( 
    email_address TEXT,
    email_subject VARCHAR(200),
    sending_status VARCHAR(10),
    created_at TIMESTAMP,
    updated_at TIMESTAMP 
);
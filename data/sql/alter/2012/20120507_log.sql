CREATE SEQUENCE sms_log_seq;
CREATE TABLE sms_log ( 
    id INTEGER NOT NULL DEFAULT nextval('sms_log_seq'::regclass),
    sms_id INTEGER NOT NULL,
    message_id VARCHAR(40),
    phone_number VARCHAR(13) NOT NULL,
    sending_status CHAR(3),
    created_at TIMESTAMP
);

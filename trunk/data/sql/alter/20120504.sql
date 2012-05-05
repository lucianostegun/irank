CREATE SEQUENCE email_log_seq;
CREATE TABLE email_log(
    id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('email_log_seq'),
    email_address VARCHAR(250) NOT NULL,
    error_message TEXT,
    created_at TIMESTAMP NOT NULL,
    read_at TIMESTAMP
);

ALTER TABLE event_live_player DROP COLUMN email_sent_date;
ALTER TABLE event_live_player DROP COLUMN email_read_date;
ALTER TABLE event_live_player ADD COLUMN email_log_id INTEGER;
ALTER TABLE event_live_player ADD CONSTRAINT event_live_player_fk_3 FOREIGN KEY (email_log_id) REFERENCES email_log(id);
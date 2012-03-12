CREATE SEQUENCE event_photo_contest_seq;
CREATE TABLE event_photo_contest (
    id INTEGER NOT NULL DEFAULT nextval('event_photo_contest'::regclass) PRIMARY KEY,
    event_photo_id_left INTEGER NOT NULL,
    event_photo_id_right INTEGER NOT NULL,
    event_photo_id_winner INTEGER,
    lock_key VARCHAR(32),
    ip_address INET,
    is_reported BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_photo_contest_FK_1 FOREIGN KEY (event_photo_id_left) REFERENCES event_photo (id),
    CONSTRAINT event_photo_contest_FK_2 FOREIGN KEY (event_photo_id_right) REFERENCES event_photo (id),
    CONSTRAINT event_photo_contest_FK_3 FOREIGN KEY (event_photo_id_winner) REFERENCES event_photo (id)
);
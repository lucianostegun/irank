CREATE SEQUENCE event_photo_seq;
CREATE TABLE event_photo (
    id INTEGER NOT NULL DEFAULT nextval('event_photo_seq'::regclass) PRIMARY KEY,
    event_id INTEGER NOT NULL,
    file_id INTEGER NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_photo_FK_1 FOREIGN KEY (event_id) REFERENCES event (id),
    CONSTRAINT event_photo_FK_2 FOREIGN KEY (file_id) REFERENCES file (id)
);
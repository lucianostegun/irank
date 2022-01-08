CREATE SEQUENCE event_photo_comment_seq;
CREATE TABLE event_photo_comment (
    id INTEGER NOT NULL DEFAULT nextval('event_photo_comment_seq'::regclass) PRIMARY KEY,
    event_photo_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    comment VARCHAR(140) NOT NULL,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_photo_comment_FK_1 FOREIGN KEY (event_photo_id) REFERENCES event_photo (id),
    CONSTRAINT event_photo_comment_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);
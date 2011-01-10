ALTER TABLE event_photo ADD COLUMN people_id INTEGER;
ALTER TABLE event_photo ADD CONSTRAINT event_photo_FK_3 FOREIGN KEY(people_id) REFERENCES people (id);
ALTER TABLE log ADD COLUMN severity INTEGER DEFAULT 0;
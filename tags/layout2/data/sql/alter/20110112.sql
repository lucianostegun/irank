CREATE SEQUENCE ranking_place_seq;
CREATE TABLE ranking_place (
    id INTEGER NOT NULL DEFAULT nextval('ranking_place_seq'::regclass) PRIMARY KEY,
    ranking_id INTEGER NOT NULL,
    place_name VARCHAR(20) NOT NULL,
    maps_link TEXT,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT ranking_place_FK_1 FOREIGN KEY(ranking_id) REFERENCES ranking (id)
);

ALTER TABLE event ADD COLUMN ranking_place_id INTEGER;
ALTER TABLE event ADD CONSTRAINT event_FK_2 FOREIGN KEY(ranking_place_id) REFERENCES ranking_place (id);

UPDATE event SET event_place = 'AP 31 Cassinos Bar' WHERE event_place = 'Apê do Wagner';
UPDATE event SET event_place = 'AP 31 Cassinos Bar' WHERE event_place = 'AP do Wagner';
UPDATE event SET event_place = 'Reyllagio' WHERE event_place = 'Casa do Reynaldo';
UPDATE event SET event_place = 'Stegun''s Poker House' WHERE event_place = 'Apê do Luciano';

INSERT INTO ranking_place(place_name, ranking_id, deleted, created_at, updated_at)
    (SELECT DISTINCT event_place, ranking_id, FALSE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM event WHERE ranking_id IS NOT NULL);

UPDATE event SET ranking_place_id = (SELECT id FROM ranking_place WHERE place_name = event_place AND event.RANKING_ID=ranking_id);

ALTER TABLE event DROP COLUMN event_place;
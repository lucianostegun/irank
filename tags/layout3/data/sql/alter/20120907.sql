ALTER TABLE ranking_place ADD COLUMN state_id INTEGER;
ALTER TABLE ranking_place ADD COLUMN city_name VARCHAR(32);
ALTER TABLE ranking_place ADD COLUMN quarter VARCHAR(32);

ALTER TABLE blog ADD COLUMN publish_date TIMESTAMP;

UPDATE blog SET publish_date = created_at;
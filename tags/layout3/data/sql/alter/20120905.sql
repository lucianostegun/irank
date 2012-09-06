ALTER TABLE event ADD COLUMN permalink VARCHAR(200);
UPDATE
    event 
SET 
    permalink = (SELECT COALESCE(ranking_tag, ranking_name) FROM ranking WHERE ranking.ID = event.RANKING_ID)||'/'||
    to_char(event_date, 'YYYY-MM-DD')||'/'||
    event_name;


UPDATE event SET permalink = LOWER(permalink);
UPDATE event SET permalink = TRIM(permalink);
UPDATE event SET permalink = no_accent(permalink);
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '&', 'n', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '[^a-z0-9/]', '-', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '-{2,}', '-', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '^[^a-z]', '', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '/[^a-z0-9]*', '/', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '[^a-z0-9]*/', '/', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '^[^a-z]*', '', 'g');
UPDATE event SET permalink = REGEXP_REPLACE(permalink, '[^a-z0-9]*$', '', 'g');

UPDATE event SET permalink = null WHERE NOT enabled OR NOT visible OR deleted;
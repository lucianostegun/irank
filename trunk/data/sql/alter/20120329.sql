ALTER TABLE user_site ADD COLUMN htpasswd_line INTEGER DEFAULT NULL;
ALTER TABLE user_site ADD COLUMN signed_schedule BOOLEAN DEFAULT FALSE;
ALTER TABLE user_site ADD COLUMN schedule_start_date DATE DEFAULT NULL;

UPDATE user_site SET signed_schedule = false, schedule_start_date = null;

UPDATE
    user_site
SET
    htpasswd_line = (SELECT COUNT(1)+1 FROM user_site user_site_count WHERE user_site.ID > user_site_count.ID AND visible AND enabled AND NOT deleted);

INSERT INTO config VALUES('htpasswdFilePath', 'Endereo do arquivo .htpasswd', '../.htpasswd', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


CREATE OR REPLACE VIEW event_schedule_view AS
SELECT
    event.ID,
    event.EVENT_NAME,
    event.EVENT_DATE,
    event.START_TIME,
    event.EVENT_DATE_TIME,
    event.COMMENTS,
    event.PLAYERS,
    ranking.RANKING_NAME,
    ranking_place.PLACE_NAME,
    event_player.PEOPLE_ID,
    event.CREATED_AT,
    ranking.ID AS ranking_id
FROM
    event
    INNER JOIN ranking ON event.RANKING_ID=ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID=ranking_place.ID
    INNER JOIN event_player ON event_player.EVENT_ID=event.ID
WHERE
    event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;



SELECT
    username||':{SHA}2jmj7l5rSw0yVb/vlWAYkK/YBwk=',
    (SELECT COUNT(1) FROM user_site user_site_count WHERE user_site.ID > user_site_count.ID AND visible AND enabled AND NOT deleted)+1
FROM
    user_site
WHERE
    visible
    AND enabled
    AND NOT deleted
ORDER BY id;
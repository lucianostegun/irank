ALTER TABLE user_site ADD COLUMN htpasswd_line INTEGER DEFAULT NULL;
ALTER TABLE user_site ADD COLUMN signed_schedule BOOLEAN DEFAULT FALSE;
ALTER TABLE user_site ADD COLUMN schedule_start_date DATE DEFAULT NULL;

UPDATE user_site SET signed_schedule = false, schedule_start_date = null;

UPDATE
    user_site
SET
    htpasswd_line = (SELECT COUNT(1)+1 FROM user_site user_site_count WHERE user_site.ID > user_site_count.ID AND visible AND enabled AND NOT deleted);

INSERT INTO config VALUES('htpasswdFilePath', 'Endereo do arquivo .htpasswd', '../.htpasswd', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

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
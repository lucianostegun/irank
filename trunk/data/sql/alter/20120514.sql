ALTER TABLE email_template ADD COLUMN tag_name_parent VARCHAR(32);
ALTER TABLE email_template ADD CONSTRAINT email_template_UK_1 UNIQUE (tag_name);
ALTER TABLE email_template ADD CONSTRAINT email_template_FK_4 FOREIGN KEY (tag_name_parent) REFERENCES email_template (tag_name) ON UPDATE CASCADE;

UPDATE email_template SET tag_name_parent = (SELECT tag_name FROM email_template et WHERE et.ID = email_template.EMAIL_TEMPLATE_ID) WHERE email_template_id IS NOT NULL;

CREATE OR REPLACE FUNCTION _group_concat(text, text)  
RETURNS text AS '  
SELECT CASE  
WHEN $2 IS NULL THEN $1  
WHEN $1 IS NULL THEN $2  
ELSE $1 operator(pg_catalog.||) '','' operator(pg_catalog.||) $2  
END  
' IMMUTABLE LANGUAGE SQL;  
  
CREATE AGGREGATE group_concat (  
BASETYPE = text,  
SFUNC = _group_concat,  
STYPE = text  
);

CREATE OR REPLACE FUNCTION get_pending_invite_list(peopleId INTEGER) RETURNS VARCHAR AS '
DECLARE
    eventLiveIdList VARCHAR;
BEGIN

    SELECT
        GROUP_CONCAT(DISTINCT CAST(id AS VARCHAR)) INTO eventLiveIdList
    FROM
        (SELECT
            event_live.ID
        FROM
            event_live_player_disclosure_email
            INNER JOIN event_live ON event_live_player_disclosure_email.EVENT_LIVE_ID = event_live.ID
            LEFT JOIN event_live_player ON event_live_player.EVENT_LIVE_ID = event_live_player_disclosure_email.EVENT_LIVE_ID AND event_live_player.PEOPLE_ID = event_live_player_disclosure_email.PEOPLE_ID
        WHERE
            event_live_player_disclosure_email.PEOPLE_ID = peopleId
            AND event_live_player.EVENT_LIVE_ID IS NULL
            AND event_live.ENABLED
            AND event_live.VISIBLE
            AND NOT event_live.DELETED
            AND NOT event_live.SAVED_RESULT
            AND event_live.EVENT_DATE_TIME > CURRENT_TIMESTAMP

        UNION

        SELECT
            event_live.ID
        FROM
            event_live_player_disclosure_sms
            INNER JOIN event_live ON event_live_player_disclosure_sms.EVENT_LIVE_ID = event_live.ID
            LEFT JOIN event_live_player ON event_live_player.EVENT_LIVE_ID = event_live_player_disclosure_sms.EVENT_LIVE_ID AND event_live_player.PEOPLE_ID = event_live_player_disclosure_sms.PEOPLE_ID
        WHERE
            event_live_player_disclosure_sms.PEOPLE_ID = peopleId
            AND event_live_player.EVENT_LIVE_ID IS NULL
            AND event_live.ENABLED
            AND event_live.VISIBLE
            AND NOT event_live.DELETED
            AND NOT event_live.SAVED_RESULT
            AND event_live.EVENT_DATE_TIME > CURRENT_TIMESTAMP) as T1;

    RETURN eventLiveIdList;
END'
LANGUAGE 'plpgsql';

CREATE VIEW people_type AS
SELECT 
    id,
    description,
    tag_name,
    created_at,
    updated_at
FROM
    virtual_table 
WHERE 
    enabled
    AND visible
    AND NOT deleted
    AND virtual_table_name = 'peopleType';

ALTER TABLE people ADD COLUMN phone_number VARCHAR(15);
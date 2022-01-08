ALTER TABLE event_live_player_disclosure_sms DROP CONSTRAINT event_live_player_disclosure_sms_fk_3;

DROP TABLE sms;
CREATE TABLE sms (
    id INTEGER NOT NULL DEFAULT nextval('sms_seq'::regclass) PRIMARY KEY,
    people_id INTEGER,
    phone_number VARCHAR(15) NOT NULL,
    message VARCHAR(240),
    status_code CHAR(3),
    status_message VARCHAR(250),
    message_id VARCHAR(64),
    created_at TIMESTAMP,
    CONSTRAINT sms_FK_1 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER FUNCTION get_pending_invite_list(peopleId INTEGER) RENAME TO get_pending_event_live_invite_list;
ALTER FUNCTION get_pending_invites(peopleId INTEGER) RENAME TO get_pending_event_live_invites;

ALTER TABLE event_player ADD COLUMN suppress_notify BOOLEAN DEFAULT FALSE;

CREATE OR REPLACE FUNCTION get_pending_event_invites(peopleId INTEGER) RETURNS INTEGER AS '
DECLARE
    pendingInvites INTEGER;
BEGIN

    SELECT
        COUNT(event.ID) INTO pendingInvites
    FROM
        event
        INNER JOIN event_player ON event_player.EVENT_ID = event.ID
    WHERE
        event_player.PEOPLE_ID = peopleId
        AND NOT event_player.SUPPRESS_NOTIFY
        AND (event_player.INVITE_STATUS IS NULL OR event_player.INVITE_STATUS = ''none'')
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED
        AND NOT event.SAVED_RESULT
        AND event.EVENT_DATE_TIME > CURRENT_TIMESTAMP;

    RETURN pendingInvites;
END'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_pending_event_invite_list(peopleId INTEGER) RETURNS VARCHAR AS '
DECLARE
    eventIdList VARCHAR;
BEGIN

    SELECT
        GROUP_CONCAT(DISTINCT CAST(event.ID AS VARCHAR)) INTO eventIdList
    FROM
        event
        INNER JOIN event_player ON event_player.EVENT_ID = event.ID
    WHERE
        event_player.PEOPLE_ID = peopleId
        AND NOT event_player.SUPPRESS_NOTIFY
        AND (event_player.INVITE_STATUS IS NULL OR event_player.INVITE_STATUS = ''none'')
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED
        AND NOT event.SAVED_RESULT
        AND event.EVENT_DATE_TIME > CURRENT_TIMESTAMP;

    RETURN eventIdList;
END'
LANGUAGE 'plpgsql';

CREATE TABLE sms_ranking_option ( 
    people_id INTEGER NOT NULL,
    ranking_id INTEGER NOT NULL,
    sms_template_id INTEGER NOT NULL,
    lock_send BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(people_id, ranking_id, sms_template_id),
    CONSTRAINT sms_ranking_option_FK_1 FOREIGN KEY (people_id) REFERENCES people (id),
    CONSTRAINT sms_ranking_option_FK_2 FOREIGN KEY (ranking_id) REFERENCES ranking (id),
    CONSTRAINT sms_ranking_option_FK_3 FOREIGN KEY (sms_template_id) REFERENCES sms_template (id)
);

ALTER TABLE ranking_player ADD COLUMN suppress_email_notify BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_player ADD COLUMN suppress_sms_notify BOOLEAN DEFAULT FALSE;

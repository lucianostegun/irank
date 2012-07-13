INSERT INTO settings VALUES(nextval('settings_seq'), 'emailTemplateIdEventCreateNotify', 'Notificação de eventos', 'Template de e-mail padrão para notificação de novos eventos', '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE ranking_live ADD COLUMN email_template_id INTEGER;
ALTER TABLE ranking_live ADD CONSTRAINT ranking_live_FK_4 FOREIGN KEY (email_template_id) REFERENCES email_template (id);

ALTER TABLE event_live ADD COLUMN email_template_id INTEGER;
ALTER TABLE event_live ADD CONSTRAINT event_live_FK_3 FOREIGN KEY (email_template_id) REFERENCES email_template (id);


UPDATE event_live SET description = REPLACE(description, '<descrição do ranking>', '[descrição do ranking]');

ALTER TABLE event_live ADD COLUMN step_number VARCHAR(2);
ALTER TABLE event_live ADD COLUMN step_day VARCHAR(5);

CREATE OR REPLACE FUNCTION get_pending_invites(peopleId INTEGER) RETURNS INTEGER AS '
DECLARE
    pendingInvites INTEGER;
BEGIN

    SELECT
        COUNT(DISTINCT id) INTO pendingInvites
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

    RETURN pendingInvites;
END'
LANGUAGE 'plpgsql';
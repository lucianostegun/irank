DROP VIEW IF EXISTS event_schedule_view;
CREATE OR REPLACE VIEW event_schedule_view AS
SELECT
    event.ID,
    event.EVENT_NAME,
    event.EVENT_DATE,
    event.START_TIME,
    event.EVENT_DATE_TIME,
    event.COMMENTS,
    event.PLAYERS,
    event.IS_FREEROLL,
    event.BUYIN,
    event.ENTRANCE_FEE,
    event.ALLOW_REBUY,
    event.ALLOW_ADDON,
    ranking.RANKING_NAME,
    ranking_place.PLACE_NAME,
    event.CREATED_AT,
    ranking.ID AS ranking_id,
    event_player.PEOPLE_ID,
    event_player.INVITE_STATUS
FROM
    event
    INNER JOIN ranking ON event.RANKING_ID=ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID=ranking_place.ID
    INNER JOIN event_player ON event_player.EVENT_ID=event.ID
WHERE
    event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;

INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, created_at, updated_at) VALUES
    ('userSiteOption', 'Estado da agenda', 'scheduleStateId', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('userSiteOption', 'Cidade da agenda', 'scheduleCityId', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('userSiteOption', 'Tempo de alerta', 'scheduleAlarmTime', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO user_site_option(people_id, user_site_option_id, option_value, created_at, updated_at)
    (SELECT id, (SELECT MAX(id) FROM user_option), '4H', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM people WHERE people_type_id = 2);


UPDATE state SET order_seq = id+5;
UPDATE state SET order_seq = 1 WHERE initial = 'SP';
UPDATE state SET order_seq = 2 WHERE initial = 'RJ';
UPDATE state SET order_seq = 3 WHERE initial = 'PR';
UPDATE state SET order_seq = 4 WHERE initial = 'DF';
UPDATE state SET order_seq = 5 WHERE initial = 'GO';
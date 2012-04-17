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




DROP VIEW IF EXISTS event_live_schedule_view;
CREATE OR REPLACE VIEW event_live_schedule_view AS
SELECT
    event_live.ID,
    event_live.EVENT_NAME,
    event_live.EVENT_DATE,
    event_live.START_TIME,
    event_live.EVENT_DATE_TIME,
    event_live.COMMENTS,
    event_live.PLAYERS,
    event_live.IS_FREEROLL,
    event_live.BUYIN,
    event_live.ENTRANCE_FEE,
    event_live.ALLOWED_REBUYS,
    event_live.IS_ILIMITED_REBUYS,
    event_live.ALLOWED_ADDONS,
    ranking_live.RANKING_NAME,
    club.CLUB_NAME,
    club.MAPS_LINK,
    city.CITY_NAME,
    state.INITIAL,
    event_live.CREATED_AT,
    ranking_live.ID AS ranking_live_id
FROM
    event_live
    INNER JOIN ranking_live ON event_live.RANKING_LIVE_ID=ranking_live.ID
    INNER JOIN club ON event_live.CLUB_ID=club.ID
    INNER JOIN city ON club.CITY_ID=city.ID
    INNER JOIN state ON city.STATE_ID=state.ID
WHERE
    event_live.ENABLED
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE;

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
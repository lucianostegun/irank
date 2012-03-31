DROP VIEW event_schedule_view;
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
    event_player.PEOPLE_ID
FROM
    event
    INNER JOIN ranking ON event.RANKING_ID=ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID=ranking_place.ID
    INNER JOIN event_player ON event_player.EVENT_ID=event.ID
WHERE
    event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;

ALTER TABLE event_live RENAME COLUMN event_datetime TO event_date_time;
ALTER TABLE event_live ADD COLUMN is_freeroll BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN entrance_fee DECIMAL(10, 2) DEFAULT 0;
ALTER TABLE event_live ADD COLUMN comments VARCHAR(250);







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
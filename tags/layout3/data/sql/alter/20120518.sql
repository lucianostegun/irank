ALTER TABLE event_live ADD COLUMN schedule_start_date DATE;
ALTER TABLE event_live ADD COLUMN enrollment_start_date DATE;

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
    city.ID AS city_id,
    city.CITY_NAME,
    state.ID AS state_id,
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
    AND NOT event_live.SUPPRESS_SCHEDULE
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE
    AND (event_live.SCHEDULE_START_DATE IS NULL OR event_live.SCHEDULE_START_DATE <= CURRENT_DATE);
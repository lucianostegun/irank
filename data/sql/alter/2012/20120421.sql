ALTER TABLE event_live ADD COLUMN suppress_schedule BOOLEAN DEFAULT FALSE;

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
    AND NOT event_live.SUPPRESS_SCHEDULE
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE;

ALTER TABLE event_photo ADD COLUMN contest_runs INTEGER DEFAULT 0;
ALTER TABLE event_photo ADD COLUMN contest_wins INTEGER DEFAULT 0;
ALTER TABLE event_photo ADD COLUMN contest_ratio FLOAT DEFAULT 0.0;





CREATE OR REPLACE FUNCTION update_photo_contest(eventPhotoIdWinner INTEGER, eventPhotoIdLoser INTEGER) RETURNS VOID AS '
BEGIN

    UPDATE event_photo SET contest_runs = contest_runs+1 WHERE id IN (eventPhotoIdWinner, eventPhotoIdLoser);
    UPDATE event_photo SET contest_wins = contest_wins+1 WHERE id = eventPhotoIdWinner;
    UPDATE event_photo SET contest_ratio = (contest_wins::FLOAT/contest_runs::FLOAT)::FLOAT WHERE id IN (eventPhotoIdWinner, eventPhotoIdLoser) AND contest_wins > 0;

END'
LANGUAGE 'plpgsql';
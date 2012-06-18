ALTER TABLE club ADD COLUMN latitude FLOAT;
ALTER TABLE club ADD COLUMN longitude FLOAT;

CREATE VIEW event_live_view AS
SELECT
    event_live.ID,
    event_live.RANKING_LIVE_ID,
    event_live.CLUB_ID,
    event_live.EVENT_NAME,
    event_live.STEP_NUMBER,
    event_live_schedule.STEP_DAY,

    COALESCE(event_live_schedule.EVENT_DATE, event_live.EVENT_DATE) AS event_date,
    COALESCE(event_live_schedule.START_TIME, event_live.START_TIME) AS start_time,
    COALESCE(event_live_schedule.EVENT_DATE_TIME, event_live.EVENT_DATE_TIME) AS event_date_time,
    event_live.DESCRIPTION,
    event_live.BUYIN,
    event_live.ENTRANCE_FEE,

    event_live.BLIND_TIME,
    event_live.STACK_CHIPS,
    event_live.PLAYERS,
    event_live.ALLOWED_REBUYS,
    event_live.ALLOWED_ADDONS,
    event_live.CREATED_AT,
    event_live.UPDATED_AT,
    event_live.IS_ILIMITED_REBUYS,
    event_live.SAVED_RESULT,
    event_live.IS_FREEROLL,
    event_live.COMMENTS,
    event_live.SUPPRESS_SCHEDULE,
    event_live.SCHEDULE_START_DATE,
    event_live.ENROLLMENT_START_DATE,
    event_live.ENROLLMENT_MODE,
    event_live.SUPPRESS_RANKING,
    event_live.GUARANTEED_PRIZE,
    event_live.IS_MULTIDAY,
    event_live.IS_SATELLITE
FROM
    event_live
    LEFT JOIN event_live_schedule ON event_live_schedule.EVENT_LIVE_ID = event_live.ID
WHERE
    event_live.ENABLED
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
DROP TABLE event_live_schedule;

CREATE TABLE event_live_schedule (
    id SERIAL NOT NULL,
    event_live_id INTEGER NOT NULL,
    event_date DATE,
    start_time TIME,
    event_date_time TIMESTAMP,
    days_after INTEGER,
    step_day VARCHAR(10),
    created_at TIMESTAMP,
    PRIMARY KEY(event_live_id, event_date, start_time),
    CONSTRAINT event_live_schedule_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id)
);

CREATE TABLE ranking_live_template (
    ranking_live_id INTEGER NOT NULL,
    days_after INTEGER,
    start_time TIME,
    step_day VARCHAR(10),
    created_at TIMESTAMP,
    PRIMARY KEY(ranking_live_id, days_after, start_time),
    CONSTRAINT ranking_live_template_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id)
);

DROP VIEW event_live_search;
CREATE VIEW event_live_search AS
SELECT
    event_live.ID,
    event_live_schedule.ID AS event_live_schedule_id,
    ranking_live.RANKING_NAME,
    event_live.STEP_NUMBER,
    event_live.EVENT_NAME,
    event_live.EVENT_SHORT_NAME,
    COALESCE(event_live_schedule.EVENT_DATE, event_live.EVENT_DATE) AS event_date,
    COALESCE(event_live_schedule.EVENT_DATE_TIME, event_live.EVENT_DATE_TIME) AS event_date_time,
    event_live_schedule.STEP_DAY,
    event_live.DESCRIPTION,
    event_live.BUYIN,
    event_live.BLIND_TIME,
    event_live.STACK_CHIPS,
    event_live.PLAYERS,
    event_live.ALLOWED_REBUYS,
    event_live.ALLOWED_ADDONS,
    event_live.IS_ILIMITED_REBUYS,
    event_live.ENTRANCE_FEE,
    event_live.IS_FREEROLL,
    club.CLUB_NAME,
    club.ADDRESS_QUARTER,
    city.CITY_NAME,
    state.INITIAL
FROM
    event_live
    LEFT JOIN ranking_live ON event_live.RANKING_LIVE_ID = ranking_live.ID AND ranking_live.ENABLED AND ranking_live.VISIBLE AND NOT ranking_live.DELETED
    LEFT JOIN event_live_schedule ON event_live_schedule.EVENT_LIVE_ID=event_live.ID
    INNER JOIN club ON event_live.CLUB_ID = club.ID
    INNER JOIN city ON club.CITY_ID=city.ID
    INNER JOIN state ON city.STATE_ID=state.ID
WHERE
    club.ENABLED
    AND club.VISIBLE
    AND NOT club.DELETED
    AND event_live.ENABLED
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE;
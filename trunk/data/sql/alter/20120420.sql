DROP VIEW event_live_search;
CREATE VIEW event_live_search AS
SELECT
    event_live.ID,
    ranking_live.RANKING_NAME,
    event_live.EVENT_NAME,
    event_live.EVENT_SHORT_NAME,
    event_live.EVENT_DATE,
    event_live.EVENT_DATE_TIME,
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
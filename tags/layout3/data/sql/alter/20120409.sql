CREATE VIEW event_search AS
SELECT
    DISTINCT event.ID,
    ranking.RANKING_NAME,
    event.EVENT_NAME,
    event.EVENT_DATE,
    event.EVENT_DATE_TIME,
    event.COMMENTS,
    event.BUYIN,
    event.PLAYERS,
    event.ALLOW_REBUY,
    event.ALLOW_ADDON,
    event.ENTRANCE_FEE,
    event.IS_FREEROLL,
    ranking_place.PLACE_NAME,
    event_player.PEOPLE_ID
FROM
    event
    LEFT JOIN ranking ON event.RANKING_ID = ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID = ranking_place.ID
    INNER JOIN event_player ON event.ID = event_player.EVENT_ID
WHERE
    ranking.ENABLED
    AND ranking.VISIBLE
    AND NOT ranking.DELETED
    AND event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;
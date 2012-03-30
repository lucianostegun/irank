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
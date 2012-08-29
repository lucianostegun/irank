CREATE OR REPLACE VIEW bankroll AS 
    (SELECT
        event.ID,
        event.EVENT_DATE,
        event.EVENT_NAME,
        event_player.EVENT_POSITION,
        event.PLAYERS,
        event_player.BUYIN,
        event_player.ENTRANCE_FEE,
        event_player.REBUY,
        event_player.ADDON,
        event_player.PRIZE,
        event_player.PEOPLE_ID,
        null AS user_site_id,
        ranking_place.PLACE_NAME,
        'event' AS event_type
    FROM
        event_player
        INNER JOIN event ON event_player.EVENT_ID = event.ID
        INNER JOIN ranking ON ranking.ID = event.RANKING_ID
        INNER JOIN ranking_place ON ranking_place.ID = event.RANKING_PLACE_ID
    WHERE
        event_player.ENABLED
        AND event_player.EVENT_POSITION > 0
        AND event.ENABLED
        AND event.VISIBLE
        AND event.SAVED_RESULT
        AND NOT event.DELETED
        AND ranking.ENABLED
        AND ranking.VISIBLE
        AND NOT ranking.DELETED
    ORDER BY
        event.EVENT_DATE)

    UNION

    (SELECT
        event_personal.ID,
        event_personal.EVENT_DATE,
        event_personal.EVENT_NAME,
        event_personal.EVENT_POSITION,
        event_personal.PLAYERS,
        event_personal.BUYIN,
        0 AS entrance_fee,
        event_personal.REBUY,
        event_personal.ADDON,
        event_personal.PRIZE,
        null AS people_id,
        event_personal.USER_SITE_ID,
        event_personal.EVENT_PLACE,
        'eventPersonal' AS event_type
    FROM
        event_personal
    WHERE
        enabled
        AND visible
        AND NOT deleted);
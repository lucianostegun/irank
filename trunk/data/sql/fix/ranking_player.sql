UPDATE 
    ranking_player
SET 
    total_events = (SELECT 
                        COUNT(1) 
                    FROM 
                        event_player
                        INNER JOIN event ON event_player.EVENT_ID=event.ID
                    WHERE
                        event_player.ENABLED = true
                        AND event.RANKING_ID=ranking_player.RANKING_ID
                        AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
                        AND event.DELETED = FALSE
                        AND event.VISIBLE = TRUE
                        AND event.ENABLED = TRUE
                        AND event.SAVED_RESULT = TRUE
                        AND event.EVENT_DATE < CURRENT_DATE);


UPDATE 
    ranking
SET 
    events = (SELECT 
                    COUNT(1) 
                FROM 
                    event
                WHERE
                    event.RANKING_ID = ranking.ID
                    AND event.DELETED = FALSE
                    AND event.VISIBLE = TRUE
                    AND event.ENABLED = TRUE);

UPDATE
    event
SET
    players = (SELECT
                    COUNT(1)
               FROM
                    event_player
               WHERE
                    event_player.EVENT_ID = event.ID
                    AND event_player.ENABLED = TRUE
                    AND event_player.DELETED = FALSE);

UPDATE
    event
SET
    invites = (SELECT
                    COUNT(1)
               FROM
                    event_player
               WHERE
                    event_player.EVENT_ID = event.ID
                    AND event_player.DELETED = FALSE);

UPDATE
    event_player
SET
    score = (SELECT SUM(buyin+rebuy+addon) FROM event_player ep WHERE ep.EVENT_ID = event_player.EVENT_ID) / event_position / buyin
WHERE
    buyin > 0
    AND event_position > 0;

UPDATE 
    ranking_history
SET
    score = (SELECT 
                SUM(score) 
             FROM 
                event_player
                INNER JOIN event ON event_player.EVENT_ID = event.ID
             WHERE
                people_id = ranking_history.PEOPLE_ID
                AND event.RANKING_ID = ranking_history.RANKING_ID
                AND event.EVENT_DATE = ranking_history.RANKING_DATE),
    total_score = (SELECT 
                      SUM(score) 
                   FROM 
                      event_player
                      INNER JOIN event ON event_player.EVENT_ID = event.ID
                   WHERE
                      people_id = ranking_history.PEOPLE_ID
                      AND event.RANKING_ID = ranking_history.RANKING_ID
                      AND event.EVENT_DATE <= ranking_history.RANKING_DATE),
    paid_value = (SELECT 
                      SUM(event_player.BUYIN+event_player.REBUY+event_player.ADDON) 
                   FROM 
                      event_player
                      INNER JOIN event ON event_player.EVENT_ID = event.ID
                   WHERE
                      people_id = ranking_history.PEOPLE_ID
                      AND event.RANKING_ID = ranking_history.RANKING_ID
                      AND event.EVENT_DATE <= ranking_history.RANKING_DATE);

//UPDATE ranking_player SET total_score = (SELECT SUM(score) FROM ranking_history WHERE ranking_id = ranking_player.RANKING_ID AND people_id = ranking_player.PEOPLE_ID);
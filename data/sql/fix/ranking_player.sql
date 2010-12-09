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


UPDATE ranking_player SET total_score = (total_average*total_events*10)+(total_events*10);
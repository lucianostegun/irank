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
                        AND event_date < '2010-11-30');


UPDATE 
    ranking
SET 
    events = (SELECT 
                    COUNT(1) 
                FROM 
                    event
                WHERE
                    event.RANKING_ID=ranking.ID
                    AND event.DELETED = FALSE
                    AND event.VISIBLE = TRUE
                    AND event.ENABLED = TRUE);
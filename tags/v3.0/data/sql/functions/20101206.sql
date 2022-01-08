CREATE OR REPLACE FUNCTION fc_update_ranking_player_events(p_ranking_id INTEGER) RETURNS INTEGER AS '
BEGIN

    UPDATE 
        ranking_player
    SET 
        total_events = (SELECT 
                            COUNT(1) 
                        FROM 
                            event_player
                            INNER JOIN event ON event_player.EVENT_ID=event.ID
                        WHERE
                            event.RANKING_ID=p_ranking_id
                            AND event_player.ENABLED = true
                            AND event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
                            AND NOT event.DELETED
                            AND event.VISIBLE
                            AND event.ENABLED
                        	AND event.SAVED_RESULT = TRUE);

  RETURN 0;
END'
LANGUAGE plpgsql;
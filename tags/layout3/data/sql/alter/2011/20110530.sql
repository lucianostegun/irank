CREATE OR REPLACE FUNCTION adjust_ranking_events() RETURNS VOID AS
'
DECLARE
BEGIN
	
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

END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION adjust_ranking_players() RETURNS VOID AS
'
DECLARE
BEGIN
	
    UPDATE
        ranking
    SET
        players = (SELECT
                       COUNT(1)
                   FROM
                       ranking_player
                   WHERE
                       ranking_player.RANKING_ID = ranking.ID
                       AND enabled);

END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION adjust_ranking_player_events() RETURNS VOID AS
'
DECLARE
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
                            event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.ENABLED = true
                            AND event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
                            AND event.DELETED = FALSE
                            AND event.VISIBLE = TRUE
                            AND event.ENABLED = TRUE
                            AND event.SAVED_RESULT = TRUE);

END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION adjust_ranking_player_events() RETURNS VOID AS
'
DECLARE
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
                            event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.ENABLED = true
                            AND event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
                            AND event.DELETED = FALSE
                            AND event.VISIBLE = TRUE
                            AND event.ENABLED = TRUE
                            AND event.SAVED_RESULT = TRUE);

END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION adjust_ranking_player_events() RETURNS VOID AS
'
DECLARE
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
                            event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.ENABLED = true
                            AND event.RANKING_ID=ranking_player.RANKING_ID
                            AND event_player.PEOPLE_ID=ranking_player.PEOPLE_ID
                            AND event.DELETED = FALSE
                            AND event.VISIBLE = TRUE
                            AND event.ENABLED = TRUE
                            AND event.SAVED_RESULT = TRUE);

END
'
LANGUAGE 'plpgsql';
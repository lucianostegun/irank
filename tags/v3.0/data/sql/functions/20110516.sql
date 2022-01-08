CREATE OR REPLACE FUNCTION get_total_freeroll_prize(p_ranking_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(prize) INTO result
    FROM
        event_player
        INNER JOIN event ON event_player.EVENT_ID = event.ID
    WHERE
        event.RANKING_ID = p_ranking_id
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED
        AND event.IS_FREEROLL
        AND event.SAVED_RESULT;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_total_freeroll_entrance_fee(p_ranking_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(event_player.entrance_fee) INTO result
    FROM
        event_player
        INNER JOIN event ON event_player.EVENT_ID = event.ID
    WHERE
        event.RANKING_ID = p_ranking_id
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED
        AND event.SAVED_RESULT;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_ranking_balance(p_ranking_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    RETURN get_total_freeroll_entrance_fee(p_ranking_id)-get_total_freeroll_prize(p_ranking_id);
END
'
LANGUAGE 'plpgsql';
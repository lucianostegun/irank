CREATE OR REPLACE FUNCTION get_total_freeroll_prize(p_ranking_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        (SUM(prize)-SUM(rebuy)-SUM(addon)) INTO result
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
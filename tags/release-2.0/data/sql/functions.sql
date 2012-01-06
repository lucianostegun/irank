CREATE OR REPLACE FUNCTION get_player_profit_personal(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(event_personal.PRIZE) INTO result
    FROM 
        event_personal
        INNER JOIN user_site ON event_personal.USER_SITE_ID=user_site.ID
    WHERE 
        user_site.PEOPLE_ID = p_people_id
        AND event_personal.VISIBLE=TRUE
        AND event_personal.DELETED=FALSE;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_profit(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(event_player.PRIZE)+get_player_profit_personal(p_people_id) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id
        AND event.VISIBLE=TRUE
        AND event.DELETED=FALSE
        AND event.SAVED_RESULT=TRUE
        AND event_player.EVENT_ID=event.ID;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_score(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(event_player.SCORE) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_bra_personal(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_personal.BUYIN+event_personal.REBUY+event_personal.ADDON) INTO result
    FROM 
        event_personal
        INNER JOIN user_site ON event_personal.USER_SITE_ID=user_site.ID
    WHERE 
        user_site.PEOPLE_ID = p_people_id
        AND event_personal.VISIBLE=TRUE 
        AND event_personal.DELETED=FALSE;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_bra(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON)+get_player_bra_personal(p_people_id) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_average(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.PRIZE/(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON))
        /
        (SELECT COUNT(1) FROM event_player, event WHERE event_player.PEOPLE_ID = p_people_id AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event_player.BUYIN > 0) INTO result
    FROM
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id 
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID 
        AND event_player.BUYIN > 0;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_balance(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        get_player_profit(p_people_id)-
        get_player_bra(p_people_id) INTO result;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_player_position(p_ranking_id INTEGER, p_people_id INTEGER, p_ranking_date DATE) RETURNS INTEGER AS'
    DECLARE ranking_position INTEGER;
BEGIN

    SELECT
        total_ranking_position INTO ranking_position
    FROM
        ranking_history
    WHERE
        people_id = p_people_id
        AND ranking_id = p_ranking_id
        AND ranking_date <= p_ranking_date
    ORDER BY
        ranking_date DESC LIMIT 1;

    RETURN ranking_position;
END'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_position(p_ranking_id INTEGER, p_people_id INTEGER) RETURNS INTEGER AS'
BEGIN

    RETURN get_player_position(p_ranking_id, p_people_id, CURRENT_DATE);
END'
LANGUAGE 'plpgsql';

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
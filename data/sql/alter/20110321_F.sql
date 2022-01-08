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
        SUM(event_player.BUYIN+event_player.REBUY+event_player.ADDON)+get_player_bra_personal(p_people_id) INTO result
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
        SUM(event_player.PRIZE/(event_player.BUYIN+event_player.REBUY+event_player.ADDON))
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
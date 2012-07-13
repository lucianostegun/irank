CREATE OR REPLACE FUNCTION get_event_count(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COUNT(1) INTO result
    FROM 
        event 
        INNER JOIN event_player ON event_player.EVENT_ID=event.ID
    WHERE 
        event_player.PEOPLE_ID = peopleId
        AND event_player.ENABLED
        AND NOT event_player.DELETED
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_event_personal_count(userSiteId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COUNT(1) INTO result
    FROM 
        event_personal 
    WHERE 
        user_site_id = userSiteId
        AND enabled 
        AND visible 
        AND NOT deleted;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';
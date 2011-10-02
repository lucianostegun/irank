INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('userSiteOption', 'Contagem de resumo', 'quickResumePeriod', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO user_site_option (SELECT people_id, (SELECT MAX(id) FROM virtual_table WHERE virtual_table_name = 'userSiteOption'), 'always', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM user_site WHERE enabled AND visible);


CREATE OR REPLACE FUNCTION get_user_option(peopleId INTEGER, tagName VARCHAR) RETURNS VARCHAR AS
'
DECLARE
  optionValue VARCHAR;
BEGIN
	
    SELECT
        option_value INTO optionValue
    FROM
        people
        LEFT JOIN user_site_option ON user_site_option.PEOPLE_ID=people.ID
        LEFT JOIN virtual_table ON user_site_option.USER_SITE_OPTION_ID=virtual_table.ID
    WHERE
        people.ID = peopleId
        AND virtual_table.TAG_NAME = tagName;

   RETURN optionValue;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_user_option(peopleId INTEGER, tagName VARCHAR, defaultValue VARCHAR) RETURNS VARCHAR AS
'
DECLARE
  optionValue VARCHAR;
BEGIN
	
    SELECT get_user_option(peopleId, tagName) INTO optionValue;

    IF optionValue IS NULL THEN
        optionValue := defaultValue;
    END IF;

    RETURN optionValue;
END
'
LANGUAGE 'plpgsql';



CREATE OR REPLACE FUNCTION get_resume_start_date(peopleId INTEGER) RETURNS DATE AS
'
DECLARE
  optionValue VARCHAR;
  result DATE;
BEGIN
	
    optionValue := (SELECT get_user_option(peopleId, ''quickResumePeriod'', ''aways''));

    IF optionValue = ''always'' THEN
        result := ''2009-01-01'';
    END IF;

    IF optionValue = ''currentYear'' THEN
        result := EXTRACT(YEAR FROM CURRENT_DATE)||''-01-01'';
    END IF;

    IF optionValue = ''currentMonth'' THEN
        result := EXTRACT(YEAR FROM CURRENT_DATE)||''-''||EXTRACT(MONTH FROM CURRENT_DATE)||''-01'';
    END IF;

    IF optionValue = ''lastMonth'' THEN
        result := CURRENT_DATE-30;
    END IF;

    IF optionValue = ''lastYear'' THEN
        result := CURRENT_DATE-365;
    END IF;

    RETURN result;
END
'
LANGUAGE 'plpgsql';


DROP FUNCTION get_player_bra(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_bra(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON)+get_player_bra_personal(peopleId) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = peopleId
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID
        AND event.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';



DROP FUNCTION get_player_profit(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_profit(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
  period VARCHAR;
BEGIN

    SELECT
        SUM(event_player.PRIZE)+get_player_profit_personal(peopleId) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = peopleId
        AND event.VISIBLE=TRUE
        AND event.DELETED=FALSE
        AND event.SAVED_RESULT=TRUE
        AND event_player.EVENT_ID=event.ID
        AND event.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


DROP FUNCTION get_player_profit_personal(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_profit_personal(peopleId INTEGER) RETURNS DECIMAL AS
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
        user_site.PEOPLE_ID = peopleId
        AND event_personal.VISIBLE=TRUE
        AND event_personal.DELETED=FALSE
        AND event_personal.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';




DROP FUNCTION get_player_score(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_score(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        SUM(event_player.SCORE) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = peopleId
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID
        AND event.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';

DROP FUNCTION get_player_bra_personal(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_bra_personal(peopleId INTEGER) RETURNS DECIMAL AS
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
        user_site.PEOPLE_ID = peopleId
        AND event_personal.VISIBLE=TRUE 
        AND event_personal.DELETED=FALSE
        AND event.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';




DROP FUNCTION get_player_average(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_average(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.PRIZE/(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON))
        /
        (SELECT COUNT(1) FROM event_player, event WHERE event_player.PEOPLE_ID = peopleId AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event_player.BUYIN > 0) INTO result
    FROM
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = peopleId 
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID 
        AND event_player.BUYIN > 0
        AND event.EVENT_DATE > get_resume_start_date(peopleId);

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';
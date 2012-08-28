ALTER TABLE event_personal ALTER COLUMN game_style_id DROP NOT NULL;
ALTER TABLE user_site ADD COLUMN start_bankroll DECIMAL(10, 2) DEFAULT NULL;

CREATE OR REPLACE FUNCTION get_resume_start_date(peopleId INTEGER) RETURNS DATE AS
'
DECLARE
  optionValue VARCHAR;
  result DATE;
BEGIN
	
    optionValue := (SELECT get_user_option(peopleId, ''quickResumePeriod'', ''always''));

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

DROP FUNCTION get_player_balance(peopleId INTEGER);
CREATE OR REPLACE FUNCTION get_player_balance(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
  optionValue VARCHAR;
BEGIN
	
    SELECT
        get_player_profit(peopleId)-
        get_player_bra(peopleId) INTO result;

   optionValue := (SELECT get_user_option(peopleId, ''quickResumePeriod'', ''aways''));
        
    IF result IS NULL THEN
        result := 0;
    END IF;


    RETURN result;
END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_player_start_bankroll(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COALESCE(start_bankroll, 0) INTO result
    FROM
        user_site
    WHERE
        people_id = peopleId;

   RETURN result;
END
'
LANGUAGE 'plpgsql';
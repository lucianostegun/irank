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

ALTER TABLE event_player ADD COLUMN share_id SERIAL;

ALTER TABLE event ADD COLUMN is_freeroll BOOLEAN DEFAULT FALSE;
ALTER TABLE event ADD COLUMN prize_pot DECIMAL(10,2);
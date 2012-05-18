ALTER TABLE email_marketing_people ADD COLUMN random_code VARCHAR(32);

CREATE OR REPLACE FUNCTION get_previous_player_position(rankingId INTEGER, peopleId INTEGER, rankingDate DATE) RETURNS INTEGER AS'
    DECLARE ranking_position INTEGER;
BEGIN

    SELECT
        total_ranking_position INTO ranking_position
    FROM
        ranking_history
    WHERE
        people_id = peopleId
        AND ranking_id = rankingId
        AND ranking_date < rankingDate
    ORDER BY
        ranking_date DESC LIMIT 1;

    RETURN ranking_position;
END'
LANGUAGE 'plpgsql';
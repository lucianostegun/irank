CREATE OR REPLACE FUNCTION adjust_ranking_players(rankingId INTEGER) RETURNS VOID AS
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
                       AND enabled)
    WHERE id = rankingId;

END
'
LANGUAGE 'plpgsql';
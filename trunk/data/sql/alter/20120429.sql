CREATE OR REPLACE FUNCTION update_ranking_live_players(rankingLiveId INTEGER) RETURNS VOID AS '
DECLARE
BEGIN

    UPDATE ranking_live SET players = (SELECT
                                           COUNT(1)
                                       FROM
                                           ranking_live_player
                                       WHERE
                                           ranking_live_id = rankingLiveId
                                           AND enabled
                                           AND total_events > 0) WHERE id = rankingLiveId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_ranking_live_events(rankingLiveId INTEGER) RETURNS VOID AS '
DECLARE
BEGIN

    UPDATE ranking_live SET events = (SELECT
                                           COUNT(1)
                                       FROM
                                           event_live
                                       WHERE
                                           ranking_live_id = rankingLiveId
                                           AND enabled
                                           AND visible
                                           AND NOT deleted
                                           AND saved_result) WHERE id = rankingLiveId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_ranking_live_total_prize(rankingLiveId INTEGER) RETURNS DECIMAL(10, 2) AS '
DECLARE
    totalPrize DECIMAL(10, 2);
BEGIN

    SELECT
       SUM(prize) INTO totalPrize
   FROM
       event_live_player
       INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
   WHERE
       event_live.RANKING_LIVE_ID = rankingLiveId
       AND event_live.ENABLED
       AND event_live.VISIBLE
       AND NOT event_live.DELETED
       AND event_live.SAVED_RESULT;

   RETURN totalPrize;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION is_ranking_live_player(rankingLiveId INTEGER, peopleId INTEGER) RETURNS BOOLEAN AS '
DECLARE
    events INTEGER;
BEGIN

    SELECT
        total_events INTO events
    FROM
        ranking_live_player
    WHERE
        ranking_live_id = rankingLiveId
        AND people_id = peopleId;

    RETURN events > 0;

END'
LANGUAGE 'plpgsql';
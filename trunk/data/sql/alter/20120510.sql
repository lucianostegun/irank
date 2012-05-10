CREATE OR REPLACE FUNCTION has_previous_pending_results(eventLiveId INTEGER) RETURNS BOOLEAN AS '
DECLARE
    hasPendingResults BOOLEAN;
    eventDateTime TIMESTAMP;
    rankingLiveId INTEGER;
BEGIN
    
    SELECT
        event_date_time,
        ranking_live_id INTO eventDateTime, rankingLiveId
    FROM
        event_live
    WHERE
        id = eventLiveId;

    SELECT
        (COUNT(1) > 0) INTO hasPendingResults
    FROM
        event_live
    WHERE
        enabled
        AND visible
        AND NOT deleted
        AND NOT saved_result
        AND event_date_time < eventDateTime
        AND ranking_live_id IS NOT NULL
        AND ranking_live_id = rankingLiveId
        AND id <> eventLiveId;

    RETURN hasPendingResults;

END'
LANGUAGE 'plpgsql';
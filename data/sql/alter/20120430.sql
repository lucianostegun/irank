CREATE FUNCTION get_ranking_live_date_list(INTEGER, BOOLEAN) RETURNS SETOF DATE AS '
    
    SELECT 
        DISTINCT ranking_date 
    FROM 
        ranking_live_history 
        INNER JOIN event_live ON event_live.EVENT_DATE=ranking_live_history.RANKING_DATE 
    WHERE 
        event_live.RANKING_LIVE_ID = $1
        AND ((event_live.ENABLED AND event_live.VISIBLE AND NOT event_live.DELETED) OR $2)
        AND event_live.SAVED_RESULT 
    ORDER BY 
        ranking_date DESC;
'
LANGUAGE 'sql';

CREATE TABLE irank_ranking (
    people_id INTEGER NOT NULL PRIMARY KEY,
    score DECIMAL(10,3),
    events INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT irank_ranking_FK_1 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE OR REPLACE FUNCTION update_irank_ranking_players() RETURNS VOID AS '
DECLARE
BEGIN

    INSERT INTO irank_ranking
        (SELECT 
             DISTINCT people.ID, 0, 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP 
         FROM 
             people
             INNER JOIN event_live_player ON event_live_player.PEOPLE_ID=people.ID
             INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
             LEFT JOIN irank_ranking ON irank_ranking.PEOPLE_ID=people.ID
         WHERE
             event_live.ENABLED
             AND event_live.VISIBLE
             AND NOT event_live.DELETED
             AND event_live.SAVED_RESULT
             AND event_live_player.ENABLED
             AND event_live_player.EVENT_POSITION > 0
             AND irank_ranking.PEOPLE_ID IS NULL);

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_irank_ranking_score(peopleId INTEGER) RETURNS DECIMAL(10, 3) AS '
DECLARE
    totalScore DECIMAL(10, 3);
BEGIN

    SELECT
        SUM(event_live.PLAYERS-(event_live_player.EVENT_POSITION-1))*3 INTO totalScore
    FROM 
        event_live_player
        INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
    WHERE
        event_live.ENABLED
        AND event_live.VISIBLE
        AND NOT event_live.DELETED
        AND event_live.SAVED_RESULT
        AND event_live_player.ENABLED
        AND event_live_player.EVENT_POSITION > 0
        AND event_live_player.PEOPLE_ID = peopleId;
    
    RETURN totalScore;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_irank_ranking_events(peopleId INTEGER) RETURNS DECIMAL(10, 3) AS '
DECLARE
    totalEvents DECIMAL(10, 3);
BEGIN

    SELECT
        COUNT(DISTINCT event_live.ID) INTO totalEvents
    FROM 
        event_live_player
        INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
    WHERE
        event_live.ENABLED
        AND event_live.VISIBLE
        AND NOT event_live.DELETED
        AND event_live.SAVED_RESULT
        AND event_live_player.ENABLED
        AND event_live_player.EVENT_POSITION > 0
        AND event_live_player.PEOPLE_ID = peopleId;
    
    RETURN totalEvents;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_irank_ranking() RETURNS VOID AS '
DECLARE
BEGIN

    SELECT update_irank_ranking_players();

    UPDATE 
        irank_ranking 
    SET 
        score = get_irank_ranking_score(irank_ranking.PEOPLE_ID),
        score = get_irank_ranking_events(irank_ranking.PEOPLE_ID);
END'
LANGUAGE 'plpgsql';







delete FROM irank_ranking;
SELECT * FROM irank_ranking;
select update_irank_ranking_players();
select get_irank_ranking_score(1);
select get_irank_ranking_events(1);




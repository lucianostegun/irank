ALTER TABLE event_player ADD COLUMN score FLOAT DEFAULT 0;

UPDATE
    event_player
SET
    score = (SELECT SUM(buyin+rebuy+addon) FROM event_player ep WHERE ep.EVENT_ID = event_player.EVENT_ID) / event_position / buyin
WHERE
    buyin > 0
    AND event_position > 0;

ALTER TABLE event_player ALTER COLUMN score TYPE DECIMAL(10,3);
ALTER TABLE ranking_player ALTER COLUMN total_score TYPE DECIMAL(10,3);
ALTER TABLE ranking_history ALTER COLUMN score TYPE DECIMAL(10,3);
ALTER TABLE ranking_history ALTER COLUMN total_score TYPE DECIMAL(10,3);


UPDATE 
    ranking_history
SET
    score = (SELECT 
                SUM(score) 
             FROM 
                event_player
                INNER JOIN event ON event_player.EVENT_ID = event.ID
             WHERE
                people_id = ranking_history.PEOPLE_ID
                AND event.RANKING_ID = ranking_history.RANKING_ID
                AND event.EVENT_DATE = ranking_history.RANKING_DATE),
    total_score = (SELECT 
                      SUM(score) 
                   FROM 
                      event_player
                      INNER JOIN event ON event_player.EVENT_ID = event.ID
                   WHERE
                      people_id = ranking_history.PEOPLE_ID
                      AND event.RANKING_ID = ranking_history.RANKING_ID
                      AND event.EVENT_DATE <= ranking_history.RANKING_DATE);

UPDATE ranking_player SET total_score = (SELECT SUM(score) FROM ranking_history WHERE ranking_id = ranking_player.RANKING_ID AND people_id = ranking_player.PEOPLE_ID);
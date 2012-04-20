CREATE TABLE ranking_live_player ( 
    ranking_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    total_events INTEGER,
    total_score DECIMAL(10,3),
    total_balance	DECIMAL(10, 2),
    total_prize DECIMAL(10, 2),
    total_paid DECIMAL(10, 2),
    total_average DECIMAL(10,3),
    enabled BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_live_id, people_id),
    CONSTRAINT ranking_live_player_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id),
    CONSTRAINT ranking_live_player_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE TABLE ranking_live_history ( 
    ranking_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    ranking_date DATE NOT NULL,
    ranking_position INTEGER NOT NULL DEFAULT 0,
    events INTEGER NOT NULL DEFAULT 0,
    score DECIMAL(10,3) NOT NULL DEFAULT 0,
    balance_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    prize_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    paid_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    average DECIMAL(10,3) NOT NULL DEFAULT 0,
    total_ranking_position	INTEGER NOT NULL DEFAULT 0,
    total_events INTEGER NOT NULL DEFAULT 0,
    total_score DECIMAL(10,3) NOT NULL DEFAULT 0,
    total_balance DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_prize DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_paid DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_average DECIMAL(10,3) NOT NULL DEFAULT 0,
    enabled BOOLEAN NOT NULL DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_date, ranking_live_id, people_id),
    CONSTRAINT ranking_live_history_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id),
    CONSTRAINT ranking_live_history_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE ranking_history DROP CONSTRAINT ranking_member_fk_1;
ALTER TABLE ranking_history DROP CONSTRAINT ranking_member_fk_2;
ALTER TABLE ranking_history ADD CONSTRAINT ranking_history_fk_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id);
ALTER TABLE ranking_history ADD CONSTRAINT ranking_history_fk_2 FOREIGN KEY (people_id) REFERENCES people (id);

DELETE FROM ranking_live_player;
INSERT INTO ranking_live_player(ranking_live_id, people_id, total_events, total_score, total_balance, total_prize, total_average, total_paid, enabled, created_at, updated_at)
    (SELECT ranking_live_id, people_id, COUNT(1), 0, 0, 0, 0, 0, event_live_player.ENABLED, MIN(event_live_player.CREATED_AT), MIN(event_live_player.UPDATED_AT) FROM event_live_player INNER JOIN event_live ON event_live.ID=event_live_player.EVENT_LIVE_ID WHERE ranking_live_id IS NOT NULL GROUP BY ranking_live_id, people_id, event_live_player.ENABLED, event_live_player.CREATED_AT, event_live_player.UPDATED_AT);


ALTER TABLE event_live_player ADD COLUMN buyin DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN rebuy DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN addon DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN deleted BOOLEAN NULL DEFAULT false;
ALTER TABLE event_live_player ADD COLUMN entrance_fee DECIMAL(10,2) NULL DEFAULT 0;


CREATE OR REPLACE FUNCTION update_ranking_live_player_events(rankingLiveId INTEGER) RETURNS INTEGER AS '
BEGIN

    UPDATE 
        ranking_live_player
    SET 
        total_events = (SELECT 
                            COUNT(1) 
                        FROM 
                            event_live_player
                            INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
                        WHERE
                            event_live.RANKING_LIVE_ID=rankingLiveId
                            AND event_live_player.ENABLED = true
                            AND event_live.RANKING_LIVE_ID=ranking_live_player.RANKING_LIVE_ID
                            AND event_live_player.PEOPLE_ID=ranking_live_player.PEOPLE_ID
                            AND NOT event_live.DELETED
                            AND event_live.VISIBLE
                            AND event_live.ENABLED
                        	AND event_live.SAVED_RESULT = TRUE);

  RETURN 0;
END'
LANGUAGE plpgsql;
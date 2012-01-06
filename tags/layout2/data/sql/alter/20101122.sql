ALTER TABLE ranking RENAME COLUMN members TO players;
ALTER TABLE event RENAME COLUMN members TO players;

CREATE TABLE event_player ( 
    event_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    buyin FLOAT DEFAULT 0,
    rebuy FLOAT DEFAULT 0,
    addon FLOAT DEFAULT 0,
    event_position INTEGER DEFAULT 0,
    prize FLOAT DEFAULT 0,
    enabled BOOLEAN DEFAULT false,
    deleted BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(event_id, people_id),
    CONSTRAINT event_player_FK_1 FOREIGN KEY(event_id) REFERENCES event(id),
    CONSTRAINT event_player_FK_2 FOREIGN KEY(people_id) REFERENCES people(id)
);

CREATE TABLE ranking_player ( 
    ranking_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    events INTEGER DEFAULT 0,
    score FLOAT DEFAULT 0,
    balance FLOAT DEFAULT 0,
    total_prize FLOAT DEFAULT 0,
    total_paid FLOAT DEFAULT 0,
    enabled BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_id,people_id),
    CONSTRAINT ranking_player_FK_1 FOREIGN KEY(ranking_id) REFERENCES ranking(id),
    CONSTRAINT ranking_player_FK_2 FOREIGN KEY(people_id) REFERENCES people(id)
);

INSERT INTO event_player (SELECT event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, false, created_at, updated_at FROM event_member);
INSERT INTO ranking_player (SELECT ranking_id, people_id, events, score, balance, total_prize, total_paid, enabled, created_at, updated_at FROM ranking_member);

DROP TABLE event_member;
DROP TABLE ranking_member;
ALTER TABLE ranking ADD COLUMN ranking_tag VARCHAR(20);

CREATE TABLE event_prize_config (
    event_id INTEGER NOT NULL,
    event_position INTEGER NOT NULL,
    prize_value DECIMAL(10,2),
    PRIMARY KEY(event_id, event_position),
    CONSTRAINT event_prize_config_FK_1 FOREIGN KEY(event_id) REFERENCES event (id)
);
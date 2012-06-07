ALTER TABLE event_live ADD COLUMN suppress_ranking BOOLEAN DEFAULT FALSE;

CREATE TABLE event_live_schedule (
    event_live_id INTEGER NOT NULL PRIMARY KEY,
    event_date DATE,
    start_time TIME,
    event_date_time TIMESTAMP,
    days_after INTEGER,
    step_day VARCHAR(10),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_live_schedule_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id)
);

ALTER TABLE event_live DROP COLUMN step_day;
ALTER TABLE event_live ADD COLUMN guaranteed_prize DECIMAL(10, 2);
ALTER TABLE ranking_live ADD COLUMN guaranteed_prize DECIMAL(10, 2);


ALTER TABLE event_live ADD COLUMN is_multiday BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_live ADD COLUMN is_multiday BOOLEAN DEFAULT FALSE;
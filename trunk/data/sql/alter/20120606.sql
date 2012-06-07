DROP TABLE event_live_schedule;

CREATE TABLE event_live_schedule (
    event_live_id INTEGER NOT NULL,
    event_date DATE,
    start_time TIME,
    event_date_time TIMESTAMP,
    days_after INTEGER,
    step_day VARCHAR(10),
    created_at TIMESTAMP,
    PRIMARY KEY(event_live_id, event_date, start_time),
    CONSTRAINT event_live_schedule_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id)
);

CREATE TABLE ranking_live_template (
    ranking_live_id INTEGER NOT NULL,
    days_after INTEGER,
    start_time TIME,
    step_day VARCHAR(10),
    created_at TIMESTAMP,
    PRIMARY KEY(ranking_live_id, days_after, start_time),
    CONSTRAINT ranking_live_template_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id)
);
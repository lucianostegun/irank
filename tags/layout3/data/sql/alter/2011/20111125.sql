ALTER TABLE event ADD COLUMN event_date_time TIMESTAMP;

UPDATE event SET event_date_time = CAST(to_char(event_date, 'YYYY-MM-DD')||' '||to_char(start_time, 'HH:MI:SS') AS TIMESTAMP);
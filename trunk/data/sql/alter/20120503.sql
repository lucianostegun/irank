ALTER TABLE event_live_player ADD COLUMN email_sent_date TIMESTAMP;
ALTER TABLE event_live_player ADD COLUMN email_read_date TIMESTAMP;

SELECT * FROM event_live;
SELECT * FROM event_live_player;
ALTER TABLE event_live ADD COLUMN rake_percent DECIMAL(5,2);
ALTER TABLE event_live ADD COLUMN total_rebuys DECIMAL(10,2);
ALTER TABLE event_live ADD COLUMN prize_split VARCHAR(50);
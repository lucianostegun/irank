ALTER TABLE ranking_live ADD COLUMN no_ranking BOOLEAN DEFAULT FALSE;

ALTER TABLE ranking_live_template ADD COLUMN is_satellite BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live_schedule ADD COLUMN is_satellite BOOLEAN DEFAULT FALSE;
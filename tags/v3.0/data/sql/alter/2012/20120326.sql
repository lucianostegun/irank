UPDATE club SET file_name_logo = REPLACE(file_name_logo, '.jpg', '.png');

ALTER TABLE event_live_player ADD COLUMN event_position INTEGER DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN prize DECIMAL(10, 2) DEFAULT 0;

ALTER TABLE event_live ADD COLUMN saved_result BOOLEAN DEFAULT FALSE;
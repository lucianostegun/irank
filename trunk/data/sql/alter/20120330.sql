ALTER TABLE event_live RENAME COLUMN event_datetime TO event_date_time;
ALTER TABLE event_live ADD COLUMN is_freeroll BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN entrance_fee DECIMAL(10, 2) DEFAULT 0;
ALTER TABLE event_live ADD COLUMN comments VARCHAR(250);
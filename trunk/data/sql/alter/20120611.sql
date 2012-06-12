ALTER TABLE ranking_live ADD COLUMN start_time_satellite TIME;
ALTER TABLE ranking_live ADD COLUMN buyin_satellite DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN entrance_fee_satellite DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN is_freeroll_satellite BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_live ADD COLUMN blind_time_satellite TIME;
ALTER TABLE ranking_live ADD COLUMN guaranteed_prize_satellite DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN stack_chips_satellite DECIMAL(10,2) DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN allowed_rebuys_satellite INTEGER DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN allowed_addons_satellite INTEGER DEFAULT 0;
ALTER TABLE ranking_live ADD COLUMN is_ilimited_rebuys_satellite BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_live ADD COLUMN tables_number_satellite INTEGER;

ALTER TABLE event_live ADD COLUMN is_satellite BOOLEAN DEFAULT FALSE;
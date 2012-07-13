ALTER TABLE event_live ADD COLUMN publish_prize BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_live ADD COLUMN publish_prize BOOLEAN DEFAULT FALSE;
ALTER TABLE ranking_live ADD COLUMN rake_percent DECIMAL(5,2);
ALTER TABLE ranking_live ADD COLUMN prize_split VARCHAR(50);


ALTER TABLE ranking_live RENAME COLUMN default_buyin TO buyin;
ALTER TABLE ranking_live RENAME COLUMN default_entrance_fee TO entrance_fee;
ALTER TABLE ranking_live RENAME COLUMN default_start_time TO start_time;
ALTER TABLE ranking_live RENAME COLUMN default_is_freeroll TO is_freeroll;
ALTER TABLE ranking_live RENAME COLUMN default_blind_time TO blind_time;
ALTER TABLE ranking_live RENAME COLUMN default_stack_chips TO stack_chips;
ALTER TABLE ranking_live RENAME COLUMN default_allowed_rebuys TO allowed_rebuys;
ALTER TABLE ranking_live RENAME COLUMN default_allowed_addons TO allowed_addons;
ALTER TABLE ranking_live RENAME COLUMN default_is_ilimited_rebuys TO is_ilimited_rebuys;

ALTER TABLE ranking RENAME COLUMN default_buyin TO buyin;

ALTER TABLE event_live ADD COLUMN visit_count INTEGER DEFAULT 0;
ALTER TABLE club ADD COLUMN visit_count INTEGER DEFAULT 0;

CREATE OR REPLACE FUNCTION update_club_visit_count(clubId INTEGER) RETURNS VOID AS
'
DECLARE
BEGIN

    UPDATE club SET visit_count = visit_count+1 WHERE id = clubId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_event_live_visit_count(eventLiveId INTEGER) RETURNS VOID AS 
'
BEGIN

    UPDATE event_live SET visit_count = visit_count+1 WHERE id = eventLiveId;

END'
LANGUAGE 'plpgsql';
CREATE TABLE club_player (
    club_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    created_at TIMESTAMP,
    PRIMARY KEY(club_id, people_id),
    CONSTRAINT club_player_FK_1 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT club_player_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE event_live ADD COLUMN enrollment_mode VARCHAR(15) DEFAULT 'enrollment';
ALTER TABLE event_live_player ADD COLUMN enrollment_status VARCHAR(10) DEFAULT 'enrolled';



CREATE OR REPLACE FUNCTION get_event_live_players(eventLiveId INTEGER) RETURNS INTEGER AS
'
DECLARE
    result INTEGER;
BEGIN
	
    SELECT
       COALESCE(null, COUNT(1)) INTO result
   FROM
       event_live_player
   WHERE
       event_live_player.EVENT_LIVE_ID = eventLiveId
       AND (enabled OR enrollment_status IN (''enrolled'', ''confirmed''));

   RETURN result;

END
'
LANGUAGE 'plpgsql';



CREATE OR REPLACE FUNCTION get_event_live_players(eventLiveId INTEGER, isEnabled BOOLEAN) RETURNS INTEGER AS
'
DECLARE
    result INTEGER;
BEGIN
	
    SELECT
       COALESCE(null, COUNT(1)) INTO result
   FROM
       event_live_player
   WHERE
       event_live_player.EVENT_LIVE_ID = eventLiveId
       AND enabled = isEnabled;

   RETURN result;

END
'
LANGUAGE 'plpgsql';
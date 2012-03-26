CREATE TABLE event_live_player (
    event_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    enabled BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(event_live_id, people_id),
    CONSTRAINT ranking_live_player_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id),
    CONSTRAINT ranking_live_player_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE OR REPLACE FUNCTION get_event_live_players(eventLiveId INTEGER) RETURNS INTEGER AS
'
DECLARE
    result INTEGER;
BEGIN
	
    SELECT
       COUNT(1) INTO result
   FROM
       event_live_player
   WHERE
       event_live_player.EVENT_LIVE_ID = eventLiveId
       AND enabled;

   RETURN result;

END
'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_event_live_players(eventLiveId INTEGER) RETURNS VOID AS
'
DECLARE
BEGIN
	
    UPDATE
        event_live
    SET
        players = get_event_live_players(eventLiveId)
    WHERE
        id = eventLiveId;

END
'
LANGUAGE 'plpgsql';

ALTER TABLE club ADD COLUMN description TEXT;
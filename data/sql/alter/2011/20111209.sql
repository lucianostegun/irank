ALTER TABLE event_prize_config ADD COLUMN is_percent BOOLEAN;

CREATE OR REPLACE FUNCTION adjust_event_players(eventId INTEGER) RETURNS VOID AS
'
DECLARE
BEGIN
	
    UPDATE
        event
    SET
        players = (SELECT
                       COUNT(1)
                   FROM
                       event_player
                   WHERE
                       event_player.EVENT_ID = event.ID
                       AND enabled)
    WHERE id = eventId;

END
'
LANGUAGE 'plpgsql';
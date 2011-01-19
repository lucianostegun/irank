ALTER TABLE event_player ADD COLUMN invite_status VARCHAR(5) DEFAULT 'none';

UPDATE event_player SET invite_status = NULL;
UPDATE event_player SET invite_status = 'yes' WHERE enabled = true;
UPDATE event_player SET invite_status = 'no' WHERE enabled = false AND event_id IN (SELECT id FROM event WHERE event_date < CURRENT_DATE);
UPDATE event_player SET invite_status = 'none' WHERE invite_status IS NULL;
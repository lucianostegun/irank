ALTER TABLE event_live ADD COLUMN is_ilimited_rebuys BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN enabled BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN visible BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN locked BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN deleted BOOLEAN DEFAULT FALSE;

UPDATE event_live SET enabled=TRUE, visible=TRUE, deleted=false;
ALTER TABLE event_live ALTER COLUMN ranking_live_id DROP NOT NULL;

ALTER TABLE event_live ALTER COLUMN allowed_rebuys SET DEFAULT 0;
ALTER TABLE event_live ALTER COLUMN allowed_addons SET DEFAULT 0;
ALTER TABLE event_live ALTER COLUMN players SET DEFAULT 0;
ALTER TABLE event_live RENAME COLUMN event_time TO start_time;

ALTER TABLE ranking_live ALTER COLUMN events SET DEFAULT 0;
ALTER TABLE ranking_live ALTER COLUMN players SET DEFAULT 0;

UPDATE event_live SET players = 0;

ALTER TABLE user_admin ADD COLUMN club_id INTEGER;
ALTER TABLE user_admin ADD CONSTRAINT user_site_FK_2 FOREIGN KEY (club_id) REFERENCES club (id);

CREATE TABLE club_ranking_live (
    club_id INTEGER NOT NULL,
    ranking_live_id INTEGER NOT NULL,
    enabled BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(club_id, ranking_live_id),
    CONSTRAINT club_ranking_live_FK_1 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT club_ranking_live_FK_2 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id)
);

CREATE OR REPLACE FUNCTION get_club_ranking_count(clubId INTEGER) RETURNS INTEGER AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COUNT(1) INTO result
    FROM
        club_ranking_live
        INNER JOIN ranking_live ON club_ranking_live.RANKING_LIVE_ID=ranking_live.ID
    WHERE
        ranking_live.VISIBLE
        AND ranking_live.ENABLED
        AND NOT ranking_live.DELETED
        AND club_ranking_live.CLUB_ID = clubId
        AND club_ranking_live.ENABLED;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';
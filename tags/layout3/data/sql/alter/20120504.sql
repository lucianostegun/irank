/*
ATENCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAO
Executar esses comandos no banco de logs

CREATE SEQUENCE email_log_seq;
ALTER TABLE email_log ADD COLUMN id INTEGER NOT NULL DEFAULT nextval('email_log_seq'::regclass);
ALTER TABLE email_log ADD COLUMN error_message VARCHAR(500);
ALTER TABLE email_log RENAME COLUMN updated_at TO read_at;
UPDATE email_log SET read_at = NULL;
*/

ALTER TABLE event_live_player DROP COLUMN email_sent_date;
ALTER TABLE event_live_player DROP COLUMN email_read_date;

CREATE TABLE event_live_player_disclosure (
    event_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    email_log_id INTEGER,
    created_at TIMESTAMP,
    PRIMARY KEY(event_live_id, people_id),
    CONSTRAINT event_live_player_disclosure_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id),
    CONSTRAINT event_live_player_disclosure_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE OR REPLACE FUNCTION update_ranking_live_visit_count(rankingLiveId INTEGER) RETURNS VOID AS 
'
BEGIN

    UPDATE event_live SET visit_count = visit_count+1 WHERE ranking_live_id = rankingLiveId AND NOT saved_result;

END'
LANGUAGE 'plpgsql';
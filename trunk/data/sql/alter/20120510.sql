CREATE OR REPLACE FUNCTION has_previous_pending_results(eventLiveId INTEGER) RETURNS BOOLEAN AS '
DECLARE
    hasPendingResults BOOLEAN;
    eventDateTime TIMESTAMP;
    rankingLiveId INTEGER;
BEGIN
    
    SELECT
        event_date_time,
        ranking_live_id INTO eventDateTime, rankingLiveId
    FROM
        event_live
    WHERE
        id = eventLiveId;

    SELECT
        (COUNT(1) > 0) INTO hasPendingResults
    FROM
        event_live
    WHERE
        enabled
        AND visible
        AND NOT deleted
        AND NOT saved_result
        AND event_date_time < eventDateTime
        AND ranking_live_id IS NOT NULL
        AND ranking_live_id = rankingLiveId
        AND id <> eventLiveId;

    RETURN hasPendingResults;

END'
LANGUAGE 'plpgsql';

CREATE SEQUENCE cash_table_seq;
CREATE TABLE cash_table (
    id INTEGER NOT NULL DEFAULT nextval('cash_table_seq'::regclass) PRIMARY KEY,
    club_id INTEGER,
    cash_table_name VARCHAR(32),
    table_status VARCHAR(10) DEFAULT 'closed',
    players INTEGER DEFAULT 0,
    seats SMALLINT,
    entrance_fee DECIMAL(10,2),
    buyin DECIMAL(10,2),
    comments TEXT,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    locked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT cash_table_FK_1 FOREIGN KEY (club_id) REFERENCES club (id)
);
LANGUAGE 'plpgsql';

INSERT INTO settings VALUES(nextval('settings_seq'), 'facebookTemplate', 'Texto padrão Facebook', 'Texto padrão para divulgação no Facebook.', '<eventName>. Disponível em <eventUrl>', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO settings VALUES(nextval('settings_seq'), 'twitterTemplate', 'Texto padrão Twitter', 'Texto padrão para divulgação no Twitter.', '<eventName>. Disponível em <eventUrl>', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
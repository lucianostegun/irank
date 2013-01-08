DROP TABLE event_live_player_disclosure;
CREATE TABLE event_live_player_disclosure_email (
    event_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    email_log_id INTEGER,
    created_at TIMESTAMP,
    PRIMARY KEY(event_live_id, people_id),
    CONSTRAINT event_live_player_disclosure_email_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id),
    CONSTRAINT event_live_player_disclosure_email_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE SEQUENCE sms_seq;
CREATE TABLE sms (
    id INTEGER NOT NULL DEFAULT nextval('sms_seq'::regclass) PRIMARY KEY,
    club_id INTEGER,
    people_id INTEGER NOT NULL,
    token CHAR(32),
    text_message VARCHAR(240),
    total_messages INTEGER DEFAULT 0,
    success_messages INTEGER DEFAULT 0,
    error_messages INTEGER DEFAULT 0,
    class_name VARCHAR(32),
    object_id INTEGER,
    created_at TIMESTAMP,
    CONSTRAINT sms_FK_1 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT sms_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE TABLE event_live_player_disclosure_sms (
    event_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    sms_id INTEGER NOT NULL,
    sms_log_id INTEGER,
    created_at TIMESTAMP,
    PRIMARY KEY(event_live_id, people_id),
    CONSTRAINT event_live_player_disclosure_sms_FK_1 FOREIGN KEY (event_live_id) REFERENCES event_live (id),
    CONSTRAINT event_live_player_disclosure_sms_FK_2 FOREIGN KEY (people_id) REFERENCES people (id),
    CONSTRAINT event_live_player_disclosure_sms_FK_3 FOREIGN KEY (sms_id) REFERENCES sms (id)
);

ALTER TABLE club ADD COLUMN sms_credit INTEGER DEFAULT 0;


CREATE OR REPLACE FUNCTION check_club_sms_credit(clubId INTEGER) RETURNS BOOLEAN AS
'
DECLARE
    smsCredit INTEGER;
BEGIN
	
    SELECT
        sms_credit INTO smsCredit
    FROM
        club
    WHERE
        id = clubId;

   RETURN (smsCredit > 0);

END
'
LANGUAGE 'plpgsql';

INSERT INTO config(config_name, description, config_value, created_at, updated_at) VALUES
    ('smsCredit', 'Créditos para envio de SMS', '208', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('smsMobileProntoKey', 'Chave para envio de SMS', 'DCCAB0FB6DD94F5992A4E2E3C903E3568BD107C9', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE OR REPLACE FUNCTION check_admin_sms_credit() RETURNS BOOLEAN AS
'
DECLARE
    smsCredit INTEGER;
BEGIN
	
    SELECT
        CAST(config_value AS INTEGER) INTO smsCredit
    FROM
        config
    WHERE
        config_name = ''smsCredit'';

   RETURN (smsCredit > 0);

END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION decrase_club_sms_credit(clubId INTEGER, decraseAdmin BOOLEAN) RETURNS VOID AS
'
DECLARE
BEGIN
	
    UPDATE club SET sms_credit=sms_credit-1 WHERE id = clubId;

    IF decraseAdmin THEN
        PERFORM decrase_admin_sms_credit();
    END IF;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION decrase_admin_sms_credit() RETURNS VOID AS
'
DECLARE
BEGIN
	
    UPDATE config SET config_value = CAST(CAST(config_value AS INTEGER)-1 AS VARCHAR) WHERE config_name = ''smsCredit'';
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION validate_sms_token(clubId INTEGER, peopleId INTEGER, smsId INTEGER, pToken VARCHAR, className VARCHAR, objectId INTEGER) RETURNS BOOLEAN AS
'
DECLARE
    smsIdCheck INTEGER;
BEGIN
	
    SELECT
        id INTO smsIdCheck
    FROM
        sms
    WHERE
        id = smsId
        AND (club_id = clubId OR club_id IS NULL)
        AND people_id = peopleId
        AND token = pToken
        AND class_name = className
        AND object_id = objectId;
    
    RETURN smsIdCheck IS NOT NULL;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_sms_credit() RETURNS INTEGER AS
'
DECLARE
    smsCredit INTEGER;
BEGIN
	
    SELECT CAST(config_value AS INTEGER) INTO smsCredit FROM config WHERE config_name = ''smsCredit'';
    
    RETURN smsCredit;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_sms_credit(clubId INTEGER) RETURNS INTEGER AS
'
DECLARE
    smsCredit INTEGER;
BEGIN
	
    SELECT sms_credit INTO smsCredit FROM club WHERE id = clubId;
    
    RETURN smsCredit;
END
'
LANGUAGE 'plpgsql';
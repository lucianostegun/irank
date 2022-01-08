CREATE SEQUENCE news_seq;
CREATE TABLE news (
    id INTEGER NOT NULL DEFAULT nextval('news_seq'::regclass) PRIMARY KEY,
    news_date DATE,
    news_title VARCHAR(150),
    internal_link VARCHAR(150),
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP
);

CREATE TABLE news_i18n (
    news_id INTEGER NOT NULL,
    culture CHAR(5),
    news_title_i18n VARCHAR(150),
    description_i18n VARCHAR(1000),
    PRIMARY KEY(news_id, culture),
    CONSTRAINT news_i18n_FK_1 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE
);


INSERT INTO news(news_date, news_title, internal_link, created_at, updated_at)
    VALUES('2011-03-23', 'Novo controle de eventos pessoais', '/eventPersonal', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO news_i18n VALUES((SELECT MAX(id) FROM news), 'pt_BR', 'Novo controle de eventos pessoais', '');
INSERT INTO news_i18n VALUES((SELECT MAX(id) FROM news), 'en_US', 'New personal event control', '');


INSERT INTO news(news_date, news_title, internal_link, created_at, updated_at)
    VALUES('2011-05-07', 'Inclusão da Taxa de entrada nos eventos', '/event', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO news_i18n VALUES((SELECT MAX(id) FROM news), 'pt_BR', 'Inclusão da Taxa de entrada nos eventos', '');
INSERT INTO news_i18n VALUES((SELECT MAX(id) FROM news), 'en_US', 'Included new event field "Entrance fee"', '');

ALTER TABLE event_player ADD COLUMN entrance_fee DECIMAL(10,2) DEFAULT 0;


CREATE OR REPLACE FUNCTION get_player_bra(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON)+get_player_bra_personal(p_people_id) INTO result
    FROM 
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_player_average(p_people_id INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT 
        SUM(event_player.PRIZE/(event_player.ENTRANCE_FEE+event_player.BUYIN+event_player.REBUY+event_player.ADDON))
        /
        (SELECT COUNT(1) FROM event_player, event WHERE event_player.PEOPLE_ID = p_people_id AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event_player.BUYIN > 0) INTO result
    FROM
        event_player, event 
    WHERE 
        event_player.PEOPLE_ID = p_people_id 
        AND event.VISIBLE=TRUE 
        AND event.DELETED=FALSE 
        AND event.SAVED_RESULT=TRUE 
        AND event_player.EVENT_ID=event.ID 
        AND event_player.BUYIN > 0;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';
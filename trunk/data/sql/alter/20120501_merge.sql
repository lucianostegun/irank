CREATE SEQUENCE event_photo_contest_seq;
CREATE TABLE event_photo_contest (
    id INTEGER NOT NULL DEFAULT nextval('event_photo_contest'::regclass) PRIMARY KEY,
    event_photo_id_left INTEGER NOT NULL,
    event_photo_id_right INTEGER NOT NULL,
    event_photo_id_winner INTEGER,
    lock_key VARCHAR(32),
    ip_address INET,
    is_reported BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_photo_contest_FK_1 FOREIGN KEY (event_photo_id_left) REFERENCES event_photo (id),
    CONSTRAINT event_photo_contest_FK_2 FOREIGN KEY (event_photo_id_right) REFERENCES event_photo (id),
    CONSTRAINT event_photo_contest_FK_3 FOREIGN KEY (event_photo_id_winner) REFERENCES event_photo (id)
);

CREATE OR REPLACE FUNCTION get_event_count(peopleId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COUNT(1) INTO result
    FROM 
        event 
        INNER JOIN event_player ON event_player.EVENT_ID=event.ID
    WHERE 
        event_player.PEOPLE_ID = peopleId
        AND event_player.ENABLED
        AND NOT event_player.DELETED
        AND event.ENABLED
        AND event.VISIBLE
        AND NOT event.DELETED;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION get_event_personal_count(userSiteId INTEGER) RETURNS DECIMAL AS
'
DECLARE
  result DECIMAL;
BEGIN
	
    SELECT
        COUNT(1) INTO result
    FROM 
        event_personal 
    WHERE 
        user_site_id = userSiteId
        AND enabled 
        AND visible 
        AND NOT deleted;

   IF result IS NULL THEN
     result := 0;
   END IF;

   RETURN result;
END
'
LANGUAGE 'plpgsql';

CREATE SEQUENCE state_seq;
CREATE TABLE state ( 
    id INTEGER NOT NULL DEFAULT nextval('state_seq'::regclass) PRIMARY KEY,
    initial CHAR(2),
    description VARCHAR(50),
    order_seq INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


CREATE SEQUENCE city_seq;
CREATE TABLE city ( 
    id INTEGER NOT NULL DEFAULT nextval('city_seq'::regclass) PRIMARY KEY,
    state_id INTEGER,
    description VARCHAR(60),
    order_seq INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT city_FK_1 FOREIGN KEY(state_id) REFERENCES state (id)
);


INSERT INTO state(id, initial, description, order_seq, created_at, updated_at) VALUES
(1, 'AC', 'Acre', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, 'AL', 'Alagoas', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, 'AP', 'Amapá', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, 'AM', 'Amazonas', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, 'BA', 'Bahia', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, 'CE', 'Ceará', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(7, 'DF', 'Distrito Federal', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(8, 'GO', 'Goiás', 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(9, 'ES', 'Espírito Santo', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(10, 'MA', 'Maranhão', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(11, 'MT', 'Mato Grosso', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(12, 'MS', 'Mato Grosso do Sul', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(13, 'MG', 'Minas Gerais', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(14, 'PA', 'Pará', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(15, 'PB', 'Paraíba', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(16, 'PR', 'Paraná', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(17, 'PE', 'Pernambuco', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(18, 'PI', 'Piauí', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(19, 'RJ', 'Rio de Janeiro', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(20, 'RN', 'Rio Grande do Norte', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(21, 'RS', 'Rio Grande do Sul', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(22, 'RO', 'Rondônia', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(23, 'RR', 'Roraima', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(24, 'SP', 'São Paulo', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(25, 'SC', 'Santa Catarina', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(26, 'SE', 'Sergipe', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(27, 'TO', 'Tocantins', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



INSERT INTO city(state_id, description, order_seq, created_at, updated_at) VALUES
((SELECT id FROM state WHERE initial = 'SP'), 'São Paulo', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'SP'), 'São José do Rio Preto', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'RJ'), 'Rio de Janeiro', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'PR'), 'Curitiba', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'GO'), 'Goiânia', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



CREATE SEQUENCE club_seq;
CREATE TABLE club ( 
	id INTEGER NOT NULL DEFAULT nextval('club_seq'::regclass) PRIMARY KEY,
	club_name VARCHAR(60),
	file_name_logo VARCHAR(20),
	address_name VARCHAR(200),
	address_number VARCHAR(20),
	address_quarter VARCHAR(50),
    city_id INTEGER NOT NULL,
    maps_link VARCHAR(512),
    club_site VARCHAR(150),
    phone_number_1 VARCHAR(20),
    phone_number_2 VARCHAR(20),
    phone_number_3 VARCHAR(20),
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT club_FK_1 FOREIGN KEY(city_id) REFERENCES city (id)
);



INSERT INTO club(club_name, file_name_logo, address_name, address_number, address_quarter, city_id, maps_link, club_site, phone_number_1, created_at, updated_at) VALUES
    ('Black River Club', 'briver.jpg', 'Rua Manoel Joaquim Pires', 777, null, (SELECT id FROM city WHERE description ILIKE 'São José do Rio Preto'), 'http://maps.google.com/maps?q=Rua+Manoel+Joaquim+Pires,+777,+S%C3%A3o+Jos%C3%A9+do+Rio+Preto+-+S%C3%A3o+Paulo,+Brazil&hl=en&ie=UTF8&sll=-20.832698,-49.403443&sspn=0.008092,0.013937&hnear=R.+Joaquim+Manoel+Pires,+777+-+Jardim+Pinheiros,+S%C3%A3o+Jos%C3%A9+do+Rio+Preto+-+S%C3%A3o+Paulo,+15091-210,+Brazil&t=m&z=17', null, '(17) 7811-5002', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Espaço Zahle Club', 'zahle.jpg', 'Rua Osório Duque Estrada', '40', null, (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Os%C3%B3rio+Duque+Estrada,+40,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-20.832698,-49.403443&sspn=0.008092,0.013937&oq=Rua+Os%C3%B3rio+Duque+Estrada,+40,+sao+p&hnear=R.+Os%C3%B3rio+Duque+Estrada,+40+-+Moema,+S%C3%A3o+Paulo,+04001-120,+Brazil&t=m&z=17', null, '(11) 3057-3831', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('H2 Club', 'h2.jpg', 'Rua Iguatemi', '236', 'Itaim Bibi', (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Iguatemi,+236,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-23.569368,-46.653297&sspn=0.015872,0.027874&oq=Rua+Iguatemi,+236,+sao&hnear=R.+Iguatemi,+236+-+Itaim+Bibi,+S%C3%A3o+Paulo,+01451-010,+Brazil&t=m&z=17&iwloc=A', 'www.h2club.com.br', '(11) 3078-5884', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Vegas Holdem Club', 'vegas.jpg', 'Rua Bento de Andrade', '312', 'Ibirapuera', (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Bento+de+Andrade+312,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-23.584174,-46.682294&sspn=0.007935,0.013937&hnear=R.+Bento+de+Andrade,+312+-+Moema,+S%C3%A3o+Paulo,+04503-000,+Brazil&t=m&z=17', null, '(11) 3439-0104', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
    
DROP TABLE IF EXISTS event_live;
DROP TABLE IF EXISTS ranking_live;

CREATE SEQUENCE ranking_live_seq;
CREATE TABLE ranking_live ( 
	id INTEGER NOT NULL DEFAULT nextval('ranking_live_seq'::regclass) PRIMARY KEY,
	ranking_name VARCHAR(25),
	ranking_type_id INTEGER,
	start_date DATE,
	finish_date DATE,
	is_private BOOLEAN DEFAULT FALSE,
	players INTEGER DEFAULT 0,
	events INTEGER DEFAULT 0,
	default_buyin DECIMAL(10,2) DEFAULT 0,
	game_style_id INTEGER,
	ranking_tag VARCHAR(20),
	score_formula VARCHAR(250),
    file_name_logo VARCHAR(32),
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	CONSTRAINT ranking_live_fk_1 FOREIGN KEY (ranking_type_id) REFERENCES virtual_table (id),
    CONSTRAINT ranking_live_fk_2 FOREIGN KEY (game_style_id) REFERENCES virtual_table (id)
);



CREATE SEQUENCE event_live_seq;
CREATE TABLE event_live (
    id INTEGER NOT NULL DEFAULT nextval('event_live_seq'::regclass) PRIMARY KEY,
    ranking_live_id INTEGER NOT NULL,
    event_name VARCHAR(100),
    event_short_name VARCHAR(50),
    event_date DATE,
    event_time TIME,
    event_datetime TIMESTAMP,
    description TEXT,
    club_id INTEGER,
    buyin DECIMAL(10,2),
    blind_time TIME,
    stack_chips FLOAT,
    players INTEGER,
    allowed_rebuys INTEGER,
    allowed_addons INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_live_fk_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id),
    CONSTRAINT event_live_fk_2 FOREIGN KEY (club_id) REFERENCES club (id)
);

ALTER TABLE city RENAME COLUMN description TO city_name;
ALTER TABLE state RENAME COLUMN description TO state_name;

UPDATE city SET order_seq = id;

CREATE OR REPLACE FUNCTION no_accent(text) RETURNS text  AS '
    SELECT translate($1, ''áàâãäéèêëíìïóòôõöúùûüÁÀÂÃÄÉÈÊËÍÌÏÓÒÔÕÖÚÙÛÜçÇ'',
                        ''aaaaaeeeeiiiooooouuuuAAAAAEEEEIIIOOOOOUUUUcC'');
'
LANGUAGE sql IMMUTABLE STRICT; 

CREATE OR REPLACE VIEW city_view AS
SELECT
    city.ID AS id,
    state.ID AS state_id,
    city.CITY_NAME||', '||state.INITIAL AS full_name,
    city.CITY_NAME,
    state.STATE_NAME,
    state.INITIAL
FROM
    city
    INNER JOIN state ON city.STATE_ID=state.ID
ORDER BY
    state.ORDER_SEQ,
    city.ORDER_SEQ;


ALTER TABLE club ADD COLUMN enabled BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN visible BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN locked BOOLEAN DEFAULT FALSE;
ALTER TABLE club ADD COLUMN deleted BOOLEAN DEFAULT FALSE;

UPDATE club SET enabled=TRUE, visible=TRUE, deleted=false;
ALTER TABLE club ALTER COLUMN city_id DROP NOT NULL;

ALTER TABLE ranking_live ADD COLUMN game_type_id INTEGER;
ALTER TABLE ranking_live ADD CONSTRAINT ranking_live_FK_3 FOREIGN KEY (game_type_id) REFERENCES virtual_table (id);
ALTER TABLE ranking_live ALTER COLUMN ranking_name TYPE VARCHAR(30);

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

UPDATE club SET file_name_logo = REPLACE(file_name_logo, '.jpg', '.png');

ALTER TABLE event_live_player ADD COLUMN event_position INTEGER DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN prize DECIMAL(10, 2) DEFAULT 0;

ALTER TABLE event_live ADD COLUMN saved_result BOOLEAN DEFAULT FALSE;

ALTER TABLE event_live_player ADD COLUMN score FLOAT DEFAULT 0;

ALTER TABLE user_site ADD COLUMN htpasswd_line INTEGER DEFAULT NULL;
ALTER TABLE user_site ADD COLUMN signed_schedule BOOLEAN DEFAULT FALSE;
ALTER TABLE user_site ADD COLUMN schedule_start_date DATE DEFAULT NULL;

UPDATE user_site SET signed_schedule = false, schedule_start_date = null;

UPDATE
    user_site
SET
    htpasswd_line = (SELECT COUNT(1)+1 FROM user_site user_site_count WHERE user_site.ID > user_site_count.ID AND visible AND enabled AND NOT deleted);

INSERT INTO config VALUES('htpasswdFilePath', 'Endereço do arquivo .htpasswd', '../.htpasswd', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

SELECT
    username||':{SHA}fTT1mPr0/aRzaaaLPLDTGURHy38=',
    (SELECT COUNT(1) FROM user_site user_site_count WHERE user_site.ID > user_site_count.ID AND visible AND enabled AND NOT deleted)+1
FROM
    user_site
WHERE
    visible
    AND enabled
    AND NOT deleted
ORDER BY id;

ALTER TABLE event_live RENAME COLUMN event_datetime TO event_date_time;
ALTER TABLE event_live ADD COLUMN is_freeroll BOOLEAN DEFAULT FALSE;
ALTER TABLE event_live ADD COLUMN entrance_fee DECIMAL(10, 2) DEFAULT 0;
ALTER TABLE event_live ADD COLUMN comments VARCHAR(250);

DROP VIEW IF EXISTS event_schedule_view;
CREATE OR REPLACE VIEW event_schedule_view AS
SELECT
    event.ID,
    event.EVENT_NAME,
    event.EVENT_DATE,
    event.START_TIME,
    event.EVENT_DATE_TIME,
    event.COMMENTS,
    event.PLAYERS,
    event.IS_FREEROLL,
    event.BUYIN,
    event.ENTRANCE_FEE,
    event.ALLOW_REBUY,
    event.ALLOW_ADDON,
    ranking.RANKING_NAME,
    ranking_place.PLACE_NAME,
    event.CREATED_AT,
    ranking.ID AS ranking_id,
    event_player.PEOPLE_ID,
    event_player.INVITE_STATUS
FROM
    event
    INNER JOIN ranking ON event.RANKING_ID=ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID=ranking_place.ID
    INNER JOIN event_player ON event_player.EVENT_ID=event.ID
WHERE
    event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;

INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, created_at, updated_at) VALUES
    ('userSiteOption', 'Estado da agenda', 'scheduleStateId', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('userSiteOption', 'Cidade da agenda', 'scheduleCityId', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('userSiteOption', 'Tempo de alerta', 'scheduleAlarmTime', true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO user_site_option(people_id, user_site_option_id, option_value, created_at, updated_at)
    (SELECT id, (SELECT MAX(id) FROM user_option), '4H', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP FROM people WHERE people_type_id = 2);


UPDATE state SET order_seq = id+5;
UPDATE state SET order_seq = 1 WHERE initial = 'SP';
UPDATE state SET order_seq = 2 WHERE initial = 'RJ';
UPDATE state SET order_seq = 3 WHERE initial = 'PR';
UPDATE state SET order_seq = 4 WHERE initial = 'DF';
UPDATE state SET order_seq = 5 WHERE initial = 'GO';

ALTER TABLE ranking_live ADD COLUMN description TEXT;
ALTER TABLE ranking_live ADD COLUMN default_entrance_fee DECIMAL(10,2);

ALTER TABLE club ALTER COLUMN file_name_logo TYPE VARCHAR(50);

CREATE VIEW event_search AS
SELECT
    DISTINCT event.ID,
    ranking.RANKING_NAME,
    event.EVENT_NAME,
    event.EVENT_DATE,
    event.EVENT_DATE_TIME,
    event.COMMENTS,
    event.BUYIN,
    event.PLAYERS,
    event.ALLOW_REBUY,
    event.ALLOW_ADDON,
    event.ENTRANCE_FEE,
    event.IS_FREEROLL,
    ranking_place.PLACE_NAME,
    event_player.PEOPLE_ID
FROM
    event
    LEFT JOIN ranking ON event.RANKING_ID = ranking.ID
    INNER JOIN ranking_place ON event.RANKING_PLACE_ID = ranking_place.ID
    INNER JOIN event_player ON event.ID = event_player.EVENT_ID
WHERE
    ranking.ENABLED
    AND ranking.VISIBLE
    AND NOT ranking.DELETED
    AND event.ENABLED
    AND event.VISIBLE
    AND NOT event.DELETED;
    
ALTER TABLE ranking_live ADD COLUMN default_start_time TIME;
ALTER TABLE ranking_live ADD COLUMN default_is_freeroll BOOLEAN;
ALTER TABLE ranking_live ADD COLUMN default_blind_time TIME;
ALTER TABLE ranking_live ADD COLUMN default_stack_chips DECIMAL(10, 2);
ALTER TABLE ranking_live ADD COLUMN default_allowed_rebuys INTEGER;
ALTER TABLE ranking_live ADD COLUMN default_allowed_addons INTEGER;
ALTER TABLE ranking_live ADD COLUMN default_is_ilimited_rebuys BOOLEAN;


CREATE SEQUENCE event_live_photo_seq;
CREATE TABLE event_live_photo (
    id INTEGER NOT NULL DEFAULT nextval('event_live_photo_seq'::regclass) PRIMARY KEY,
    event_live_id INTEGER NOT NULL,
    file_id INTEGER NOT NULL,
    deleted BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    width INTEGER,
    height INTEGER,
    orientation	CHAR(1),
    CONSTRAINT event_live_photo_fk_1 FOREIGN KEY(event_live_id) REFERENCES event_live (id),
    CONSTRAINT event_live_photo_fk_2 FOREIGN KEY(file_id) REFERENCES file (id)
);

CREATE SEQUENCE club_photo_seq;
CREATE TABLE club_photo (
    id INTEGER NOT NULL DEFAULT nextval('club_photo_seq'::regclass) PRIMARY KEY,
    club_id INTEGER NOT NULL,
    file_id INTEGER NOT NULL,
    deleted BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    width INTEGER,
    height INTEGER,
    orientation	CHAR(1),
    CONSTRAINT club_photo_fk_1 FOREIGN KEY(club_id) REFERENCES club (id),
    CONSTRAINT club_photo_fk_2 FOREIGN KEY(file_id) REFERENCES file (id)
);

/* -------------------- EXECUTAR NA BASE LOG ------------------- */
ALTER TABLE log ADD COLUMN user_admin_id INTEGER;

ALTER TABLE event_live ADD COLUMN rake_percent DECIMAL(5,2);
ALTER TABLE event_live ADD COLUMN total_rebuys DECIMAL(10,2);
ALTER TABLE event_live ADD COLUMN prize_split VARCHAR(50);

CREATE TABLE ranking_live_player ( 
    ranking_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    total_events INTEGER,
    total_score DECIMAL(10,3),
    total_balance	DECIMAL(10, 2),
    total_prize DECIMAL(10, 2),
    total_paid DECIMAL(10, 2),
    total_average DECIMAL(10,3),
    enabled BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_live_id, people_id),
    CONSTRAINT ranking_live_player_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id),
    CONSTRAINT ranking_live_player_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE TABLE ranking_live_history ( 
    ranking_live_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    ranking_date DATE NOT NULL,
    ranking_position INTEGER NOT NULL DEFAULT 0,
    events INTEGER NOT NULL DEFAULT 0,
    score DECIMAL(10,3) NOT NULL DEFAULT 0,
    balance_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    prize_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    paid_value DECIMAL(10, 2) NOT NULL DEFAULT 0,
    average DECIMAL(10,3) NOT NULL DEFAULT 0,
    total_ranking_position	INTEGER NOT NULL DEFAULT 0,
    total_events INTEGER NOT NULL DEFAULT 0,
    total_score DECIMAL(10,3) NOT NULL DEFAULT 0,
    total_balance DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_prize DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_paid DECIMAL(10, 2) NOT NULL DEFAULT 0,
    total_average DECIMAL(10,3) NOT NULL DEFAULT 0,
    enabled BOOLEAN NOT NULL DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_date, ranking_live_id, people_id),
    CONSTRAINT ranking_live_history_FK_1 FOREIGN KEY (ranking_live_id) REFERENCES ranking_live (id),
    CONSTRAINT ranking_live_history_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE ranking_history DROP CONSTRAINT ranking_member_fk_1;
ALTER TABLE ranking_history DROP CONSTRAINT ranking_member_fk_2;
ALTER TABLE ranking_history ADD CONSTRAINT ranking_history_fk_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id);
ALTER TABLE ranking_history ADD CONSTRAINT ranking_history_fk_2 FOREIGN KEY (people_id) REFERENCES people (id);

DELETE FROM ranking_live_player;
INSERT INTO ranking_live_player(ranking_live_id, people_id, total_events, total_score, total_balance, total_prize, total_average, total_paid, enabled, created_at, updated_at)
    (SELECT ranking_live_id, people_id, COUNT(1), 0, 0, 0, 0, 0, event_live_player.ENABLED, MIN(event_live_player.CREATED_AT), MIN(event_live_player.UPDATED_AT) FROM event_live_player INNER JOIN event_live ON event_live.ID=event_live_player.EVENT_LIVE_ID WHERE ranking_live_id IS NOT NULL GROUP BY ranking_live_id, people_id, event_live_player.ENABLED, event_live_player.CREATED_AT, event_live_player.UPDATED_AT);


ALTER TABLE event_live_player ADD COLUMN buyin DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN rebuy DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN addon DECIMAL(10,2) NULL DEFAULT 0;
ALTER TABLE event_live_player ADD COLUMN deleted BOOLEAN NULL DEFAULT false;
ALTER TABLE event_live_player ADD COLUMN entrance_fee DECIMAL(10,2) NULL DEFAULT 0;


CREATE OR REPLACE FUNCTION update_ranking_live_player_events(rankingLiveId INTEGER) RETURNS INTEGER AS '
BEGIN

    UPDATE 
        ranking_live_player
    SET 
        total_events = (SELECT 
                            COUNT(1) 
                        FROM 
                            event_live_player
                            INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
                        WHERE
                            event_live.RANKING_LIVE_ID=rankingLiveId
                            AND event_live_player.ENABLED = true
                            AND event_live.RANKING_LIVE_ID=ranking_live_player.RANKING_LIVE_ID
                            AND event_live_player.PEOPLE_ID=ranking_live_player.PEOPLE_ID
                            AND NOT event_live.DELETED
                            AND event_live.VISIBLE
                            AND event_live.ENABLED
                        	AND event_live.SAVED_RESULT = TRUE);

  RETURN 0;
END'
LANGUAGE plpgsql;

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

DROP VIEW IF EXISTS event_live_search;
CREATE VIEW event_live_search AS
SELECT
    event_live.ID,
    ranking_live.RANKING_NAME,
    event_live.EVENT_NAME,
    event_live.EVENT_SHORT_NAME,
    event_live.EVENT_DATE,
    event_live.EVENT_DATE_TIME,
    event_live.DESCRIPTION,
    event_live.BUYIN,
    event_live.BLIND_TIME,
    event_live.STACK_CHIPS,
    event_live.PLAYERS,
    event_live.ALLOWED_REBUYS,
    event_live.ALLOWED_ADDONS,
    event_live.IS_ILIMITED_REBUYS,
    event_live.ENTRANCE_FEE,
    event_live.IS_FREEROLL,
    club.CLUB_NAME,
    club.ADDRESS_QUARTER,
    city.CITY_NAME,
    state.INITIAL
FROM
    event_live
    LEFT JOIN ranking_live ON event_live.RANKING_LIVE_ID = ranking_live.ID AND ranking_live.ENABLED AND ranking_live.VISIBLE AND NOT ranking_live.DELETED
    INNER JOIN club ON event_live.CLUB_ID = club.ID
    INNER JOIN city ON club.CITY_ID=city.ID
    INNER JOIN state ON city.STATE_ID=state.ID
WHERE
    club.ENABLED
    AND club.VISIBLE
    AND NOT club.DELETED
    AND event_live.ENABLED
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE;
    
ALTER TABLE event_live ADD COLUMN suppress_schedule BOOLEAN DEFAULT FALSE;

DROP VIEW IF EXISTS event_live_schedule_view;
CREATE OR REPLACE VIEW event_live_schedule_view AS
SELECT
    event_live.ID,
    event_live.EVENT_NAME,
    event_live.EVENT_DATE,
    event_live.START_TIME,
    event_live.EVENT_DATE_TIME,
    event_live.COMMENTS,
    event_live.PLAYERS,
    event_live.IS_FREEROLL,
    event_live.BUYIN,
    event_live.ENTRANCE_FEE,
    event_live.ALLOWED_REBUYS,
    event_live.IS_ILIMITED_REBUYS,
    event_live.ALLOWED_ADDONS,
    ranking_live.RANKING_NAME,
    club.CLUB_NAME,
    club.MAPS_LINK,
    city.CITY_NAME,
    state.INITIAL,
    event_live.CREATED_AT,
    ranking_live.ID AS ranking_live_id
FROM
    event_live
    INNER JOIN ranking_live ON event_live.RANKING_LIVE_ID=ranking_live.ID
    INNER JOIN club ON event_live.CLUB_ID=club.ID
    INNER JOIN city ON club.CITY_ID=city.ID
    INNER JOIN state ON city.STATE_ID=state.ID
WHERE
    event_live.ENABLED
    AND NOT event_live.SUPPRESS_SCHEDULE
    AND event_live.VISIBLE
    AND NOT event_live.DELETED
    AND NOT ranking_live.IS_PRIVATE;

ALTER TABLE event_photo ADD COLUMN contest_runs INTEGER DEFAULT 0;
ALTER TABLE event_photo ADD COLUMN contest_wins INTEGER DEFAULT 0;
ALTER TABLE event_photo ADD COLUMN contest_ratio FLOAT DEFAULT 0.0;





CREATE OR REPLACE FUNCTION update_photo_contest(eventPhotoIdWinner INTEGER, eventPhotoIdLoser INTEGER) RETURNS VOID AS '
BEGIN

    UPDATE event_photo SET contest_runs = contest_runs+1 WHERE id IN (eventPhotoIdWinner, eventPhotoIdLoser);
    UPDATE event_photo SET contest_wins = contest_wins+1 WHERE id = eventPhotoIdWinner;
    UPDATE event_photo SET contest_ratio = (contest_wins::FLOAT/contest_runs::FLOAT)::FLOAT WHERE id IN (eventPhotoIdWinner, eventPhotoIdLoser) AND contest_wins > 0;

END'
LANGUAGE 'plpgsql';

CREATE FUNCTION get_ranking_live_new_players(INTEGER) RETURNS SETOF INTEGER AS '
    
    SELECT
        event_live_player.PEOPLE_ID
    FROM
        event_live_player
        INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
        INNER JOIN ranking_live ON event_live.RANKING_LIVE_ID=ranking_live.ID
        LEFT JOIN ranking_live_player ON ranking_live_player.PEOPLE_ID=event_live_player.PEOPLE_ID
    WHERE
        ranking_live.ID = $1
        AND ranking_live_player.PEOPLE_ID IS NULL;
'
LANGUAGE 'sql';

UPDATE event_photo SET people_id = (SELECT people_id FROM user_site INNER JOIN ranking ON ranking.USER_SITE_ID=user_site.ID INNER JOIN event ON event.RANKING_ID=ranking.ID WHERE event.ID=event_photo.EVENT_ID) WHERE people_id IS NULL;

CREATE OR REPLACE FUNCTION update_ranking_live_players(rankingLiveId INTEGER) RETURNS VOID AS '
DECLARE
BEGIN

    UPDATE ranking_live SET players = (SELECT
                                           COUNT(1)
                                       FROM
                                           ranking_live_player
                                       WHERE
                                           ranking_live_id = rankingLiveId
                                           AND enabled
                                           AND total_events > 0) WHERE id = rankingLiveId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_ranking_live_events(rankingLiveId INTEGER) RETURNS VOID AS '
DECLARE
BEGIN

    UPDATE ranking_live SET events = (SELECT
                                           COUNT(1)
                                       FROM
                                           event_live
                                       WHERE
                                           ranking_live_id = rankingLiveId
                                           AND enabled
                                           AND visible
                                           AND NOT deleted
                                           AND saved_result) WHERE id = rankingLiveId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION get_ranking_live_total_prize(rankingLiveId INTEGER) RETURNS DECIMAL(10, 2) AS '
DECLARE
    totalPrize DECIMAL(10, 2);
BEGIN

    SELECT
       SUM(prize) INTO totalPrize
   FROM
       event_live_player
       INNER JOIN event_live ON event_live_player.EVENT_LIVE_ID=event_live.ID
   WHERE
       event_live.RANKING_LIVE_ID = rankingLiveId
       AND event_live.ENABLED
       AND event_live.VISIBLE
       AND NOT event_live.DELETED
       AND event_live.SAVED_RESULT;

   RETURN totalPrize;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION update_ranking_live_visit_count(rankingLiveId INTEGER) RETURNS VOID AS 
'
BEGIN

    UPDATE event_live SET visit_count = visit_count+1 WHERE ranking_live_id = rankingLiveId;

END'
LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION is_ranking_live_player(rankingLiveId INTEGER, peopleId INTEGER) RETURNS BOOLEAN AS '
DECLARE
    events INTEGER;
BEGIN

    SELECT
        total_events INTO events
    FROM
        ranking_live_player
    WHERE
        ranking_live_id = rankingLiveId
        AND people_id = peopleId;

    RETURN events > 0;

END'
LANGUAGE 'plpgsql';
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
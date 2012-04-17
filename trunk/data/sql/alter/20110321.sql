CREATE SEQUENCE event_personal_seq;
CREATE TABLE event_personal ( 
	id INTEGER NOT NULL DEFAULT nextval('event_personal_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER NOT NULL,
    game_style_id INTEGER NOT NULL,
	event_name VARCHAR(50),
	event_place VARCHAR(50),
	event_position INTEGER,
	paid_places INTEGER,
	buyin FLOAT DEFAULT 0,
	rebuy FLOAT DEFAULT 0,
	addon FLOAT DEFAULT 0,
	prize FLOAT DEFAULT 0,
	event_date DATE,
	comments VARCHAR(140),
	players INTEGER DEFAULT 0,
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT event_personal_FK_1 FOREIGN KEY(user_site_id) REFERENCES user_site (id),
    CONSTRAINT event_personal_FK_2 FOREIGN KEY(game_style_id) REFERENCES virtual_table (id)
);
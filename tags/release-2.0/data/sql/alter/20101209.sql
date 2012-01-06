ALTER TABLE ranking_player ADD COLUMN allow_edit BOOLEAN DEFAULT FALSE;
ALTER TABLE event_player ADD COLUMN allow_edit BOOLEAN DEFAULT FALSE;

DROP TABLE IF EXISTS log;
DROP SEQUENCE IF EXISTS log_seq;

CREATE SEQUENCE log_seq;
CREATE TABLE log ( 
	id INTEGER NOT NULL DEFAULT nextval('log_seq'::regclass) PRIMARY KEY,
	user_site_id INTEGER,
	app VARCHAR(60),
	module_name VARCHAR(60),
	action_name VARCHAR(60),
	message VARCHAR(255),
	class_name VARCHAR(50),
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
	CONSTRAINT log_FK_1 FOREIGN KEY(user_site_id) REFERENCES user_site (id)
);

DROP TABLE IF EXISTS log_field;
CREATE TABLE log_field (
	log_id INTEGER NOT NULL,
    field_name VARCHAR(32),
	field_value VARCHAR(255),
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    PRIMARY KEY(log_id, field_name),
	CONSTRAINT log_field_FK_1 FOREIGN KEY(log_id) REFERENCES log (id) ON DELETE CASCADE
);
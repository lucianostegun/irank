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
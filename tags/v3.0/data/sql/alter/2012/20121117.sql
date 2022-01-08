DROP TABLE IF EXISTS timer_level;
DROP SEQUENCE IF EXISTS timer_level_seq;
DROP TABLE IF EXISTS timer;
DROP SEQUENCE IF EXISTS timer_seq;

CREATE SEQUENCE timer_seq;
CREATE TABLE timer (
    id INTEGER NOT NULL DEFAULT nextval('timer_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER NOT NULL,
    timer_name VARCHAR(30),
    default_duration INTEGER,
    has_ante BOOLEAN DEFAULT FALSE,
    levels INTEGER,
    play_sound BOOLEAN DEFAULT TRUE,
    minute_alert BOOLEAN DEFAULT FALSE,
    confirm_level BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT timer_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id)
);

CREATE SEQUENCE timer_level_seq;
CREATE TABLE timer_level (
    id INTEGER NOT NULL DEFAULT nextval('timer_level_seq'::regclass) PRIMARY KEY,
    timer_id INTEGER NOT NULL,
    small_blind INTEGER,
    big_blind INTEGER,
    ante INTEGER,
    duration INTEGER,
    is_pause BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT timer_level_FK_1 FOREIGN KEY (timer_id) REFERENCES timer (id)
);
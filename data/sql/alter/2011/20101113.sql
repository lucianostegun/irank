DROP TABLE IF EXISTS event_member;

DROP TABLE IF EXISTS event;
DROP SEQUENCE IF EXISTS event_seq;

DROP TABLE IF EXISTS ranking_member;

DROP TABLE IF EXISTS ranking;
DROP SEQUENCE IF EXISTS ranking_seq;

CREATE SEQUENCE ranking_seq;
CREATE TABLE ranking (
    id INTEGER NOT NULL DEFAULT nextval('ranking_seq'::regclass) PRIMARY KEY,
    ranking_name VARCHAR(25),
    user_site_id INTEGER NOT NULL,
    ranking_type_id INTEGER,
    start_date DATE,
    finish_date DATE,
    is_private BOOLEAN DEFAULT FALSE,
    members INTEGER DEFAULT 0,
    events INTEGER DEFAULT 0,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT ranking_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id),
    CONSTRAINT ranking_FK_2 FOREIGN KEY (ranking_type_id) REFERENCES virtual_table (id)
);

CREATE TABLE ranking_member (
    ranking_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    events INTEGER DEFAULT 0,
    score FLOAT DEFAULT 0,
    enabled BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(ranking_id, people_id),
    CONSTRAINT ranking_member_FK_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id),
    CONSTRAINT ranking_member_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

CREATE SEQUENCE event_seq;
CREATE TABLE event (
    id INTEGER NOT NULL DEFAULT nextval('event_seq'::regclass) PRIMARY KEY,
    ranking_id INTEGER,
    game_style_id INTEGER,
    event_name VARCHAR(25),
    event_place VARCHAR(250),
    paid_places INTEGER,
    buy_in FLOAT,
    event_date DATE,
    start_time TIME,
    comments VARCHAR(140),
    sent_email BOOLEAN,
    invites INTEGER DEFAULT 0,
    members INTEGER DEFAULT 0,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT event_FK_1 FOREIGN KEY (ranking_id) REFERENCES ranking (id),
    CONSTRAINT event_FK_2 FOREIGN KEY (game_style_id) REFERENCES virtual_table (id)
);

CREATE TABLE event_member (
    event_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    buyin FLOAT DEFAULT 0,
    rebuys INTEGER DEFAULT 0,
    addons INTEGER DEFAULT 0,
    event_position INTEGER DEFAULT 0,
    prize_value FLOAT DEFAULT 0,
    enabled BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(event_id, people_id),
    CONSTRAINT event_member_FK_1 FOREIGN KEY (event_id) REFERENCES event (id),
    CONSTRAINT event_member_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);
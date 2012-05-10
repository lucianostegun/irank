CREATE SEQUENCE settings_seq;
CREATE TABLE settings (
    id INTEGER NOT NULL DEFAULT nextval('settings_seq'::regclass) PRIMARY KEY,
    tag_name VARCHAR(50) UNIQUE,
    settings_name VARCHAR(30),
    description VARCHAR(100),
    default_value VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE club_settings (
    club_id INTEGER NOT NULL,
    settings_id INTEGER NOT NULL,
    settings_value VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(club_id, settings_id),
    CONSTRAINT club_settings_FK_1 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT club_settings_FK_2 FOREIGN KEY (settings_id) REFERENCES settings (id)
);

CREATE TABLE user_admin_settings (
    user_admin_id INTEGER NOT NULL,
    settings_id INTEGER NOT NULL,
    settings_value VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(user_admin_id, settings_id),
    CONSTRAINT user_admin_settings_FK_1 FOREIGN KEY (user_admin_id) REFERENCES user_admin (id),
    CONSTRAINT user_admin_settings_FK_2 FOREIGN KEY (settings_id) REFERENCES settings (id)
);

INSERT INTO settings(tag_name, settings_name, description, default_value, created_at, updated_at)
    VALUES('hoursToPending', 'Tempo para pendência', 'Tempo (em horas) para que o resultado um evento seja considerado "pendente".', '4', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
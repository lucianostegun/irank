CREATE TABLE user_site_config (
    user_site_id INTEGER NOT NULL UNIQUE PRIMARY KEY,
    bankroll_tutorial_home INTEGER DEFAULT 0,
    sms_validation_code CHAR(4),
    sms_validation_attempts INTEGER DEFAULT 0,
    agreed_sms_terms BOOLEAN DEFAULT FALSE,
    CONSTRAINT user_site_config_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id)
);
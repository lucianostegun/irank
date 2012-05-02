CREATE TABLE access_log (
    user_site_id INTEGER NOT NULL,
    created_at TIMESTAMP,
    ip_address INET,
    PRIMARY KEY(user_site_id, created_at),
    CONSTRAINT access_log_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id)
);

CREATE TABLE access_admin_log (
    user_admin_id INTEGER NOT NULL,
    created_at TIMESTAMP,
    ip_address INET,
    PRIMARY KEY(user_admin_id, created_at),
    CONSTRAINT access_admin_log_FK_1 FOREIGN KEY (user_admin_id) REFERENCES user_admin (id)
);

ALTER TABLE club ADD COLUMN tag_name VARCHAR(15);
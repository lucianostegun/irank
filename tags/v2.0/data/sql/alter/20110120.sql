DROP TABLE IF EXISTS home_wall;
DROP SEQUENCE IF EXISTS home_wall_seq;

CREATE SEQUENCE home_wall_seq;
CREATE TABLE home_wall (
    id INTEGER NOT NULL DEFAULT nextval('home_wall_seq'::regclass) PRIMARY KEY,
    user_site_id INTEGER NOT NULL,
    people_name VARCHAR(15) NOT NULL,
    message VARCHAR(200) NOT NULL,
    icon VARCHAR(10),
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT home_wall_FK_1 FOREIGN KEY (user_site_id) REFERENCES user_site (id)
);
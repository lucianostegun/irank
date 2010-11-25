/* CREATE DATABASE iranking WITH encoding 'UTF-8' */

DROP TABLE IF EXISTS user_site;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS virtual_table;
DROP SEQUENCE IF EXISTS user_site_seq;
DROP SEQUENCE IF EXISTS people_seq;
DROP SEQUENCE IF EXISTS virtual_table_seq;

CREATE SEQUENCE virtual_table_seq;
CREATE TABLE virtual_table (
    id INTEGER NOT NULL DEFAULT nextval('virtual_table_seq'::regclass) PRIMARY KEY,
    virtual_table_name VARCHAR(20) NOT NULL,
    description VARCHAR(100),
    tag_name VARCHAR(50),
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE SEQUENCE people_seq;
CREATE TABLE people (
    id INTEGER NOT NULL DEFAULT nextval('people_seq'::regclass) PRIMARY KEY,
    people_type_id INTEGER,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    full_name VARCHAR(200),
    email_address VARCHAR(200),
    birthday DATE NULL,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT people_FK_1 FOREIGN KEY (people_type_id) REFERENCES virtual_table (id)
);

CREATE SEQUENCE user_site_seq;
CREATE TABLE user_site (
    id INTEGER NOT NULL DEFAULT nextval('user_site_seq'::regclass) PRIMARY KEY,
    people_id INTEGER,
    username VARCHAR(20),
    password VARCHAR(32),
    last_access_date TIMESTAMP,
    active BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT user_site_FK_1 FOREIGN KEY (people_id) REFERENCES people (id)
);

/**
 * DROP FUNCTION IF EXISTS to_ascii(bytea, name);
 * CREATE FUNCTION to_ascii(bytea, name)
 * RETURNS text AS 'to_ascii_encname' LANGUAGE internal;
 */
INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('blogCategory', 'Glossário', 'dictionary', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE SEQUENCE glossary_seq;
CREATE TABLE glossary (
    id INTEGER NOT NULL DEFAULT nextval('glossary_seq'::regclass) PRIMARY KEY,
    term VARCHAR(50),
    description TEXT,
    tags VARCHAR(150),
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

ALTER TABLE blog ADD COLUMN glossary VARCHAR(100);
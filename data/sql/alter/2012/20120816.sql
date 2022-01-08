CREATE SEQUENCE blog_seq;
CREATE TABLE blog (
    id INTEGER NOT NULL DEFAULT nextval('blog_seq'::regclass) PRIMARY KEY,
    title VARCHAR(150),
    short_title VARCHAR(50),
    caption VARCHAR(250),
    blog_category_id INTEGER,
    permalink VARCHAR(100),
    tags VARCHAR(100),
    people_id INTEGER,
    content TEXT,
    is_draft BOOLEAN DEFAULT FALSE,
    enabled BOOLEAN DEFAULT FALSE,
    visible BOOLEAN DEFAULT TRUE,
    locked BOOLEAN DEFAULT FALSE,
    deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT blog_FK_1 FOREIGN KEY (blog_category_id) REFERENCES virtual_table (id),
    CONSTRAINT blog_FK_2 FOREIGN KEY (people_id) REFERENCES people (id)
);

INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('blogCategory', 'Dicas', 'tips', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

CREATE VIEW blog_category AS
SELECT
    *
FROM
    virtual_table
WHERE
    virtual_table_name = 'blogCategory';

ALTER TABLE people ADD COLUMN nickname VARCHAR(16);
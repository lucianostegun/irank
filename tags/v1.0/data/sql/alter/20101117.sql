ALTER TABLE virtual_table ALTER COLUMN description TYPE VARCHAR(100);
ALTER TABLE virtual_table ADD CONSTRAINT virtual_table_UK_1 UNIQUE (virtual_table_name, tag_name);

CREATE TABLE user_site_option (
    people_id INTEGER NOT NULL,
    user_site_option_id INTEGER NOT NULL,
    option_value VARCHAR(20),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(people_id, user_site_option_id),
    CONSTRAINT user_site_option_FK_1 FOREIGN KEY(people_id) REFERENCES people (id),
    CONSTRAINT user_site_option_FK_2 FOREIGN KEY(user_site_option_id) REFERENCES virtual_table (id)
);
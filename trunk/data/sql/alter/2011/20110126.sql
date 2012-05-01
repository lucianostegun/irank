CREATE TABLE virtual_table_i18n (
    virtual_table_id INTEGER NOT NULL,
    culture CHAR(5),
    description_i18n VARCHAR(150),
    PRIMARY KEY(virtual_table_id, culture),
    CONSTRAINT virtual_table_i18n_FK_1 FOREIGN KEY (virtual_table_id) REFERENCES virtual_table (id)
);
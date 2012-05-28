CREATE SEQUENCE cash_table_dealer_seq;
CREATE TABLE cash_table_dealer (
    id INTEGER NOT NULL DEFAULT nextval('cash_table_dealer_seq'::regclass) PRIMARY KEY,
    cash_table_id INTEGER NOT NULL,
    cash_table_session_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    cashout_value DECIMAL(10, 2),
    checkin_at TIMESTAMP,
    checkout_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT cash_table_dealer_FK_1 FOREIGN KEY (cash_table_id) REFERENCES cash_table (id),
    CONSTRAINT cash_table_dealer_FK_2 FOREIGN KEY (cash_table_session_id) REFERENCES cash_table_session (id),
    CONSTRAINT cash_table_dealer_FK_3 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE cash_table ADD COLUMN game_type_id INTEGER;
ALTER TABLE cash_table ADD CONSTRAINT cash_table_FK_4 FOREIGN KEY (game_type_id) REFERENCES virtual_table (id);
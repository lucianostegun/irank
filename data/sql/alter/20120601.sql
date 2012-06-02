INSERT INTO virtual_table(virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at) VALUES
    ('payMethod', 'Dinheiro', 'cash', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('payMethod', 'Cheque a vista', 'check', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('payMethod', 'Cheque pré', 'datedCheck', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('payMethod', 'Cartão de débito', 'debit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('payMethod', 'Cartão de crédito', 'credit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('payMethod', 'Crédito casa', 'clubCredit', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

ALTER TABLE cash_table_player_buyin ADD COLUMN pay_method_id INTEGER;
ALTER TABLE cash_table_player_buyin ADD CONSTRAINT cash_table_player_buyin_FK_4 FOREIGN KEY (pay_method_id) REFERENCES virtual_table (id);

CREATE VIEW pay_method AS
SELECT 
    description, 
    tag_name, 
    enabled, 
    visible, 
    locked, 
    deleted, 
    created_at, 
    updated_at 
FROM 
    virtual_table 
WHERE 
    virtual_table_name = 'payMethod'
    AND enabled
    AND visible
    AND NOT deleted;

CREATE SEQUENCE club_check_seq;
CREATE TABLE club_check (
    id INTEGER NOT NULL DEFAULT nextval('club_check_seq'::regclass) PRIMARY KEY,
    club_id INTEGER,
    cash_table_id INTEGER NOT NULL,
    cash_table_session_id INTEGER NOT NULL,
    people_id INTEGER NOT NULL,
    check_number VARCHAR(15),
    check_nominal VARCHAR(50),
    check_bank VARCHAR(25),
    check_date DATE,
    is_pending BOOLEAN BOOLEAN,
    created_at TIMESTAMP,
    CONSTRAINT check_FK_1 FOREIGN KEY (club_id) REFERENCES club (id),
    CONSTRAINT check_FK_2 FOREIGN KEY (cash_table_id) REFERENCES cash_table (id),
    CONSTRAINT check_FK_3 FOREIGN KEY (cash_table_session_id) REFERENCES cash_table_session (id),
    CONSTRAINT check_FK_4 FOREIGN KEY (people_id) REFERENCES people (id)
);

ALTER TABLE cash_table_player_buyin ADD COLUMN club_check_id INTEGER;
ALTER TABLE cash_table_player_buyin ADD CONSTRAINT cash_table_player_buyin_FK_5 FOREIGN KEY (club_check_id) REFERENCES club_check (id);

CREATE OR REPLACE FUNCTION get_player_last_cash_game(peopleId INTEGER, clubId INTEGER) RETURNS VARCHAR AS '
DECLARE
    lastCashGame VARCHAR;
BEGIN

    SELECT
        to_char(checkin_at, ''DD/MM/YYYY'')||'' - ''||cash_table.CASH_TABLE_NAME||'' (''||REPLACE(CAST(buyin AS VARCHAR), ''.'', '','')||'')'' INTO lastCashGame
    FROM
        cash_table_player
        INNER JOIN cash_table ON cash_table.ID=cash_table_player.CASH_TABLE_ID
    WHERE
        people_id = peopleId
        AND (cash_table.CLUB_ID = clubId OR cash_table.CLUB_ID IS NULL)
        AND checkout_at IS NOT NULL
        AND cash_table.ENABLED
        AND cash_table.VISIBLE
        AND NOT cash_table.DELETED
    ORDER BY
        cash_table_player.CHECKOUT_AT;

    RETURN lastCashGame;

END'
LANGUAGE 'plpgsql';